



function showhide(layer_id) {
		var show_object = document.getElementById(layer_id).style.display;
		if(show_object=="none" || show_object=="") document.getElementById(layer_id).style.display="block";
		else document.getElementById(layer_id).style.display="none";
	}
	
function selectText(containerid) {
	if (document.selection) {
		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(containerid));
		range.select();
	} else if (window.getSelection) {
		var range = document.createRange();
		range.selectNode(document.getElementById(containerid));
		window.getSelection().addRange(range);
	}
}

function disable_ga_features(input,input2) {
	//disable and uncheck both inputs
	field=document.getElementById(input);
	field.disabled = true;
	field.checked = false;
	field2=document.getElementById(input2);
	field2.disabled = true;
	field2.checked = true;
}

function enable_ga_features(input,input2) {
	//disable and uncheck both inputs
	field=document.getElementById(input);
	field.disabled = false;
	field2=document.getElementById(input2);
	field2.disabled = false;
}