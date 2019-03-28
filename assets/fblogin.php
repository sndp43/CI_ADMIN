
<!-- Facebook Login -->
<div id="facebook" class="login_fb">
    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><p>Log in with Facebook</p></a>
    </div>



<!-- Javscript Facebook -->
<script type="text/javascript">
 

    window.fbAsyncInit = function () {
        //Initiallize the facebook using the facebook javascript sdk
        FB.init({
            appId: '<?php echo $this->config->item('appID'); ?>', // App ID 
            cookie: true, // enable cookies to allow the server to access the session
            status: true, // check login status
            xfbml: true, // parse XFBML
            oauth: true //enable Oauth 
        });
    };
    //Read the baseurl from the config.php file
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
    //Onclick for fb login
    $(document).on("click", "#facebook", function(e) {
      FB.login(function (response) {
            if (response.authResponse) {
                parent.location = '<?= base_url(); ?>Register/fblogin'; //redirect uri after closing the facebook popup
            }
        }, {scope: 'public_profile'}); //permissions for facebook
    });
    // $('#facebook').click(function (e) {
      
    //     FB.login(function (response) {
    //         if (response.authResponse) {
    //             parent.location = '<?= base_url(); ?>Register/Register/fblogin'; //redirect uri after closing the facebook popup
    //         }
    //     }, {scope: 'public_profile'}); //permissions for facebook
    // });
    </script>

    <!-- Controller  facebook-->
    <?php
class Register extends MX_Controller 
{



    // facebook login start
    function fblogin() {
        include_once APPPATH . "libraries/facebook/facebook.php"; //Refer CI_DRL
/*
 Facebook Keys  
 */
 //config.php
//$config['appID'] = '1455420854549591';
//$config['appSecret'] = '6c3434ce192c07e6c6e4a0edc48ba92c';


        $appId = $this->config->item('appID');
        $appSecret = $this->config->item('appSecret');
        $redirectUrl = base_url() . 'Register/fblogin';  
        $fbPermissions = 'email';

        //Call Facebook API
        $facebook = new Facebook(array(
            'appId' => $appId,
            'secret' => $appSecret
        ));
        $fbuser = $facebook->getUser();

        if ($fbuser) {
              
            
            
            $userProfile = $facebook->api("/$fbuser?fields=id,first_name,last_name,email,gender,locale,picture.width(800).height(800)");
        
            // Preparing data for database insertion
            
            if(!isset($userProfile['email'])){
                $getEmailUrl = $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri' => $redirectUrl, 'scope' => $fbPermissions));
                 redirect("$getEmailUrl");  
            }
            
              // $Password = substr(md5(microtime()),8);
              $Password = generate_random_no(6);
              $this->load->module('Site_security'); //Loading Module
              $auto_pward= generate_random_no(8);
              $userData['Password'] = $this->site_security->_hash_string($auto_pward);
              
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            // $userData['gender'] = ($userProfile['gender']=="male") ? 1 : 0 ; 
            // $userData['locale'] = $userProfile['locale'];
            // $userData['profile_url'] = 'https://www.facebook.com/' . $userProfile['id'];
            // $userData['picture_url'] = $userProfile['picture']['data']['url'];
            
            //send mail
            // Insert or update user data
            $this->load->module('Accounts');
            $userSessionData = $this->accounts->RegisterFBUser($userData); 
            
            //$this->session->set_userdata(AdminSession, $userSessionData);

                        $usersesData = array(
                            'UserId' => $userSessionData->id,
                            'UserName' => $userSessionData->email,
                            'FullName' => $userSessionData->firstname." ".$userSessionData->lastname,
                            'Mobile' => $userSessionData->telnum,
                            // 'phone' => $value->Mobile,
                            'email' => $userSessionData->email
                            // 'encEmail' => encrypt_cookie($userData['email']),
                            // 'country_code' => $userSessionData->country_code
                        );
                        
            if( $userSessionData->mailstatus == 1) {     
 

            }
             
            $this->_in_you_go($userProfile['email']);

            redirect($this->home);
            
          
        } 
        else {  
                $fbuser = ''; 
             
                redirect($this->home);          // redirect to home
            
        }
        
                redirect($this->home);          // redirect to home
    }
    // facebook login end


   
}


// fb login model
 public function RegisterFBUser($userData) {

         // $Gender = $userData['gender'];
         $FacebookId = $userData['oauth_uid'];
         $Password = $userData['Password'];
         $first_name = $userData['first_name'];
         $last_name = $userData['last_name'];
         $email = $userData['email'];
        // $ProfileImage = $userData['picture_url'];
        // Check if user name exists
         $data = $this->db->query("SELECT * FROM drl_accounts WHERE email = ? ", array('email'=>$email))->row();  //'FacebookId' => $FacebookId,
        
    
       
        
         if (count($data) ==0) {
            // Insert user in data base 
            $insertData = array(
                'FacebookId'=> $FacebookId,
                'pward'=> $Password,
                'email'=> $FacebookId,
                'firstname'=> $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'date_created' => time(),
                'role' => '2',
                // 'ProfileImage' => $ProfileImage,
                // 'User_Group_Type'=>'Website User',
                // 'MailVerified'=>'1',
                // 'Gender'=>$Gender
            );
            $this->db->insert('drl_accounts',$insertData);
            $insert_id = $this->db->insert_id();
            
             $data = $this->db->query("SELECT * FROM drl_accounts WHERE id = ?", array('id' => $insert_id))->row();
             $data->mailstatus = 1;
         
        }else{
            $data->mailstatus = 0;
           //print_r($data);
           //return $data;
        }
        
        return $data;
        
        
    }
