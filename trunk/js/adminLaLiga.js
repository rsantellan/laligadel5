/*
 * @author Rodrigo Santellan
 *
 */

$(document).ready(function(){
    $('#manager').addClass('current');
    $("#dialog").hide();
    $("#dialog_double_check").hide();

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

    $('#menu_agregar_torneo').click(showAddTournament);
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

    $('#form_tournaments_enviar_torneo').click(agregarTorneo);
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
    $('#tournaments_admin_table_link').click(function(){
        $('#tournaments_table_list').slideToggle("slow");
    });
    $("#tournament_radios").buttonset();

    loadTournamentData(true);
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
    $('#tournaments_table_list').hide();
    $('#addTournament').hide();
}

function showAddTournament(){
    $('#menu_agregar_torneo').slideToggle("slow");
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

function agregarTorneo(){
    var name = $('#form_tournaments_nombre_torneo').val();
    if(name == '' || name == ' '){
        $('#form_tournaments_errors').html('<h2>Nombre del Torneo vacio</h2>');
        $('#form_tournaments_errors').show();
        $('#form_tournaments_errors').fadeOut(8000, function () {
            $('#form_tournaments_errors').hide();
        });
        return;
    }

    $("#form_tournaments_procesando").fadeIn(400).html('<img src="../images/ajax-loader.gif" /><h3>Procesando...</h3>');
    var dataString = 'name='+ name;
    $('#form_tournaments_errors').hide();
    $.ajax({
        type: "POST",
        url: "process/agregarTorneoAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){

                //$("#player_team_goal_form_select_player").append("<option value='"+data.id+"'>"+data.name+"</option>");
                var texto = '<input type="radio" id="radio_tournament_'+data.id+'" name="tournament_radio"/> <label for="radio_tournament_'+data.id+'">'+data.name+'</label>';
                $("#tournament_radios").append(texto);
                $('#tournaments_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td><a href="javascript:void(0)" onclick="startDelete('+data.id+',-1)" >Eliminar</a></td></tr>');
                $('#logo_ok').show();
                $('#form_tournaments_errors').html($('#logo_ok'));
                $('#form_tournaments_errors').show();
                $('#logo_ok').fadeOut(6000, function () {
                    $('#logo_ok').hide();
                    $('#logos_container').append($('#logo_ok'));
                });

            }else{
                $('#form_tournaments_errors').show();
                $('#form_tournaments_errors').html('<h2>'+data.error+'</h2>');
                $('#form_tournaments_errors').fadeOut(8000, function () {
                    $('#form_tournaments_errors').hide();
                });
            }
        }

    });
    $('#form_tournaments_procesando').fadeOut(6000);
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
                $('#players_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td><a href="javascript:void(0)" onclick="startDelete('+data.id+',1)" >Eliminar</a></td></tr>');
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
                
                $('#teams_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td><a href="javascript:void(0)" onclick="startDelete('+data.id+',2)" >Eliminar</a></td></tr>');
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
    var round = $('#team_vs_team_form_fecha').val();
    if(round == null){
        $('#team_vs_team_form_errors').show();
        $('#team_vs_team_form_errors').html('<h2> No hay fecha seleccionada</h2>');
        $('#team_vs_team_form_errors').fadeOut(8000, function () {
            $('#team_vs_team_form_errors').hide();
        });
        return;
    }

    $('#team_vs_team_form_errors').hide();
    var dataString = 'equipo_1='+ team1 +'&equipo_2='+team2+'&fecha='+round;
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
    if(id == null){
        $('#team_vs_team_form_on_round').html('');
        return;
    }
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
    if(round == null){
        $('#player_team_goal_form_errors').show();
        $('#player_team_goal_form_errors').html('<h2> No hay fecha seleccionada</h2>');
        $('#player_team_goal_form_errors').fadeOut(8000, function () {
            $('#player_team_goal_form_errors').hide();
        });
        return;
    }
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
    if(round == null){
        $('#player_team_goal_form_on_round').html('');
        return;
    }
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

function startDelete(id, type){
    $("#dialog").dialog( "destroy" );
    $("#dialog").dialog({
        autoOpen: false,
        modal: true,
        resize: false,
        height: 200,
        buttons : {
            "Si" : function() {
                processDelete(id,type, false);
                $(this).dialog("close");
            },
            "No" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog").dialog("open");
}

function processDelete(id, type, strict){
    var dataString;
    if(strict){
        dataString = 'id='+ id +'&type='+type + '&strict=true';
    }else{
        dataString = 'id='+ id +'&type='+type;
    }
    
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
            switch (data.result) {
                case 1:
                    $('#'+data.place).remove();
                    break;
                case 2:
                    doubleCheckDeletion(id, type);
                default:
                    break;
            }
        }

    });
}

function doubleCheckDeletion(id, type){
    $("#dialog_double_check").dialog( "destroy" );
    $("#dialog_double_check").dialog({
        autoOpen: false,
        modal: true,
        resize: false,
        height: 200,
        buttons : {
            "Confirmar" : function() {
                processDelete(id,type, true);
                $(this).dialog("close");
            },
            "Cancelar" : function() {
                $(this).dialog("close");
            }
        }
    });

    $("#dialog_double_check").dialog("open");
}

function loadTournamentData(first){
    loadRounds();
    if(!first){
        changeActiveTournament();
    }
    
}

function changeActiveTournament(){
    var tournament = $("#tournament_radios input[name='tournament_radio']:checked").attr('value');

    var dataString = 'tournament='+ tournament;

    $.ajax({
        type: "POST",
        url: "process/changeTournamentStatusAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                var selectedId = $("#tournament_radios input[name='tournament_radio']:checked").attr('id');
                var selectedLabel = $("label[for=" + selectedId + "] span");
                $("#span_torneo_actual").html(selectedLabel.html());
            }
            
        }

    });
}

function loadRounds(){
    var tournament = $("#tournament_radios input[name='tournament_radio']:checked").attr('value');

    var dataString = 'tournament='+ tournament;

    $.ajax({
        type: "POST",
        url: "process/retrieveRoundAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                $('#team_vs_team_form_fecha').find('option').remove().end();
                $('#player_team_goal_form_select_round').find('option').remove().end();
                var x =0;
                for(x=0;x<data.list.length;x++){
                    var aux = data.list[x];
                    $("#team_vs_team_form_fecha").append("<option value='"+aux.id+"'>"+aux.name+"</option>");
                    $("#player_team_goal_form_select_round").append("<option value='"+aux.id+"'>"+aux.name+"</option>");
                }

            }
            showTeamGoals();
            mostrarPartidosDeLaFecha();
        }

    });
    
}