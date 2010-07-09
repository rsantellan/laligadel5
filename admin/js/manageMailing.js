function changeMailingStatus(element,id){
    var valor = 0;
    if($(element).is(':checked')){
        valor = 1;
    }

    var dataString = 'id='+ id + '&valor='+valor;

    $.ajax({
        type: "POST",
        url: "process/cambiarEstadoMailUsuarioAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#mailing_table_body tr:first').before(data.body);
            }else{

        }
        }

    });
}

function saveForm(){
    var name = $('#nombre').val();
    if(name == '' || name == ' '){
        $('#errores').html('<h2>Mail vacio</h2>');
        $('#errores').show();
        $('#errores').fadeOut(8000, function () {
            $('#errores').hide();
        });
        return;
    }

    if(!echeck(name)){
        $('#errores').html('<h2>Mail invalido</h2>');
        $('#errores').show();
        $('#errores').fadeOut(8000, function () {
            $('#errores').hide();
        });
        return;
    }
    $("#errores").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');

    var dataString = 'email='+ name;

    $.ajax({
        type: "POST",
        url: "process/agregarMailUsuarioAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#mailing_table_body tr:first').before(data.body);
            }else{

        }
        }

    });
    $('#errores').fadeOut(600);
}

/**
 * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */

function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    return false
		 }

		 if (str.indexOf(" ")!=-1){
		    return false
		 }

 		 return true
	}