$.validator.addMethod("EmailValidation", function (value, element, regexpr) {
    return /^[a-z0-9]+[_a-z0-9\.-]*[a-z0-9]+@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})/.test(value);
}, "Please enter valid email.");

		// $.validator.setDefaults( {
		// 	submitHandler: function () {
		// 		alert( "submitted!" );
		// 	}
		// } );

		$( document ).ready( function () {
			
var update_id = $("#update_id").val();

if(update_id!=0 || update_id!="" ){
	var required_status = false;
}else{ 
	var required_status = true;
}

     var APPPATH = $("#apppath").val();

	$.validator.addMethod("validName", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter only charecters.");

    $.validator.addMethod("mobileno", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter only charecters.");

    $.validator.addMethod("verification_code", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter only charecters.");



			$( "#create_account_form" ).validate( {
		        rules: {
		        			firstname: {
                            required: true,
                            validName: /^[a-zA-Z ]*$/
                    },
		        	 lastname: {
                        required: true,
                        validName: /^[a-zA-Z ]*$/
                    },
                    company: {
						required: false,
						 validName: /^[a-zA-Z ]*$/
					},
					address1: {
						required: false
						 
					},
					address2: {
						required: false
						 
					},
					country: {
						required: false,
						validName: /^[a-zA-Z ]*$/
						 
					},
					town: {
						required: false	 
					},
					telnum: {
						
						  remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Accounts/check_telnum",
			            data: {
						id: function() {
							return $("#update_id").val();
						 }
					    }
					   }	 
					},
					postcode: {
						required: false,
						mobileno: /^[0-9]*$/	 
					},
					role: {
						required: true 
					},
					email: {
						required: true,
						EmailValidation: true,
						
				        remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Accounts/check_email",
			            data: {
						id: function() {
							return $("#update_id").val();
						}
					    }
			            
					   }
				
					},
					agree: "required"

				},
				messages: {
					firstname: "Please enter your Name",
					lastname: "Please enter your lastname",
					company: "Please enter valid Companyname",
					address1: "Please enter your lastname",
					country: "Please enter valid Country",
					
					telnum: {
						
						remote: "This Number already exist" 
					},
					postcode: "Please enter valid postcode",
					role: "Please select role",
					email: {
						required: "Please enter valid Email",
						EmailValidation: "Please enter valid Email",
				        remote	: "Email Already Exist"
				    },
					agree: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );



						$( "#create_mail_setting_form" ).validate({
		        rules: {
		        			MailUserName: {
                            required: true
                           
                    },
		        	 MailPassword: {
                        required: true,
                        minlength: 3
                    }, 
                    MailHost: {
						required: true
						 
					},
                    MailPort: {
						required: true
						 
					},
					FromEmail: {
						required: true,
						EmailValidation: true,
						 
					}

				},
				messages: {
					MailUserName: "Please enter your Mail UserName",
					MailPassword: "Please enter your Mail Password",
					MailPort: "Please enter valid Mail Port",
					FromEmail:{
						required: "Please enter a valid From Email field",
						EmailValidation: "Please enter a valid From Email field",
						 
					} ,
					MailHost: "Please enter Mail Host field"
					
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );




$( "#update_password_form" ).validate({
		        rules: {
		        			password: {
                            required: true,
                            minlength: 3
                    },
		        	 passconf: {
                        required: true,
                        minlength: 3,
                        equalTo: "#password"
                    }
				},
				messages: {
					password: {
                        required: "Please enter valid Password",
                        minlength: "Please enter atleast 3 charecters",

                    },
					passconf: {
                         required: "Please enter valid Password",
                         minlength: "Please enter atleast 3 charecters",
                         equalTo: "Password does not match"
                    }	
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );


var update_id = $("#update_id").val();

if(update_id!=0){
	var required_status = false;
}else{ 
	var required_status = true;
}
$( "#create_style_form" ).validate( {
	
		          rules: {
		        	  selected_css:{ 
		        	  	required: required_status,
                        remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Manage_style/check_style",
			            data: {
						id: function() {
							return $("#update_id").val();
						 },
						 style_name: function() {
							return $("#style_name").val();
						 }
					    }
					   }
		        	  },
		        	  status: "required"
		        	
				},
				messages: {
                         selected_css: { 
                            required:"Please upload valid style",
                            remote:"This style alredy exist"
                         },
                         status: "Please select valid style status"
                       },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );




$( "#create_fb_settings" ).validate( {
	
		          rules: {
		        	  fbapi_key:{ 
		        	  	required: true
		        	  },
		        	  fbapp_secret: "required"
		        	
				},
				messages: {
                         fbapi_key: { 
                            required:"Please Enter Valid API Key"
                           
                         },
                         fbapp_secret: "Please Enter valid App Secret"
                       },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );



$( "#create_gp_settings" ).validate( {
	
		          rules: {
		        	 
		        	  gpapplication_name: "required",
		        	  gpapi_key: "required",
		        	  gpclient_secret: "required",
		        	  gpclient_id: "required",
		        	  gpredirect_uri: "required"
		        	     
		        	
				},
				messages: {
                         gpapplication_name:"Please Enter Valid Application Name",
                         gpapi_key: "Please Enter valid API Key",
                         gpclient_secret: "Please Enter valid Client Secret",
                         gpclient_id: "Please Enter valid Client ID",
                         gpredirect_uri: "Please Enter valid Redirect URI"

                       },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );


$( "#emailtemplate_create" ).validate( {
	
		          rules: {
		        	 
		        	  Key: "required",
		        	  Subject: "required",
		        	  Bodya: "required"
		        	
				},
				messages: {
                         Key:"Please Enter Valid Key",
                         Subject: "Please Enter valid Subject",
                         Bodya: "Please Enter valid Body"
                       },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );


$( "#countries_create" ).validate( {
	
		          rules: {
		        	 
		        	  country_name: {
                           required:true,
                             remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Manage_Countries/check_country_name",
			            data: {
						id: function() {
							return $("#update_id").val();
						 }
					    }
			           }
		        	  },
		        	  country_code:{
                           required:true,
                             remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Manage_Countries/check_country_code",
			            data: {
						id: function() {
							return $("#update_id").val();
						 }
					    }
			           }
		        	  },
		        	  currancy_code: {
                           required:true,
                             remote	: {
				        type: "POST",
                        async: false,
			            url: APPPATH+"Manage_Countries/check_currancy_code",
			            data: {
						id: function() {
							return $("#update_id").val();
						 }
					    }
			           }
		        	  }
		        	
				},
				messages: {
                         country_name:{
                         	required:"Please Enter Valid Country Name",
                         	remote:"This Country Name already exist"
                         },
                         country_code: {
                         	required:"Please Enter Valid Country Code",
                         	remote:"This Country Code already exist"
                         },
                         currancy_code:{
                         	required:"Please Enter Valid Currancy Code",
                         	remote:"This Currancy Code already exist"
                         }
                       },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						//$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					//$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					//$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );





		} );