/* 
Generic for validations script v.1.3
This script was written by Greg Stewart as part of research into creating a generic validation framework for JavaScript. Feel free to use it, modify it, improve it, but please let me know of those changes so that I may include them in future releases of the script. Oh and please leave this little segment in the script. Should you want to get hold of me you can reach me at gregs@armagossa.com 

Instructions (make these up as I go along):
To call the script include in your opening form tag this: onSubmit="return verify(this);"
In order for this script to work you have make sure that your form fields follow certain rules:
- For required fields, the field name should be prefixed by r_
- For optional fields, the field name should be prefixed by o_
- To validate an email address please make sure that your field name is prefixed by r_ and contains email (e.g. r_email)
- Checking for matching passwords: Here your form fields will have to be called r_password and r_verify_password. PLease note that if youare using the script to validate for a submitted password, your form will need to include a hidden field called: r_verify_password with a value of 0.
ie4  specific - Furthermore you will need to place in the row above each form field the following HTML code: <span id="elField0"></span>, where 0 is the first field element and you increment that number by 1 for each subsequent form field (i.e. <span class="alert" id="elField1"></span> for the second field, <span class="alert" id="elField2"></span> for the third, etc...)
- To check that numeric values fit between a certain range you need to add the follwoing lines of code to your opening form tag in the onSubmit statement: this.r_fieldname.numeric = true; this.r_fieldname.min = 0; this.r_fieldname.max = 100; return verify(this);
- If you happen to be using the form tag fieldset make sure to skip over that element as it is counted while looping. SO asuming that you start your form with a fieldset tag your first form field weould start with elField1 instead of 0
Fixes:
- Fixed the script so that it didn't insert blank lines into the page anymore after validating (well until the first error occurs)
- Added support for removing [] from field names when displaying the error message, these are required for multiple drop down boxes when you code using PHP ==> 29/5/2002
What's coming?
- Select multiple ==> 22/6/2001 Implemented select multiple. 
- group check boxes
- checking for a valide date formats ==> OK cheated here slightly and used someone else's script, but I just didn't see the point in re-inventing the wheel and since it slotted in so nicely. Found it at this URL http://webdeveloper.earthweb.com/pagedev/webjs/item/0,3602,12744_9061,00.html. Michael you initially wrote this script and I tried to get in touch, but there was no contact information, so I hope you don't mind me bundling it with my script.
- credit cards. maybe?
Any other suggestions? Just mail them to me... Or implement them and let me know of the changes...
Tested on NS versions: 4.08, 7, 4.76
Tested on IE versions: 5,6
Tested on Opera versions: 6
*/

