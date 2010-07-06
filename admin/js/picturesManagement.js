/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

pictureManagement = {};

pictureManagement.dropElement = function(event, ui) {
    var selectedItem = ui.draggable;

    selectedItem.fadeOut(1000, function () {
        selectedItem.show();
    });
    var dropableArea = $(this);

    if($(this).attr('placeId') != -1){
        pictureManagement.proccessImage(selectedItem, dropableArea, selectedItem.attr('imageId'), $(this).attr('placeId'));
    }else{
        $("#trash_image_container").append(selectedItem);
        selectedItem.show();
        pictureManagement.changeImageSrc(selectedItem, selectedItem.attr('imageId'));
    }
    
//console.log(selectedItem.find('img').attr("src"));
}

pictureManagement.proccessImage = function (draggable, droppable, imageId, categoryId){
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
                
                if(categoryId == 0){
                    $('#images_not_used_container').append(draggable);
                    pictureManagement.changeImageBigSrc(draggable, imageId);
                }else{
                    droppable.append(draggable);
                    pictureManagement.changeImageSrc(draggable, imageId);
                    
                }

                draggable.show();
            }else{
                draggable.show();
            }
        }

    });
}

pictureManagement.changeImageBigSrc = function (draggable, imageId){
    var dataString = "bigChangeImageId="+imageId;
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
                draggable.addClass('image_div');
                draggable.removeClass('image_div_on_container');
                draggable.html(data.body);
            }
        }

    });
}

pictureManagement.changeImageSrc = function (draggable, imageId){
    var dataString = "changeImageId="+imageId;
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
                draggable.removeClass('image_div');
                draggable.addClass('image_div_on_container');
                draggable.html(data.body);
            }
        }

    });
}

pictureManagement.startDeleteImages = function(){
    
    $('#delete_confirmation').show();
    $('#start_delete_images').hide();
}

pictureManagement.cancelDeleteImages = function(){

    $('#delete_confirmation').hide();
    $('#start_delete_images').show();
}

pictureManagement.processDeleteImages = function(id, element){

    var dataString = "imageId="+id;
    $.ajax({
        type: "POST",
        url: "process/removeImage.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                element.fadeOut(1500, function () {
                    element.remove();
                });
                
            }else{
                
        }
        }

    });
}
pictureManagement.deleteImages = function(){
    var list = $('#trash_image_container').find('div');
    var x;
    for( x=0;x<list.length;x++){
        var id = $(list[x]).attr('imageId');
        pictureManagement.processDeleteImages(id,$(list[x]));
    }
    pictureManagement.cancelDeleteImages();
}

pictureManagement.bootstrap = function() {
    $('.image_draggable').draggable({
        containment: $('#container'),
        opacity: 0.7,
        revert: true,
        cursorAt : {
            top:0,
            left:0
        }
    });

    $('.category_holder').droppable({
        drop : pictureManagement.dropElement,
        hoverClass : 'item-arrived'
    });
    $('.container_images_not_used').droppable({
        drop : pictureManagement.dropElement,
        hoverClass : 'item-arrived'
    });

    $('.trash_droppable').droppable({
        drop : pictureManagement.dropElement,
        hoverClass : 'item-arrived'
    });

    $('#start_delete_images').click(pictureManagement.startDeleteImages);
    $('#cancel_delete_images').click(pictureManagement.cancelDeleteImages);
    $('#finish_delete_images').click(pictureManagement.deleteImages);
}