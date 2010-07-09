$(document).ready(function(){
    $('#managePictures').addClass('current');
    $('#addButton').click(processImages);
});

function processImages(){
    var categoryId = $('#category_select').val();
    $('.checkbox').each(function(){
        if($(this).is(':checked')){
            sendData(categoryId, $(this).attr('value') );
        }
       
    });
}

function sendData(categoryId, imageId){
    var place = 'image_container_' + imageId;
    var dataString = "imageId="+imageId + "&categoryId="+ categoryId;
    $.ajax({
        type: "POST",
        url: "process/addImageToAlbum.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                var options = {};

                $('#'+place).hide('pulsate',options,'slow',callbackHide);
            }
        }

    });
}

function callbackHide(){
    $(this).remove();
}