<!-- Hide Script from older browser 	
  var ie4 = (document.all)? true:false;
  var ns4 = (document.layers)? true:false;
  var dom = (document.getElementById)? true:false;
  
  // test for opera if ie returned
  if(ie4) {
   var ua=navigator.userAgent.toLowerCase(); 
   var opera = (ua.indexOf("opera") > 0);
  }
  
  //set default values for error fields
  var empty_fields = "";
  var errors = "";
  var errors_2 = "";
  var errors_3 = "";
	
  //check if form field is blank (i.e. a space was entered or a return or a tab function 
 	function isBlank(s){
 		var s = s.replace( /^\s*/, "" );
         for(var i = 0; 1<=s.length; i++) {
 			var c = s.charAt(i);
 			if ((c != ' ') && (c != '\n') && (c != '\t')) return false;
 		}
 		return true;
 	}
	 
  // strips out r_, o_ and replaces _ with a space from the field name function
  function strip(str) { 
 		var ar = str.match(/([r_|o_])?([^# ]*)/);
 		var rem = RegExp.$2.replace(/_/g, ' ');
 		return (rem);
 	}
	
 	// check if it is an optional field function
  function isOptional(name) { 
 		indx = name.indexOf('r_');
     return (indx);	
 	}
	
  // check if form field name is e-mail function
  function isEmail(t) { 
 		var reg_email = new RegExp("email","i");
 		if(reg_email.test(t)){
 			return true;
 		} 
 	}
	
  // check if form field name is date function
  function isItDate(s) { 
 		var reg_date = new RegExp("date","i");
 		if(reg_date.test(s)){
 			return true;
 		}
 	}
  
  // build up the display part
  function runDisplay(id,field, message) {
    //get the field name minus the crap
    var display_field = strip(field.name)
    if((ie4||dom) && !opera){
  		if (ie4) {
        whichEl = eval("document.all.elField" + id);
      } else if (dom) {
        whichEl = eval("document.getElementById(\"elField" + id + "\")");
      }
      /* 1 equals normal 
      2 equals Please enter a valid e-mail address
      3 equals Please enter a valid date format (e.g.: dd/mm/yyyy)
      4 equals You need to select a field name
      5 equals multiple drop down At least one of your field name fields is empty
      6 The field " + strip(e.name) + " needs to be checked
      */
      if (message == 1) {
        error_message = "Please complete the " + display_field + " field<br />";
      } else if (message == 2) {
        error_message = "Please enter a valid e-mail address<br />";
      } else if (message == 3) {
        error_message = "Please enter a valid date format (e.g.: dd/mm/yyyy)<br />";
      } else if (message == 4) {
        error_message = "You need to select a(n) " + display_field + "<br />";
      } else if (message == 5) {
        error_message = "At least one of your " + display_field + " fields is empty<br />";
      } else if (message == 6) {
        error_message = "The field " + display_field + " needs to be checked<br />";
      } else if (message == 7) {
        error_message = "The field " + display_field + " must be a number<br />";
      }
      whichEl.innerHTML = error_message;
  	  empty_fields += "1";
  	} else { // use this for ns and opera
      if (message == 2) {
        errors_3 += "\n Please enter a valid e-mail address";
      } else if (message == 3) {
        errors_3 += "\n	Please enter a valid date format (e.g.: dd/mm/yyyy)";
      } else if (message == 4) {
        errors_3 += "\n You need to select a(n)" + display_field;
      } else if (message == 5) {
        errors_3 += "\n At least one of your " + display_field + " fields is empty";
      } else if (message == 6) {
        errors_3 += "\n The field " + display_field + " needs to be checked";
      } else if (message == 7) {
        errors_3 = "\n The field " + display_field + " must be a number";
      } else {
        empty_fields += "\n		" + display_field;
  	  }
    }
  }
  
  //if error was generated by a previous attempt blank it out
  function clearEl(id) {
    if(ie4){
 	  whichEl = eval("document.all.elField" + id);
      whichEl.innerHTML = "&nbsp;";
  	} else if (dom) {
      whichEl = eval("document.getElementById(\"elField" + id + "\")");
      whichEl.innerHTML = "&nbsp;";
    }
  }
	
  function verify(f) {
    var msg;
		  
    // reset some of the variable for netscape that way they don't duplicate
    if (errors_3 != ""){
      errors_3 = "";
    }
    if (empty_fields != ""){
      empty_fields = "";
    }
    if (errors_2 != ""){
      errors_2 = "";
    } 
    
		var j = 1
		for(var i = 0; i < f.length; i++) {
			var e = f.elements[i];
			//alert(e.name + " and " + i + " and type: " + e.type);
      		if(((e.type == "text") || (e.type == "textarea")) && (isOptional(e.name)== 0)) {
        	// first check if the field is empty
				if ((e.value == null) || (e.value == "") || (e.value == " ") || isBlank(e.value)) {
					runDisplay(i,e,1); // display the error message
					continue;
				} else { // field contains something
					clearEl(i); // clear the error message
					// now check for valid e-mail address
					if (isEmail(e.name)) { // first check to see if it is an e-mail form entry
						var reg_email = /^[\-\.\_\&0-9a-zA-Z]+[@][\-\.\_\&0-9a-zA-Z]+[\.][\.\_0-9a-zA-Z]{1,}$/;
						if (reg_email.exec(e.value) == null ) {
							runDisplay(i,e,2);
						} else {
							clearEl(i);
						}
					}
					// now check to see if it's a valide date entry
					if (isItDate(e.name)) { // Let's see if it's a date field
					// this now goes off to run the function found in c_date.js and if the result is false...
						if ( ! isDateString(e.value)) { 
							runDisplay(i,e,3);
						}
					}
				}
				// check to see if it is a numeric value
				if (e.numeric == true) {
          //alert(e.numeric);
					var v = parseFloat(e.value);
					if (isNaN(v)) { // if it is not a number
						runDisplay(i,e,7);
          } else if ((e.min != null) && (e.max != null)) { // make sure it fits between the specified values
						if (((e.min != null) && (v < e.min)) ||	((e.max != null) && (v > e.max))) {
							var errors = "";
              if(ie4){	// Based on the result do the DHTML bit else the pop up
								if (e.min != null)
									errors += "Must be a number that is greater than " + e.min;
								if (e.max != null && e.min != null)
									errors += " and less than " + e.max + "<br />";
								else if (e.max != null)
									errors += "Must be a number that is less than " + e.max + "<br />";
  								whichEl = eval("document.all.elField" + i);
  								whichEl.innerHTML = errors;
							} else if (dom) { 
                if (e.min != null)
									errors += "Must be a number that is greater than " + e.min;
								if (e.max != null && e.min != null)
									errors += " and less than " + e.max + "<br />";
								else if (e.max != null)
									errors += "Must be a number that is less than " + e.max + "<br />";
  								whichEl = eval("document.getElementById(\"elField" + i + "\")");
  								whichEl.innerHTML = errors;
              } else {
								if (e.min != null)
									errors_3 += "\n Must be a number  that is greater than " + e.min;
								if (e.max != null && e.min != null)
									errors_3 += " and less than " + e.max;
								else if (e.max != null)
									errors_3 += "\n Must be a number that is less than " + e.max;
									errors_3 += ".";
							}
						}
					} else {
            clearEl(i);
          }
				}
			} else if ((e.type == "select-one") && (isOptional(e.name)== 0)) {
				if ((e.options[e.selectedIndex].value == null) || (e.options[e.selectedIndex].value == "")) {
					runDisplay(i,e,4);
					continue;
				} else {
					if(ie4){
						clearEl(i);
					}
				}
			} else if ((e.type == "select-multiple") && (isOptional(e.name) == 0)) {
        if ((e.options.value == null) || (e.options.value == "")) {
					if (ie4) {
            runDisplay(i,e,5);
          } else if (dom) { // for mozilla
            if (e.options[e.selectedIndex].value == "") {
              runDisplay(i,e,5);
            }
          } else {
            // previous version of NS
            if (e.options[e.selectedIndex].value == undefined || isBlank(e.options[e.selectedIndex].value)) {
              runDisplay(i,e,5);
            }
          }
          continue;
        } else {
					clearEl(i);
				}
			} else if ((e.type == "password") && (isOptional(e.name)== 0)) {
				if ((e.value == null) || (e.value == "") || isBlank(e.value)) {
					runDisplay(i,e,1);
					continue;
				} else if((f.elements.r_verify_password) && (f.elements.r_verify_password.value!=0)) {
					//alert('here');
					if (f.elements.r_verify_password.value != "" && (f.elements.r_password.value != f.elements.r_verify_password.value)) {
						if (j<2) {
              				if (ns4) 
                				errors_2 += "\n ";
							
              				errors_2 += "The field(s) for: " + strip(e.name);
							if(ie4) {
								whichEl = eval("document.all.elField" + i);
								whichEl.innerHTML = "&nbsp;";
								empty_fields += "1";
							} else if (dom) {
                				errors_2 += "<br />";
								whichEl = eval("document.getElementById(\"elField" + i + "\")");
								whichEl.innerHTML = "&nbsp;";
								empty_fields += "1";
              				}
							j++;
						} else {	
							errors_2 += " and " + strip(e.name) + " do not match.";
							if (ie4) {
                				errors_2 += "<br />";
								whichEl = eval("document.all.elField" + i);
								whichEl.innerHTML = errors_2;
								empty_fields += "1";
							} else if (dom) {
                				errors_2 += "<br />";
								whichEl = eval("document.getElementById(\"elField" + i + "\")");
								whichEl.innerHTML = errors_2;
								empty_fields += "1";
              				}
							continue;
						}
					} else {
						clearEl(i);
					}
				} else {
          			clearEl(i);
        		}
			} else if ((e.type == "checkbox") && (isOptional(e.name)== 0)) {
				if (e.checked == false) {
					runDisplay(i,e,6);
					continue;
				} else {
					clearEl(i);
				}
			}
		}
    
		// finished processing the form now halt the processing and display the erros if appropriate 
	if (!empty_fields && !errors && !errors_2 && !errors_3) {
      //alert("here " + f);
      //f.submit();
      return true;
    } else {
      msg = "_________________________________________________\n\n"
		msg += " The form: " + f.name + " was not submitted because of the following \n";
		msg += " error(s). Please correct the following error(s) and re-submit.\n";
		msg += "_________________________________________________\n\n"
		if (empty_fields) {
			msg += "- The following required field(s) are empty:" + empty_fields + "\n";
			if (errors || errors_2 || errors_3) msg += "\n";
		}
		if(ns4 || opera){
			msg += errors;
			msg += errors_2;
			msg += errors_3;
			alert(msg);
		}
		return false;
	}
	
} 
//-->