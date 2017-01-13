//-------------Envio de Array-----------
function ArrayJson(arr) {
	var parts = [];
	var is_list = (Object.prototype.toString.apply(arr) === '[object Array]');
	for(var key in arr) {
		var value = arr[key];
		if(typeof value == "object") { //Custom handling for arrays
			if(is_list) parts.push(ArrayJson(value)); // :RECURSION: 
			else parts[key] = ArrayJson(value); // :RECURSION: 
		} else {
			var str = "";
			if(!is_list) str = key + ":";

			//Custom handling for multiple data types
			if(typeof value == "number") str += value; //Numbers
			else if(value === false) str += 'false'; //The booleans
			else if(value === true) str += 'true';
			else str += value; //All other things
			// :TODO: Is there any more datatype we should be in the lookout for? (Functions?)

			parts.push(str);
		}
	}
	var json = parts.join(";");

	// if(is_list) return '[' + json + ']';//Return numerical JSON
	return json;//Return associative JSON
}
//-------------Fin Envio de Array-----------;


//-------------Obtener Fecha-----------
function getFecha() {
	var today = new Date();
	var dd = today.getDate(); 
	var mm = today.getMonth()+1; 
	var yyyy = today.getFullYear();
	if (dd<10){dd="0"+dd;}
	if (mm<10){mm="0"+mm;}
	return yyyy+"-"+mm+"-"+dd;
}
//-------------Fin Obtener Fecha-----------;