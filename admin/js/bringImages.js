$(document).ready(function(){
    getAllImageDivs();

});

var container = new Array();
var quantity = 0;
var indice = 0;

function getAllImageDivs(){

    $('.image_container').each(function(i) {
        var position = new Array($(this).attr('id'), $(this).attr('name').substr(3), 1);
        container.push(position);
        quantity++;
    });
    quantity = quantity * 6;
    $('#image_quantity').html(quantity);
    $('#progressBar').progressbar({
			value: 0
		});
    callNext();

}

function calculateProgressBar(){
    var calculated = (indice * 100) / quantity;
    calculated = Math.round(calculated);
    if(calculated >= 100){
        calculated = 100;
    }
    $( "#progressBar" ).progressbar( "option", "value", calculated );

}

function callNext(){

    $('#image_process').html(indice);
    indice ++;
    var first = container.shift();
    ajaxCall(first[0],first[1],first[2]);
    calculateProgressBar();
}

function ajaxCall(id, name, type){
    var dataString = 'name=' + name + '&type=' + type;
    $.ajax({
        type: "POST",
        url: "process/bringImageAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#'+id).append(data.body);
                if(type == 7) return;
                var position = new Array(id, name, type + 1);
                container.push(position);
                callNext();
            }
        },
        error: function(data){
            callNext();
        }

    });
}