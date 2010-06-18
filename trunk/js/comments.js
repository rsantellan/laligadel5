$(document).ready(function(){
    $("#slider").easySlider({
        auto: true,
        continuous: true
    });
    $('#menu_comentarios').addClass('active');
    $('#block_add_comment').hide();
    $('#submitAjax').click(hizoClick);
});

function hizoClick(event){
    
    var name = $("#name").val();
    var email = $("#email").val();
    var comment = $("#comment").val();
    var dataString = 'name='+ name + '&email=' + email + '&comment=' + comment;
    if(name=='' || email=='' || comment=='')
    {
        alert('Falto llenar alguno de los campos');
    }else
    {
        $('#block_add_comment').fadeOut('slow', function() {
            $('#block_add_comment').hide();
        });

        $("#flash").show();
        $("#flash").fadeIn(400).html('<img src="./images/ajax-loader.gif" /><h3>Enviando mails...</h3>');
        $.ajax({
            type: "POST",
            url: "commentajax.php",
            data: dataString,
            cache: false,
            success: function(html){
                $("ol#commentsList").prepend(html);
                $("ol#commentsList li:first").fadeIn("slow");
                $("#flash").hide();
            }
        });
    }
    return false;
}




