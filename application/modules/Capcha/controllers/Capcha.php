<?php
class Capcha extends MX_Controller 
{

    function __construct() {
        parent::__construct();
        // Load the captcha helper
        $this->load->helper('captcha');
    }


    
    public function index(){ 


            $this->load->library('Antispam');
            $configs = array(
                    'img_path' => './assets/pics/captcha_images/',
                    'img_url' => base_url().'assets/pics/captcha_images/',
                    'img_height' => '50',
                );          
             $captcha = $this->antispam->get_antispam_image($configs);
             $this->session->unset_userdata('captchaCode');
             $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
             echo $captcha['image'];



        // If captcha form is submitted
        // if($this->input->post('submit')){ 

        //     $inputCaptcha = $this->input->post('captcha');
        //     $sessCaptcha = $this->session->userdata('captchaCode');

        //     if($inputCaptcha === $sessCaptcha){

        //         echo 'Captcha code matched.';

        //     }else{

        //         echo 'Captcha code was not match, please try again.';

        //     }
        // }
        
        // // Captcha configuration
        // $config = array(
        //     'img_path'      => 'captcha_images/',
        //     'img_url'       => base_url().'captcha_images/',
        //     'img_width'     => '150',
        //     'img_height'    => 50,
        //     'word_length'   => 8,
        //     'font_size'     => 16
        // );
        // $captcha = create_captcha($config);
        
        // // Unset previous captcha and store new captcha word
        // $this->session->unset_userdata('captchaCode');
        // $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // // Send captcha image to view
        // $data['captchaImg'] = $captcha['image'];
        
        // // Load the view
        // $this->load->view('capcha', $data);
    }
    
    public function refresh(){


            $this->load->library('antispam');
            $configs = array(
                    'img_path' => './assets/homefiles/pics/captcha_images/',
                    'img_url' => base_url().'assets/homefiles/pics/captcha_images/',
                    'img_height' => '50',
                );          
            $captcha = $this->antispam->get_antispam_image($configs);


        // Captcha configuration
        // $config = array(
        //     'img_path'      => 'captcha_images/',
        //     'img_url'       => base_url().'captcha_images/',
        //     'img_width'     => '130',
        //     'img_height'    => 30,
        //     'word_length'   => 5,
        //     'font_size'     => 20
        // );
        // $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }


      public function GetCpchaCode(){
        
        
         $capchadata = $this->session->userdata('captchaCode');
         $result = array(
                  'capchacode'=>$capchadata
            );

        echo json_encode($result);
    }



function InsertCapchaToDB($imagename){


    $data = array(
           'capcha' => $imagename,
           'time'=>time()
    );


    $this->_insert($data);

}



function get($order_by) 
{
    $this->load->model('mdl_captcha');
    $query = $this->mdl_captcha->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_captcha');
    $query = $this->mdl_captcha->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_captcha');
    $query = $this->mdl_captcha->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_captcha');
    $query = $this->mdl_captcha->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_captcha');
    $this->mdl_captcha->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_captcha');
    $this->mdl_captcha->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_captcha');
    $this->mdl_captcha->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_captcha');
    $count = $this->mdl_captcha->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_captcha');
    $max_id = $this->mdl_captcha->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_captcha');
    $query = $this->mdl_captcha->_custom_query($mysql_query);
    return $query;
}

}