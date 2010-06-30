/*
 * @author Rodrigo Santellan
 *
 */

$(document).ready(function(){
	startHidenContainers();
    $("#player_team_goal_form_goles").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
        // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault();
            }
        }
    });


    $('#menu_agregar_jugador').click(showAddPlayer);
    $('#menu_agregar_equipo').click(showAddTeam);
    $('#menu_agregar_ronda').click(showAddRound);
    $('#menu_agregar_team_vs_team').click(showAddTeamVsTeam);
    $('#menu_agregar_player_goal_team').click(showAddPlayerTeamGoal);

    $('#top_agregar_jugador').click(showAddPlayer);
    $('#top_agregar_equipo').click(showAddTeam);
    $('#top_agregar_ronda').click(showAddRound);
    $('#top_agregar_team_vs_team').click(showAddTeamVsTeam);
    $('#top_agregar_player_goal_team').click(showAddPlayerTeamGoal);


    $('#form_jugadores_enviar_jugador').click(agregarJugador);
    $('#form_jugadores_errors').hide();
    $('#form_equipos_enviar_equipo').click(agregarTeam);
    $('#form_equipos_errors').hide();
    $('#form_fechas_enviar_fechas').click(agregarRound);
    $('#form_fechas_errors').hide();
    $('#enviar_team_vs_team_form').click(agregarTeamVsTeam);
    $('#team_vs_team_form_fecha').change(mostrarPartidosDeLaFecha);
    $('#player_team_goal_form_enviar').click(agregarPlayerTeamGoals);
    $('#player_team_goal_form_select_team').change(showTeamGoals);
    $('#player_team_goal_form_select_round').change(showTeamGoals);
    $('#player_team_goal_form_errors').hide();
    $('#players_admin_table').click(function(){
    	$('#player_table_list').slideToggle("slow");
    });
    $('#teams_admin_table').click(function(){
    	$('#teams_table_list').slideToggle("slow");
    });
    $('#rounds_admin_table').click(function(){
    	$('#rounds_table_list').slideToggle("slow");
    });
    showTeamGoals();
    mostrarPartidosDeLaFecha();
});

function startHidenContainers(){
	$('#logos_container').hide();
	$('#logo_ok').hide();
	$('#player_table_list').hide();
	$('#addPlayer').hide();
	$('#addTeam').hide();
	$('#addRound').hide();
	$('#addTeamVsTeam').hide();
	$('#addPlayerTeamGoals').hide();
	$('#teams_table_list').hide();
	$('#rounds_table_list').hide();
}
function showAddPlayer(){
    $('#addPlayer').slideToggle("slow");
}

function showAddTeam(){
    $('#addTeam').slideToggle("slow");
}

function showAddRound(){
    $('#addRound').slideToggle("slow");
}

function showAddTeamVsTeam(){
    $('#addTeamVsTeam').slideToggle("slow");
}

function showAddPlayerTeamGoal(){
    $('#addPlayerTeamGoals').slideToggle("slow");
}

function agregarJugador(){
    var name = $('#form_jugadores_nombre_jugador').val();
    if(name == '' || name == ' '){
        $('#form_jugadores_errors').html('<h2>Nombre del jugador vacio</h2>');
        $('#form_jugadores_errors').show();
        $('#form_jugadores_errors').fadeOut(8000, function () {
            $('#form_jugadores_errors').hide();
        });
        return;
    }

    $("#form_jugadores_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');
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
                    
                $("#player_team_goal_form_select_player").append("<option value='"+data.id+"'>"+data.name+"</option>");
                $('#players_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td>...</td></tr>');
                $('#logo_ok').show();
                $('#form_jugadores_errors').html($('#logo_ok'));
                $('#form_jugadores_errors').show();
                $('#logo_ok').fadeOut(6000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });
                
            }else{
                $('#form_jugadores_errors').show();
                $('#form_jugadores_errors').html('<h2>'+data.error+'</h2>');
                $('#form_jugadores_errors').fadeOut(8000, function () {
                    $('#form_jugadores_errors').hide();
                });
            }
        }
            
    });
    $('#form_jugadores_procesando').fadeOut(6000);
}

function agregarTeam(){
    var name = $('#form_equipos_nombre_equipo').val();
    if(name == '' || name == ' '){
        $('#form_equipos_errors').html('<h2>Nombre del equipo vacio</h2>');
        $('#form_equipos_errors').show();
        $('#form_equipos_errors').fadeOut(8000, function () {
            $('#form_equipos_errors').hide();
        });
        return;
    }
    var dataString = 'name='+ name;
    $('#form_equipos_errors').hide();


    $("#form_equipos_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');
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
                $("#player_team_goal_form_select_team").append("<option value='"+data.id+"'>"+data.name+"</option>");
                $("#team_vs_team_form_equipo_2").append("<option value='"+data.id+"'>"+data.name+"</option>");
                $("#team_vs_team_form_equipo_1").append("<option value='"+data.id+"'>"+data.name+"</option>");
                
                $('#teams_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td>...</td></tr>');
                $('#logo_ok').show();
                $('#form_equipos_errors').html($('#logo_ok'));
                $('#form_equipos_errors').show();
                $('#logo_ok').fadeOut(6000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });
            }else{
                $('#form_equipos_errors').show();
                $('#form_equipos_errors').html('<h2>'+data.error+'</h2>');
                $('#form_equipos_errors').fadeOut(8000, function () {
                    $('#form_equipos_errors').hide();
                });
            }
        }

    });
    $('#form_equipos_procesando').fadeOut(6000);
}

