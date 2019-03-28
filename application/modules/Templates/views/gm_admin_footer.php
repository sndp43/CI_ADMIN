</div>
<div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/adminfiles/images/loading1.gif'; ?>"/></div></div>

 <input type="hidden" id="apppath"  name="apppath" value="<?= base_url() ?>">
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; <a href="#"></a>.</strong> All rights
    reserved.
  </footer>
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
  <script src="<?= base_url()  ?>assets/adminfiles/js/utils/intlTelInput.js"></script>
  <!-- ckeditor start -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {

 var Bodya = $("#Bodya").val();

if(Bodya != undefined){
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('Bodya')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
}

  })
</script>
  <!-- ckeditor end -->
  <!-- Select2 -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- Select2 end -->
<!-- datepicker start -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- datepicker end -->
<script type="text/javascript" src="<?= base_url() ?>assets/adminfiles/js/dist/jquery.validate.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/adminfiles/js/validation/form_validation.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()  ?>assets/adminfiles/bower_components/fastclick/lib/fastclick.js"></script>
<!-- Admin App -->
<script src="<?= base_url()  ?>assets/adminfiles/dist/js/adminlte.min.js"></script>
<!-- Admin for demo purposes -->
<script src="<?= base_url()  ?>assets/adminfiles/dist/js/demo.js"></script>

<!-- iCheck 1.0.1 -->
<script src="<?= base_url()  ?>assets/adminfiles/plugins/iCheck/icheck.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>


<script type="text/javascript">

	function delete_website(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete Email settings");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this Email setting ?");
    $('#my_dynamic_model_id').modal('toggle');
}
	    function delete_user(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete User");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this User ?");
    $('#my_dynamic_model_id').modal('toggle');
}

function delete_enquiry(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete enquiry");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this Enquiry ?");
    $('#my_dynamic_model_id').modal('toggle');
}
function delete_subscription(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete enquiry");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this Enquiry ?");
    $('#my_dynamic_model_id').modal('toggle');
}

function delete_style(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete Style");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this Style ?");
    $('#my_dynamic_model_id').modal('toggle');
}
function delete_email_templates(element) {

    var delurl = element.getAttribute("data-del-url");
    $("#mydynamiv_model").attr("href",delurl);
    $("#mydynamiv_model_label").text("Delete Template");
    $("#mydynamiv_model_body").text("Are you sure you want to delete this Template ?");
    $('#my_dynamic_model_id').modal('toggle');
}
</script>
<script type="text/javascript">
   //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    })

</script>
<script type="text/javascript">
  $(function(){

   //Initialize Select2 Elements
    $('.select2').select2()
    
  });

</script>
<script type="text/javascript">
      //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
</script>

<script type="text/javascript">
  $(function(){

$('#selected_css').on('change', function(){

               
                $("#file_errorMessage").html('');

 //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
        $('#thumb-output').html(''); //clear html of output element
        var data = $(this)[0].files; //this file data
       
        $.each(data, function(index, file){ //loop though each file
           var image_one_name = file.name;
          
           var ValidImageTypes = ["text/css"];
           if ($.inArray(file.type=="text/css")) {
            //if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){  //check supported file type
                var fRead = new FileReader(); //new filereader
                fRead.onload = (function(file){ //trigger function on successful read
                return function(e) {
                  
                  $("#style_name").val(file.name);
                  $("#chk_file_add_removed").val("0");
                 // $('#thumb-output').html('<label id="thumb-output_lbl" class="col-sm-4 control-label" >sfgs</label>');
                    
                };
                })(file);
                fRead.readAsDataURL(file); //URL representing the file's data.
            }else{
                //alert("false");
                $("#selected_css").val('');
                $("#file_errorMessage").html('Invalid image type selected');
            }
        });
       
    }else{
        alert("Your browser doesn't support File API!"); //if File API is absent
    }
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
      // autoPlaceholder: "off",
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
   
 $("#telnum").intlTelInput("setNumber", txtCountryCode
                    +" "+telnum);
}
}else{

if(country_code != undefined){

    $("#telnum").intlTelInput({
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
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
  
      $(document).on("click", '.checkbox4', function () {
      var acc_id = this.getAttribute("data-acc-id");
      if (!this.checked) {
        var sure = confirm("Are you sure you want to deactivate this user ?");

        if(this.checked == !sure) {
          $.getJSON('<?= base_url() ?>/Accounts/deactivate_user/' + acc_id, function (data) {});
        } else {
          $(this).prop('checked', true);
        }
      } else if(this.checked) {
          var sure = confirm("Are you sure you want to activate this user ?");

          if(this.checked == sure) {
            $.getJSON('<?= base_url() ?>/Accounts/activate_user/' + acc_id, function (data) {});
          } else {
            $(this).prop('checked', false);
          }
      }

    });


</script>

<script type="text/javascript">
  $(function(){
 var activetab = $("#activetab").val()
  
if(activetab != undefined){
$("#"+activetab+"idanchor").click();
}

});

</script>
</body>
</html>
