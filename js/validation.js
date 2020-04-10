/*! MRNS
* ===============
*application responsible for validating the forms
* @Author  Gabriel González
* @Email   <gabrielgonzalez1802@gmail.com>
* @version 1.0.0
*/

/**
* check if a blood group can be created
* @param e event
* @param String nf name of the form
* @param String input name to validate
* @param String divID name of the Div
* @param String spanIcon span Icon ID
* @param String msj Error message ID
* @param String actions - button ID
*/
function sizeLimit(e, nF, input, divID, spanIcon, msj, actions, maxi){
	var valueForm = document.forms[nF][input].value;
	var size = valueForm.length + 1;
	var max = maxi+1;
	var teclaBorrado = 8;
	var tecla = (document.all) ? e.keyCode : e.which; 

    if (tecla!=teclaBorrado){
    	document.getElementById(actions).disabled = false;
    	//Verifica que el tamaño de caracteres sea menor al size 
		if(size < max){
			document.getElementById(divID).className = "form-group has-success has-feedback";
			document.getElementById(msj).innerHTML = "";
			document.getElementById(spanIcon).className = "fa fa-check txt-success form-control-feedback";
			document.getElementById(actions).disabled = false;
		}else{
			document.getElementById(msj).innerHTML = "M&aacute;ximo " + maxi + " caracteres";
			document.getElementById(divID).className = "form-group has-error has-feedback"
			document.getElementById(spanIcon).className = "fa fa-times txt-error form-control-feedback";
			document.getElementById(actions).disabled = true;
		}
    }else{
    	size-=2;
    	if(size < max){
			document.getElementById(divID).className = "form-group has-success has-feedback";
			document.getElementById(msj).innerHTML = "";
			document.getElementById(spanIcon).className = "fa fa-check txt-success form-control-feedback";
			document.getElementById(actions).disabled = false;
		}else{
			document.getElementById(msj).innerHTML = "M&aacute;ximo " + maxi + " caracteres";
			document.getElementById(divID).className = "form-group has-error has-feedback";
			document.getElementById(spanIcon).className = "fa fa-times txt-error form-control-feedback";
			document.getElementById(actions).disabled = true;
		}
    } 
    size=0;
}

/**
* check if a blood group can be created
* @param e event
* @param String nf name of the form
* @param String input name to validate
* @param String divID name of the Div
* @param String spanIcon span Icon ID
* @param String msj Error message ID
* @param String actions - button ID
*/
function notNull(e, nF, input, divID, spanIcon, msj, actions){
	var valueForm = document.forms[nF][input].value;
	var size = valueForm.length+1;
	var teclaBorrado = 8;
	var tecla = (document.all) ? e.keyCode : e.which; 
	if (tecla==teclaBorrado){
		size-=2;
		if(size <= 0){
			document.getElementById(divID).className = "form-group has-error has-feedback";
			document.getElementById(spanIcon).className = "fa fa-times txt-error form-control-feedback";
			document.getElementById(msj).innerHTML = "No se admite datos nulos";
			document.getElementById(actions).disabled = true;
		}
	}
    size=0;
}

/*
 * Valida
 */
function validarPatient(f){
	if(f.firstName.value == "") {
//		has-success has-feedback
		alert("hola");
			if(f.first_name.value==""){
				document.getElementById("first_name_div").className = "col-sm-4 has-error has-feedback";
				document.getElementById("first_name").className="has-error";
			}
			if(f.second_name.value==""){
				document.getElementById("second_name_div").className = "col-sm-4 has-error has-feedback";
				document.getElementById("second_name").className="has-error";
			}
		}
	return false;
}

/**
* verify that the first character is not null
* @param e event
* @param String nf name of the form
* @param String input name to validate
* @param String divID name of the Div
* @param String spanIcon span Icon ID
* @param String msj Error message ID
* @param String actions - button ID
*/
function notFirstNull(divID, spanIcon, msj, actions, maxi){
	var character1 = document.getElementsByName(input)[0].value;
	if(character1==''){
		notFirstNull(divID, spanIcon, msj, actions, maxi);
	}
	document.getElementById(msj).innerHTML = "El primer caracter no puede ser un espacio en blanco";
	document.getElementById(divID).className = "form-group has-error has-feedback"
	document.getElementById(spanIcon).className = "fa fa-times txt-error form-control-feedback";
	document.getElementById(actions).disabled = true;
}