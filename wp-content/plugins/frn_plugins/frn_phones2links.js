//Variables in Span:
//id=frn_phones, frn_number, frn_number_style, ga_phone_category, ga_phone_location
//v. 2.1 - added frn_number formatting
//v. 2.2 - corrected use-case scenario: no number in HEAD script or in SPAN or between span, look for main variable defined elsewhere on page or define the page variable used in other places if number found
//v. 2.3 - corrected issue when the phone number in the span was defined and the overall phone variable was defined. The main variable set in the HEAD section was overriding the one inside the SPAN. Now it doesn't. This also disabled the feature that if it finds a SPAN code with our ID but it doesn't have a phone number inside it, then it would put a phone number there. Slowed down page loads unnecessarily.

jQuery(document).ready(function() {
	if(isTierIphone || isTierTablet) {
		//Since we are limiting this to mobile devices, if there is a case when the span code is on the page but there is no phone number between them then it'll stay blank. If that ever becomes important, you can remove this consideration, but add it to the portion below that creates the link.
		
		var inner_code, frn_number, frn_number_style, ga_category, ga_action, ga_trigger, frn_number_inner, frn_number_mobile, new_innerHTML;
		var frn_number_intl = "";
		var all_spans = document.getElementsByTagName("span");
		
		//Makes sure our phone SPAN is somewhere in the page. Used to disable entire page scanning and to process individually below.
		for (var s = 0, len = all_spans.length; s < len; s++) {
			if(all_spans[s].getAttribute("id")!=null) {
				   if(all_spans[s].getAttribute("id")=="frn_phones") {
						var phone_spans="present";
						//if present, it'll shut down any entire page scanning for phone numbers since so intensive on a browser and the SPAN code already on the page gets messed up

				   }
			}
		}
		//See if (1) scanning everything between the <body> tags is turned on (i.e. if "frn_phone_autoscan=yes" is in the footer), (2) no phone SPAN ids are on the page already, and (3) that the browser is mobile
		//running entire page scan only if a mobile device is viewing the page to reduce browser load for desktops
		if((typeof frn_phone_autoscan != 'undefined') && typeof phone_spans == 'undefined') {  // 
			var patternsg = /(\s|\(|\[|\>)\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}(\s|\)|\]|\.|\<)/g;
			var patternm = /\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}/;
			var ga_category;
			var ga_action;
			var ga_label;
			var ga_trigger;
			var body = document.body.innerHTML;
			var matches = body.match(patternsg);
			for (var n = 0, len = matches.length; n < len; n++) {
				//Pull values for event tracking in case we want to customize the settings, else set defaults.
				var phone_matches = matches[n].match(patternm);
				var phone_actual = phone_matches[0];
				//alert(phone_actual);
				ga_category="Phone Numbers";
				ga_action="Phone Clicks (General)";
				ga_label=phone_actual;
				ga_trigger="_gaq.push(['_trackEvent', '" +ga_category+ "', '" +ga_action+ "', '" +ga_label+ "']);";
				frn_phoneBasic =  phone_actual.replace("-","");
				frn_phoneBasic =  frn_phoneBasic.replace(/[^0-9]/g,'');
				body = body.replace(phone_actual,'<a href="tel:' +frn_phoneBasic+ '" onClick="' +ga_trigger+ '" style="white-space:nowrap;">'+phone_actual+"</a>");
			}
			if(body.trim()!="") document.body.innerHTML = body;
		}
		
		
		//If phone_spans were found on the page, then process like normal.
		if(typeof phone_spans != 'undefined') {
			
			if(typeof frn_phoneBasic==='undefined') frn_phoneBasic="";
			
			//if a SPAN with our frn_phone ID is found (whether autoscan is on or not), then cycle through the SPANs again but this time store/change the numbers in the SPANs
			for (var i = 0, len = all_spans.length; i < len; i++) {
			   if(all_spans[i].getAttribute("id")!=null) {
				   if(all_spans[i].getAttribute("id")=="frn_phones") {
					
					//Store the values
					frn_number = all_spans[i].getAttribute("frn_number");  //uses this instead of what's in spans--helps with images
					frn_number_intl = all_spans[i].getAttribute("intl_prefix");
						if(frn_number_intl==null) frn_number_intl="";
						if(frn_number_intl.trim()!="") frn_number_intl=frn_number_intl.trim() + " ";
					inner_code = all_spans[i].innerHTML;
					
					if(frn_number==null && inner_code!=null) {
						//If number is not in the SPAN, then search between the SPAN tags for a phone number pattern
						//pattern searching really only helps if all digits are together -- doesn't really work with R&T.com since the international code is so far before the phone number returned by ifbyphone
						//pattern searching does allow us to link more than just a phone number while still pulling out the phone number from the content
						var patterns = new RegExp(/\d?(\s?|-?|\+?|\.?)((\(\d{1,4}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)((\(\d{1,3}\))|(\d{1,3})|\s?)(\s?|-?|\.?)\d{3}(-|\.|\s)\d{4}/);
						frn_number_inner = patterns.exec(inner_code);
						if(frn_number_inner) frn_number = frn_number_inner[0];
						if(!frn_number) frn_number = "";
						//alert(frn_number);
						
						/*
						Will not work with letters (helps with pattern identification and mobile conversions)
						You can change out dashes for spaces or periods
						International:
						0 000 (000) 000-0000
						000 (000) 000-0000
						0-000-000-000-0000
						000 (000) 000-0000
						000-000-000-0000
						000-00-0-000-0000
						0000-00-0-000-0000
						+000-000-000-0000
						
						U.S. Versions:
						0 (000) 000-0000
						+0-000-000-0000
						0-000-000-0000
						000-000-0000
						(000) 000-0000
						000-0000
						
						These are found, but are incorrect formats: Basically, make sure you don't have a dash, space, plus sign, or period before number or this will pull it in.
						   0-000-0000
						   -0-000-0000
						   -0-000-000-0000
						   -0 (000) 000-0000
						   +000 00-0-000-0000
						   3456789012345-6789
						*/
						
						//Old way:
						//frn_number.replace(frn_phoneFormat,'$1-$2-$3-$4');}
						//frn_number = inner_code.replace(/[^0-9]/g,'');
						
					}
					
					//the number is set in the SPAN code or in between the SPANs
					//sets global variable with the last number on page in order for other SPANs to use or the slideout
					if(frn_number.trim()!="" && frn_phoneBasic=="") {
						frn_phoneBasic =  frn_number.replace("-","");
						frn_phoneBasic =  frn_phoneBasic.replace(/[^0-9]/g,'');
						if(frn_phoneBasic.slice(0,3)!=frn_number_intl.slice(0,3)) frn_phoneBasic =  frn_number_intl + frn_phoneBasic;	
					}
					else if(frn_phoneBasic!="" && frn_number.trim()=="") {
						//if the number isn't set in the SPAN and isn't between the span, see if the page variable is set
						frn_number=frn_phoneBasic;
					}
					frn_number =  frn_number.replace("-","");
					frn_number =  frn_number.replace(/[^0-9]/g,'');
					if(frn_number.slice(0,3)!=frn_number_intl.slice(0,3)) frn_number =  frn_number_intl + frn_number;	
					
					//Due to the processing heavy element of this feature already and slowing page loading, this portion has been discontinued.
					//if it's a mobile device or inner code was blank and there was a number defined somewhere, put something between the SPANs or at least format the number for mobile link
					//if((inner_code.trim()=="") && frn_number!="") { //	isTierIphone || isTierTablet || 
						
						//Re-format the phone to work best with all phones by adding dashes in the right places no matter how many digits
						if(frn_number!="")  {
							if(frn_number.length==11) {frn_phoneFormat = /^1?(\d)([0-9]..)([0-9]..)([0-9]...)$/; //starts with 1
							  frn_number_mobile = frn_number.replace(frn_phoneFormat,'$1-$2-$3-$4');}
							else if(frn_number.length==10) {frn_phoneFormat = /([0-9]..)([0-9]..)([0-9]...)$/; //doesn't start with 1
							  frn_number_mobile = frn_number.replace(frn_phoneFormat,'1-$1-$2-$3');}
							else if(frn_number.length==13){frn_phoneFormat = /([0-9]..)([0-9]..)([0-9]..)([0-9]...)$/; //international
							  frn_number_mobile = frn_number.replace(frn_phoneFormat,'$1-$2-$3-$4');}
							else if(frn_number.length>=14 && frn_phoneBasic.slice(0,1)!="("){frn_phoneFormat = /([0-9]...)([0-9]..)([0-9]..)([0-9]...)$/; //international
							  frn_number_mobile = frn_number.replace(frn_phoneFormat,'$1-$2-$3-$4');}
						}
						//if((inner_code.trim()=="")) {  //&& (!isTierIphone || !isTierTablet)  //if not mobile but inner code between spans is blank, then replace with number
						//	all_spans[i].innerHTML=frn_number_mobile;
						//}
					//}
					
					if(frn_number_mobile!="") { //(isTierIphone || isTierTablet) && 
						//If it's blank then just do nothing.
						
						//Pull values for event tracking in case we want to customize the settings, else set defaults.
						frn_number_style = all_spans[i].getAttribute("frn_number_style");
							if(frn_number_style!=null) frn_number_style = 'style="' + frn_number_style + '" ';
							else frn_number_style="";
						ga_category =      all_spans[i].getAttribute("ga_phone_category");
							if(ga_category==null) ga_category="Phone Numbers";
							if(ga_category=="") ga_category="Phone Numbers";
						ga_action =        all_spans[i].getAttribute("ga_phone_location");
							if(ga_action==null) ga_action="Phone Clicks (General)";
							if(ga_action=="") ga_action="Phone Clicks (General)";
						ga_label =        all_spans[i].getAttribute("ga_phone_label");
							if(ga_label==null) ga_label="Calls";
							if(ga_label=="") ga_label="Calls";
							if(ga_label=="include_phone") ga_label=frn_number_mobile;
						
						//if(inner_code.trim()=="" && frn_number_mobile!="") inner_code=frn_number_mobile;
						//if(frn_number_mobile=="" && frn_number!="") frn_number_mobile=frn_number;
						
						if(inner_code!="") {
							//rebuild the content between the span tags but with a link this time
							ga_trigger="_gaq.push(['_trackEvent', '" +ga_category+ "', '" +ga_action+ "', '" +ga_label+ "']);";
							new_innerHTML='<a href="tel:' +frn_number_mobile+ '" ' +frn_number_style+ 'onClick="' +ga_trigger+ '">' +inner_code+ '</a>';
						}
						else new_innerHTML="";
						all_spans[i].innerHTML=new_innerHTML;
						
					}
					
					//if the phone number shouldn't be in the LHN slideout, then clear the variable. Helpful for R&T.com.
					if(all_spans[i].getAttribute("lhn_tab_disabled")) frn_phoneBasic="";
					//alert("New Inner: " + new_innerHTML + "; Old Inner: " + inner_code + "; frn_number: " + frn_number_mobile + "; category: " + ga_category + "; action: " + ga_action);
				   }
			   }
			}
		}
	}
});