function agregarRound(){
    var name = $('#form_fechas_nombre_fechas').val();
    if(name == '' || name == ' '){
        $('#form_fechas_errors').html('<h2>Nombre de la fecha esta vacio</h2>');
        $('#form_fechas_errors').show();
        $('#form_fechas_errors').fadeOut(8000, function () {
            $('#form_fechas_errors').hide();
        });
        return;
    }
    var dataString = 'name='+ name;
    $('#form_fechas_errors').hide();

    $("#form_fechas_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');
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
                $("#team_vs_team_form_fecha").append("<option value='"+data.id+"'>"+data.name+"</option>");
                $('#player_team_goal_form_select_round').append("<option value='"+data.id+"'>"+data.name+"</option>");
                
                $('#rounds_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td></tr>');
                $('#logo_ok').show();
                $('#form_fechas_errors').html($('#logo_ok'));
                $('#form_fechas_errors').show();
                $('#logo_ok').fadeOut(6000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });
                
            }else{
                $('#form_fechas_errors').show();
                $('#form_fechas_errors').html('<h2>'+data.error+'</h2>');
                $('#form_fechas_errors').fadeOut(8000, function () {
                    $('#form_fechas_errors').hide();
                });
            }
        }

    });
    $('#form_fechas_procesando').fadeOut(6000);
}

function agregarTeamVsTeam(){
    var team1 = $('#team_vs_team_form_equipo_1').val();
    var team2 = $('#team_vs_team_form_equipo_2').val();
    if(team1 == team2){
        $('#team_vs_team_form_errors').slideToggle("slow");
        $('#team_vs_team_form_errors').html('<h2>No puede jugar un equipo contra si mismo</h2>');
        $('#team_vs_team_form_errors').fadeOut(8000, function () {
            $('#team_vs_team_form_errors').hide();
        });
        return;
    }
    $('#team_vs_team_form_errors').hide();
    var dataString = 'equipo_1='+ team1 +'&equipo_2='+team2+'&fecha='+$('#team_vs_team_form_fecha').val();
    $("#team_vs_team_form_on_round_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');


    $('#player_team_goal_form_errors').hide();
    $.ajax({
        type: "POST",
        url: "process/agregarTeamVsTeamAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#logo_ok').show();
                $('#team_vs_team_form_on_round').html($('#logo_ok'));
                $('#logo_ok').fadeOut("slow");
                
                $('#logo_ok').fadeOut(4000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });
                mostrarPartidosDeLaFecha();
            }else{
                $('#team_vs_team_form_errors').show();
                $('#team_vs_team_form_errors').html('<h2>'+data.error+'</h2>');
                $('#team_vs_team_form_errors').fadeOut(8000, function () {
                    $('#team_vs_team_form_errors').hide();
                });
            }
        }

    });
    $('#team_vs_team_form_on_round_procesando').fadeOut(6000);
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
                $('#team_vs_team_form_errors').show();
                $('#team_vs_team_form_errors').html('<h2>'+data.error+'</h2>');
                $('#team_vs_team_form_errors').fadeOut(8000, function () {
                    $('#team_vs_team_form_errors').hide();
                });
            }
        }

    });
}

function agregarPlayerTeamGoals(){
    var team = $('#player_team_goal_form_select_team').val();
    var round = $('#player_team_goal_form_select_round').val();
    var goals = $('#player_team_goal_form_goles').val();
    var player =$('#player_team_goal_form_select_player').val();
    var dataString = 'equipo='+ team +'&fecha='+round+'&jugador='+player+'&goles='+goals;
    $('#player_team_goal_form_errors').hide();
    $("#player_team_goal_form_on_round_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');


    $.ajax({
        type: "POST",
        url: "process/agregarPlayerTeamGoalsAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#logo_ok').show();
                $('#player_team_goal_form_on_round').html($('#logo_ok'));
                $('#logo_ok').fadeOut(6000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });
                showTeamGoals();
            }else{
                $('#player_team_goal_form_errors').show();
                $('#player_team_goal_form_errors').html('<h2>'+data.error+'</h2>');
                $('#player_team_goal_form_errors').fadeOut(8000, function () {
                    $('#player_team_goal_form_errors').hide();
                });
            }
        }

    });
    $('#player_team_goal_form_on_round_procesando').fadeOut(6000);

}

function showTeamGoals(){
    var team = $('#player_team_goal_form_select_team').val();
    var round = $('#player_team_goal_form_select_round').val();

    var dataString = 'team='+ team +'&round='+round;
    $('#player_team_goal_form_errors').hide();
    $.ajax({
        type: "POST",
        url: "process/getPlayersByTeamAndRoundAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){

                $('#player_team_goal_form_on_round').html(data.body);

            }else{
                $('#player_team_goal_form_errors').show();
                $('#player_team_goal_form_errors').html('<h2>'+data.error+'</h2>');
                $('#player_team_goal_form_errors').fadeOut(8000, function () {
                    $('#player_team_goal_form_errors').hide();
                });
            }
        }

    });
}