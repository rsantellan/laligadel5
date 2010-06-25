/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function set_votes(widget) {

    var avg = $(widget).data('fsr').whole_avg;
    var votes = $(widget).data('fsr').number_votes;
    var exact = $(widget).data('fsr').dec_avg;

    window.console && console.log('and now in set_votes, it thinks the fsr is ' + $(widget).data('fsr').number_votes);

    $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
    $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
    $(widget).find('.total_votes').text( votes + ' votes recorded (' + exact + ' rating)' );
}


function startRatings(){
//    $('.rate_widget').each(function(i) {
//
//        var widget = this;
//        var out_data = {
//            widget_id : $(widget).attr('id'),
//            fetch: 1
//        };
//    });

    // This actually records the vote
    $('.ratings_stars').bind('click', function() {
        var star = this;
        var widget = $(this).parent().parent();
        var clicked_data = {
            clicked_on : $(star).attr('class'),
            widget_id : $(star).parent().parent().attr('id'),
            object_id : $(star).parent().parent().attr('object_id'),
            rating: $(star).attr('rating')
        };
        var dataString = "teamId="+ clicked_data.object_id + "&rating="+clicked_data.rating;
        $.ajax({
            type: "POST",
            url: "ajax/rateTeamOfTheRound.php",
            data: dataString,
            dataType: "json",
            beforeSend: function(x) {
                if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(data){
                if(data.result == 1){
                    widget.parent().html(data.body);
                    
                }else{
                    alert('Mmmm hubo un pequeño error... Intenta de nuevo...')
                }
            }

        });
    });
}