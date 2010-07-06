/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){

    $('#addCategory').addClass('current');
    $("#dialog").hide();

});

function saveForm(){
    var name = $('#nombre').val();
    if(name == '' || name == ' '){
        $('#errores').html('<h2>Nombre de la categoria vacio</h2>');
        $('#errores').show();
        $('#errores').fadeOut(8000, function () {
            $('#errores').hide();
        });
        return;
    }

    $("#errores").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');
    var visibilidad = $('#visibilidad').is(':checked');
    var dataString = 'name='+ name + '&visibilidad='+visibilidad;

    $.ajax({
        type: "POST",
        url: "process/agregarCategoriaAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#category_admin_table tr:last').after(data.body);
            }else{

        }
        }

    });
    $('#errores').fadeOut(600);
}

function deleteCategory(id){

    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
        resize: false,
        height: 200,
        buttons : {
            "Si" : function() {
                processDelete(id);
                $(this).dialog("close");
            },
            "No" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
}

function processDelete(id){

    var place = "category_tr_" + id;
    //console.log(place);
    var dataString = 'id='+ id+'&type=4';
    $.ajax({
        type: "POST",
        url: "process/deleteProcessAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#'+place).remove();
            //console.log($('#'+place));

            }else{

        }
        }

    });
}
function changeVisibility(object, id){
    var value = 0;
    //console.log($(object).is(':checked'));
    if($(object).is(':checked')){
        value = 1;
    }
    var dataString = 'id='+ id + '&visibilidad='+value;
    //console.log(dataString);
    
    $.ajax({
        type: "POST",
        url: "process/makeVisibleCategoriaAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){

            }else{

        }
        }

    });
}