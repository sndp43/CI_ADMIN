</div>
<input type="hidden" id="apppath"  name="apppath" value="<?= base_url() ?>">
<script type="text/javascript" src="<?= base_url() ?>assets/homefiles/js/validation/form_validation.js"></script>
<script src="<?= base_url()  ?>assets/homefiles/js/utils/intlTelInput.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script type="text/javascript">
	
	    function delete_user(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete User");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this User ?");
    $('#my_dynamic_model_id').modal('toggle');
}

</script>
<script type="text/javascript">
	
$("#csschange").on("change",function(){

var apppath = $("#apppath").val();
var optionid = $(this).val();
var option = $('#csschange :selected').text();

// if(option==""){
// 	option = $("$default_style").val();
// }

$.post(apppath + 'Manage_style/set_style', {style: option}, function(result, status) {
             $("#style_dyna").attr("href", apppath+"assets/homefiles/css/custom/"+option);  
            });

});

</script>

<script type="text/javascript">

  // for create user from admin to select country code  start//
var apppath = $("#apppath").val();

 var country_code = $("#telnum").val();
 var txtCountryCode = $("#country_code_num").val();
 var telnum = $("#telnum").val();

if(txtCountryCode != "" ){
if(country_code != undefined){

    $("#telnum").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
       autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
       hiddenInput: "full_number",
      // initialCountry: "auto",
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
       preferredCountries: ['in'],
       separateDialCode: true,
      utilsScript: apppath+"assets/homefiles/js/utils/utils.js"
    });
   
 $("#telnum").intlTelInput("setNumber", txtCountryCode
                    +" "+telnum);
}
}else{

if(country_code != undefined){

    $("#telnum").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
       autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
       hiddenInput: "full_number",
      // initialCountry: "auto",
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
       preferredCountries: ['in'],
       separateDialCode: true,
      utilsScript: apppath+"assets/adminfiles/js/utils/utils.js"
    });
    

}

}

    function submit_click(event){ 
        var countryData = $("#telnum").intlTelInput("getSelectedCountryData");
        console.log(countryData);
        var country_code = "+"+countryData['dialCode'];
        var country_abbreviation = countryData['iso2'];
        $("#country_abbreviation").val(country_abbreviation);
        $("#country_code_num").val(country_code);
       //event.preventDefault();
    }
    // on page load check if country country_abbreviation is present or country code is present if not nmake uae default
    $(function(){
    $("#countrytexts").change(function () {
              var end = this.value;
              var c= $(this).find(':selected').attr('data-code-c')
              code = c.slice(1);
            //  alert(c);
            // var code;
    //         switch (end) {
    //     case "1":
    //         code = "973";
    //         break;
    //     case "2":
    //         code = "966";
    //         break;
    //     case "3":
    //         code = "965";
    //         break;
    //     case "4":
    //         code = "968";
    //         break;
    //     case "5":
    //         code = "974";
    //         break;
    //     case "6":
    //         code = "971";
    //         break;
    //     case  "14":
    //         code = "91";
    // }
        //var phone = $("#phone").val();

             $("#telnum").intlTelInput("setNumber", "+"+code+" ");

        });
        //var country_abbreviation =  $("#country_abbreviation").val();
       
     
    //get last index

            // var link = window.location.pathname;
            // var list = link.split('/');
            // var lastIndex = "";
            // if (list.length > 0) {
            //     lastIndex = list[list.length - 1];
            // }
           
        // if(lastIndex == "update-my-profile"){  

        //      var country_code =  $("#country_code_num").val();
        //      var phone_no = $("#telnum").val();


        //      if(country_code == ""){  
        //         $("#telnum").intlTelInput("setNumber", "+971 "+phone_no);
        //    }else{  
           
        //        $("#telnum").intlTelInput("setNumber", country_code
        //             +" "+phone_no);
        //      }
        // }
    //$('#formLogin').click(function(){
    // document.onkeydown=function(evt){
    //         var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
    //         if(keyCode == 13)
    //         {
    //             $("#submit").trigger("click");
    //         }
    //     }



    //});
     
    });


      // for create user from admin to select country code  end//




</script>

<script type="text/javascript">

    // for capcha for register form start//
var img_url='<?= base_url()?>Capcha/refresh';
var img_hidden='<?= base_url()?>Capcha/GetCpchaCode';

 $.get(img_hidden, function(data, status) {
                console.log(data);
                cap_code=jQuery.parseJSON (data);
                
                $('#hiddencaptcha').val('');
                $('#hiddencaptcha').val(cap_code.capchacode);

            });

$('.cap_ref').click(function() {
            $.get(img_url, function(data, status) {
                console.log(data);

                $('#captImg').empty();
                $("#captImg").append(data);
            });

            $.get(img_hidden, function(data, status) {
                console.log(data);
                cap_code=jQuery.parseJSON (data);
                
                $('#hiddencaptcha').val('');
                $('#hiddencaptcha').val(cap_code.capchacode);

            });



        });
  // for capcha for register form end//
</script>
<script type="text/javascript">

// remove image of my profile start //

function remove_image(column_name) {
var apppath = $("#apppath").val();
    var update_id=$('#update_id').val();
    if(column_name == 'profilepic'){
        var vv='_pp';
    } 

    $.confirm({
        title: 'Please confirm !',
        content: 'Delete this image',
        buttons: {
            confirm: function () {
                $.ajax({
                    type : 'POST',
                    url  : apppath+"Accounts/remove_profile_pic",
                    data : {
                        update_id : update_id,
                        column_name : column_name
                    },
                    success : function(data){
                        // console.log(data);
                        if(data == 'true'){}
                        $('#thumb-output'+vv).empty();
                        $("#"+column_name).empty();
                        $("#"+column_name+"_name").val('');
                    }
                });
                //$.alert('Image has been deleted.');
            },
            cancel: function () {
                //$.alert('Canceled! Image is safe :)');
            }
        }
    });
}
    function remove_it(column_name) {
    // console.log(column_name);
    if(column_name == 'profilepic'){
        var vv='_pp';
    } 

    $.confirm({
        title: 'Please confirm !',
        content: 'Delete this image',
        buttons: {
            confirm: function () {
                $('#thumb-output'+vv).empty();
                $("#"+column_name).val('');
                $("#"+column_name+"_name").val('');
                //$.alert('Image has been deleted.');
            },
            cancel: function () {
                //$.alert('Canceled! Image is safe :)');
            }
        }
    });

}


// remove image of my profile end //

$(function(){

$('#profilepic').on('change', function(){

               
                $("#file_errorMessage").html('');

 //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
        $('#thumb-output').html(''); //clear html of output element
        var data = $(this)[0].files; //this file data
       
        $.each(data, function(index, file){ //loop though each file
           var image_one_name = file.name;
           var ValidImageTypes = ["image/gif", "image/jpeg", "image/png","image/jpg",];
               if ($.inArray(file.type, ValidImageTypes)) {
            //if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){  //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element
                        $('#thumb-output_pp').append(img); //append image to output element
                        //$('#property_logo_name').val(property_logo_name);
                        var url = window.location.href;
                        if(url.search("Profile")) {
                            $('#thumb-output_pp').append('<input type="button" class="btn btn-danger" onclick=remove_it("profilepic") value="remove image" />');
                        }else{

                      }

                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
            }else{
                //alert("false");
                $("#profilepic").val('');
                $("#profilepic_nameerrorMessage").html('Invalid type selected');
            }
        });
       
    }else{
        alert("Your browser doesn't support File API!"); //if File API is absent
    }
});

  });






</script>
</body>
</html>