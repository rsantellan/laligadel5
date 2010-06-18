/*
 * @author Rodrigo Santellan
 *
 */

$(document).ready(function(){
    $('#form_jugadores_enviar_jugador').click(agregarJugador);
    $('#form_jugadores_errors').hide();
    $('#form_equipos_enviar_equipo').click(agregarTeam);
    $('#form_equipos_errors').hide();
    $('#form_fechas_enviar_fechas').click(agregarRound);
    $('#form_fechas_errors').hide();
    $('#enviar_team_vs_team_form').click(agregarTeamVsTeam);
    $('#team_vs_team_form_fecha').change(mostrarPartidosDeLaFecha);
});

function agregarJugador(){
    var name = $('#form_jugadores_nombre_jugador').val();
    if(name == '' || name == ' '){
        $('#form_jugadores_errors').show();
        $('#form_jugadores_errors').html('<h2>Nombre del jugador vacio</h2>');
        return;
    }
    var dataString = 'name='+ name;
    $('#form_jugadores_errors').hide();
    $.ajax({
            type: "POST",
            url: "process/agregarJugadorAjax.php",
            data: dataString,
            dataType: "json",
            beforeSend: function(x) {
                if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(data){
                if(data.result == 1){
                    
                    console.log(data);
                    
                }else{
                    $('#form_jugadores_errors').show();
                    $('#form_jugadores_errors').html('<h2>'+data.error+'</h2>');
                }
            }
            
        });
}

function agregarTeam(){
    var name = $('#form_equipos_nombre_equipo').val();
    if(name == '' || name == ' '){
        $('#form_equipos_errors').show();
        $('#form_equipos_errors').html('<h2>Nombre del equipo vacio</h2>');
        return;
    }
    var dataString = 'name='+ name;
    $('#form_equipos_errors').hide();
    $.ajax({
            type: "POST",
            url: "process/agregarTeamAjax.php",
            data: dataString,
            dataType: "json",
            beforeSend: function(x) {
                if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(data){
                if(data.result == 1){

                    console.log(data);
                    team_vs_team_form_equipo_2
                }else{
                    $('#form_equipos_errors').show();
                    $('#form_equipos_errors').html('<h2>'+data.error+'</h2>');
                }
            }

        });
}

function agregarRound(){
    var name = $('#form_fechas_nombre_fechas').val();
    if(name == '' || name == ' '){
        $('#form_fechas_errors').show();
        $('#form_fechas_errors').html('<h2>Nombre de la fecha esta vacio</h2>');
        return;
    }
    var dataString = 'name='+ name;
    $('#form_fechas_errors').hide();
    $.ajax({
            type: "POST",
            url: "process/agregarRoundAjax.php",
            data: dataString,
            dataType: "json",
            beforeSend: function(x) {
                if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(data){
                if(data.result == 1){

                    console.log(data);
                    $("#team_vs_team_form_fecha").append("<option value='"+data.id+"'>"+data.name+"</option>");
                }else{
                    $('#form_equipos_errors').show();
                    $('#form_equipos_errors').html('<h2>'+data.error+'</h2>');
                }
            }

        });
}

function agregarTeamVsTeam(){
    console.log('aca va algo ajax!!');
        

}

function mostrarPartidosDeLaFecha(){
    var id = $('#team_vs_team_form_fecha').val();
    var dataString = 'id='+ id;
    $('#form_fechas_errors').hide();
    $.ajax({
            type: "POST",
            url: "process/getTeamVsTeamByRoundAjax.php",
            data: dataString,
            dataType: "json",
            beforeSend: function(x) {
                if(x && x.overrideMimeType) {
                    x.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(data){
                if(data.result == 1){

                    $('#team_vs_team_form_on_round').html(data.body);

                }else{
                    $('#form_equipos_errors').show();
                    $('#form_equipos_errors').html('<h2>'+data.error+'</h2>');
                }
            }

        });
}