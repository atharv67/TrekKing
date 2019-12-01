function validate(thisform){
	var pass1=thisform.password.value;
	var pass2=thisform.verpass.value;
	var height=thisform.height.value;
	var weight=thisform.weight.value;
	var phno=thisform.phno.value;
	var aphno=thisform.aphno.value;
	console.log(pass1,pass2,height,weight,phno,aphno);
	if (pass1.length<7||pass1.length>20) {
		document.getElementById("alert6").innerHTML="Password should be greater than 7 and less than 20 characters";
		return false;
	}
	else{
		document.getElementById("alert1").innerHTML="";
	}
	if (pass1!==pass2) {
		document.getElementById("alert1").innerHTML="Both passwords do-not match";
		return false;
	}
	else{
		document.getElementById("alert1").innerHTML="";
	}
	if(isNaN(height)||isNaN(weight)){
		document.getElementById("alert2").innerHTML="Height and Weight should be a number";
		return false;
	}
	else{
		document.getElementById("alert2").innerHTML="";
	}
	if(isNaN(phno)||phno.length<10){
		document.getElementById("alert3").innerHTML="Check contact no.";
		return false;
	}
	else{
		document.getElementById("alert3").innerHTML="";
	}
	if(isNaN(aphno)||aphno.length<10){
		document.getElementById("alert3").innerHTML="Check alternate contact no.";
		return false;
	}
	else{
		document.getElementById("alert1").innerHTML="";
	}

	return true;
	}
	

	// function checkpass(){
	// 	var pass1=getElementById("pass").value;
	// 	console.log(pass1);
	// 	if (pass1.length<7||pass1.length>20) {
	// 	document.getElementById("alert6").innerHTML="Password should be greater than 7 and less than 20 characters";
	// }
	// else{
	// 	document.getElementById("alert6").innerHTML="";
	// }

	// }
	// function checkequal(){
	// 	var pass1=getElementById("pass").value;
	// 	var pass2=getElementById("verpass").value;
	// 	console.log(pass1,pass2);
	// 	if (pass1!==pass2) {
	// 	document.getElementById("alert1").innerHTML="Both passwords do-not match";
	// }
	// else{
	// 	document.getElementById("alert1").innerHTML="";
	// }

	// }
	// function checkheight(){
	// 	var height=getElementById("height").value;
	// 	console.log(height);
	// 	if(isNaN(height)){
	// 	document.getElementById("alert2").innerHTML="Height should be a number";
	// }
	// else{
	// 	document.getElementById("alert2").innerHTML="";
	// }
	// }
	// function checkheight(){
	// 	var weight=getElementById("weight").value;
	// 	console.log(weight);
	// 	if(isNaN(weight)){
	// 	document.getElementById("alert2").innerHTML="weight should be a number";
	// }
	// else{
	// 	document.getElementById("alert2").innerHTML="";
	// }
	// }
	// function checkphoneno{
	// 	var phno=getElementById("phno").value;
	// 	console.log(phno);
	// 	if(isNaN(phno)||phno.length<10){
	// 	document.getElementById("alert3").innerHTML="Check contact no.";
	// }
	// else{
	// 	document.getElementById("alert3").innerHTML="";
	// }
	// }
	// function checkaphno{
	// 	var aphno=getElementById("aphno").value;
	// 	console.log(aphno);
	// 	if(isNaN(aphno)||aphno.length<10){
	// 	document.getElementById("alert3").innerHTML="Check contact no.";
	// }
	// else{
	// 	document.getElementById("alert3").innerHTML="";
	// }
	// }