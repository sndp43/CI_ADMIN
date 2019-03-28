$.validator.addMethod("EmailValidation", function (value, element, regexpr) {
    return /^[a-z0-9]+[_a-z0-9\.-]*[a-z0-9]+@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})/.test(value);
}, "Please enter valid email.");

		// $.validator.setDefaults( {
		// 	submitHandler: function () {
		// 		alert( "submitted!" );
		// 	}
		// } );

		$( document ).ready( function () {

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



			$( "#create_account_form_home" ).validate({
		        rules: {
		        			firstname: {
                            required: true,
                            validName: /^[a-zA-Z ]*$/
                    },
		        	 lastname: {
                        required: true,
                        validName: /^[a-zA-Z ]*$/
                    },
					telnum: {
						required: false,
						mobileno: /^[0-9]*$/	 
					},
					email: {
						required: true,
						EmailValidation: true,
				        remote	: {
			        url: APPPATH+"Accounts/check_email",
			        type: "post"
			        
					}
				
					}
					// agree1: "required"
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					// company: "Please enter valid Companyname",
					// address1: "Please enter your lastname",
					// country: "Please enter valid Country",
					telnum: "Please enter valid telnum",
					// postcode: "Please enter valid postcode",
					// role: "Please select role",
					email:{ 
						required:"Please a valid email address",
						remote:"This email id already exist",	

				}
					//agree1: "Please accept our policy"
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


			$( "#contact_form" ).validate({
		        rules: {
		        	cfName: {
                            required: true,
                            validName: /^[a-zA-Z ]*$/
                    },
					cfPhone: {
						required: false,
						mobileno: /^[0-9]*$/	 
					},
					cfEmail: {
						required: true,
						EmailValidation: true
				
					},
					 terms: "required"
				},
				messages: {
					firstname: "Please enter your firstname",
					lastname: "Please enter your lastname",
					telnum: "Please enter valid telnum",
					email:{ 
						required:"Please a valid email address",
						EmailValidation:"Please a valid email address",	

				},
					terms: "Please accept our policy"
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
			

			$( "#subscribe_form" ).validate( {
		        rules: {
		        	scName: {
                            required: true,
                            validName: /^[a-zA-Z ]*$/
                    },
					Email: {
						required: true,
						EmailValidation: true
				
					},
					 terms: "required"
				},
				messages: {
					scName: "Please enter your Name",
					
					Email:{ 
						required:"Please a valid email address",
						EmailValidation:"Please enter a valid email address"

				},
					terms: "Please accept our policy"
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





			$( "#reset_password" ).validate({
		        rules: {
		        	
					email: {
						required: true,
						EmailValidation: true,
						remote	: {
			        url: APPPATH+"Accounts/check_email_forgot",
			        type: "post"
			        
					}
				
					}
				},
				messages: {
					email:{ 
						required:"Please a valid email address",
						EmailValidation:"Please enter a valid email address",
						remote:"This email is not registered with us!",

				}},
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


		} );