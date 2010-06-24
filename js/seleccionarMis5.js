
seleccionarMis5 = {}; // declare namespace

seleccionarMis5.counter = 0;

seleccionarMis5.goaly = 0;

seleccionarMis5.defender_left =0;

seleccionarMis5.defender_right =0;

seleccionarMis5.attacker_left =0;

seleccionarMis5.attacker_right =0;

seleccionarMis5.belongToOther = function(id){
    if(seleccionarMis5.defender_left == id){
        return true;
    }
    if(seleccionarMis5.defender_right == id){
        return true;
    }
    if(seleccionarMis5.attacker_left == id){
        return true;
    }
    if(seleccionarMis5.attacker_right == id){
        return true;
    }
    if(seleccionarMis5.goaly == id){
        return true;
    }
    return false;
}

seleccionarMis5.allfilled = function(){
    if(seleccionarMis5.defender_left == 0){
        return false;
    }
    if(seleccionarMis5.defender_right == 0){
        return false;
    }
    if(seleccionarMis5.attacker_left == 0){
        return false;
    }
    if(seleccionarMis5.attacker_right == 0){
        return false;
    }
    if(seleccionarMis5.goaly == 0){
        return false;
    }
    return true;
}


seleccionarMis5.dropGoaly = function(event, ui) {

	 //console.log("We are:" + this);

         // Hide help text
	$('.selected-plan .help-text').remove();

	// Make item available in the basker
	var selectedItem = ui.draggable;
        
        var id = selectedItem.attr('id');
        if(seleccionarMis5.belongToOther(id)){
            return;
        }

        if(seleccionarMis5.goaly != 0){
            $('#players').append($('#'+seleccionarMis5.goaly));
			$('#'+seleccionarMis5.goaly).removeClass('playerOnBox');
        }
        seleccionarMis5.goaly = id;

        //$('#selectedGoaly').text(id);
       //console.log("Selected goaly:" + seleccionarMis5.goaly);
		selectedItem.addClass('playerOnBox');
	$('#goaly').append(selectedItem);

        // Closure function which handles removing of the created basket item
	function remove() {
                $('#players').append(selectedItem);
				selectedItem.removeClass('playerOnBox');
                seleccionarMis5.goaly = 0;
	}

	// bind click even for the remove item
	$(selectedItem).find('.remove').click(remove);
};


seleccionarMis5.dropDefenderLeft = function(event, ui) {

	 //console.log("We are:" + this);

         // Hide help text
	$('.selected-plan .help-text').remove();

	// Make item available in the basker
	var selectedItem = ui.draggable;

        var id = selectedItem.attr('id');
        if(seleccionarMis5.belongToOther(id)){
            return;
        }

        if(seleccionarMis5.defender_left != 0){
            $('#players').append($('#'+seleccionarMis5.defender_left));
			$('#'+seleccionarMis5.defender_left).removeClass('playerOnBox');
        }
        seleccionarMis5.defender_left = id;

        //$('#selected_defense_left').text(id);
        
       //console.log("Selected goaly:" + seleccionarMis5.goaly);
		selectedItem.addClass('playerOnBox');
	$('#defense_left').append(selectedItem);
        //selectedItem.disable();
        // Closure function which handles removing of the created basket item
	function remove() {
                $('#players').append(selectedItem);
				selectedItem.removeClass('playerOnBox');
                seleccionarMis5.defender_left =0;
	}

	// bind click even for the remove item
	$(selectedItem).find('.remove').click(remove);
};

seleccionarMis5.dropDefenderRight = function(event, ui) {

	 //console.log("We are:" + this);

         // Hide help text
	$('.selected-plan .help-text').remove();

	// Make item available in the basker
	var selectedItem = ui.draggable;

        var id = selectedItem.attr('id');
        if(seleccionarMis5.belongToOther(id)){
            return;
        }

        if(seleccionarMis5.defender_right != 0){
            $('#players').append($('#'+seleccionarMis5.defender_right));
			$('#'+seleccionarMis5.defender_right).removeClass('playerOnBox');
        }
        //$('#selected_defense_right').text(id);

        seleccionarMis5.defender_right = id;

       //console.log("Selected goaly:" + seleccionarMis5.goaly);
		selectedItem.addClass('playerOnBox');
	$('#defense_right').append(selectedItem);
        //selectedItem.disable();
        // Closure function which handles removing of the created basket item
	function remove() {
                $('#players').append(selectedItem);
                seleccionarMis5.defender_right =0;
				selectedItem.removeClass('playerOnBox');
	}

	// bind click even for the remove item
	$(selectedItem).find('.remove').click(remove);
};

seleccionarMis5.dropAttackerLeft = function(event, ui) {

	 //console.log("We are:" + this);

         // Hide help text
	$('.selected-plan .help-text').remove();

	// Make item available in the basker
	var selectedItem = ui.draggable;

        var id = selectedItem.attr('id');
        if(seleccionarMis5.belongToOther(id)){
            return;
        }

        if(seleccionarMis5.attacker_left != 0){
            $('#players').append($('#'+seleccionarMis5.attacker_left));
			$('#'+seleccionarMis5.attacker_left).removeClass('playerOnBox');
        }
        seleccionarMis5.attacker_left = id;

        //$('#selected_attacker_left').text(id);
       //console.log("Selected goaly:" + seleccionarMis5.goaly);
		selectedItem.addClass('playerOnBox');
	$('#attacker_left').append(selectedItem);
        //selectedItem.disable();
        // Closure function which handles removing of the created basket item
	function remove() {
                $('#players').append(selectedItem);
                seleccionarMis5.attacker_left =0;
				selectedItem.removeClass('playerOnBox');
	}

	// bind click even for the remove item
	$(selectedItem).find('.remove').click(remove);
};


seleccionarMis5.dropAttackerRight = function(event, ui) {

	 //console.log("We are:" + this);

         // Hide help text
	$('.selected-plan .help-text').remove();

	// Make item available in the basker
	var selectedItem = ui.draggable;

        var id = selectedItem.attr('id');
        if(seleccionarMis5.belongToOther(id)){
            return;
        }

        if(seleccionarMis5.attacker_right != 0){
            $('#players').append($('#'+seleccionarMis5.attacker_right));
			$('#'+seleccionarMis5.attacker_right).removeClass('playerOnBox');
        }
        seleccionarMis5.attacker_right = id;

        //$('#selected_attacker_right').text(id);

       //console.log("Selected goaly:" + seleccionarMis5.goaly);
		selectedItem.addClass('playerOnBox');
	$('#attacker_right').append(selectedItem);
        //selectedItem.disable();
        // Closure function which handles removing of the created basket item
	function remove() {
                $('#players').append(selectedItem);
                seleccionarMis5.attacker_right =0;
				selectedItem.removeClass('playerOnBox');
	}

	// bind click even for the remove item
	$(selectedItem).find('.remove').click(remove);
};

seleccionarMis5.enviar = function() {
	if(!seleccionarMis5.allfilled()){
		alert("Tienes que llenar todas las posiciones");
	}else{

		var nombre = $("#text_person_name").val();
		if(nombre == '' || nombre == ' '){
            alert('Tienes que ingresar un nombre');
            return;
        }
        var roundId = $("#round_id").val();
        var dataString = "round_id="+roundId+"&nombre="+ nombre +"&golero="+seleccionarMis5.goaly +"&defensa_izquierdo="+seleccionarMis5.defender_left+"&defensa_derecho="+seleccionarMis5.defender_right+"&atacante_izquierdo="+seleccionarMis5.attacker_left+"&atacante_derecho="+seleccionarMis5.attacker_right;
        $.ajax({
        type: "POST",
        url: "ajax/addTeamOfTheRoundAjax.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){

//                $("#player_team_goal_form_select_player").append("<option value='"+data.id+"'>"+data.name+"</option>");
//                $('#players_admin_table tr:last').after('<tr><td>'+data.id+'</td><td>'+data.name+'</td><td>...</td></tr>');
//                $('#logo_ok').show();
//                $('#form_jugadores_errors').html($('#logo_ok'));
//                $('#form_jugadores_errors').show();
//                $('#logo_ok').fadeOut(6000, function () {
//                    $('#logo_ok').hide();
//                    $('#logos_container').append($('#logo_ok'));
//                });

            }else{
//                $('#form_jugadores_errors').show();
//                $('#form_jugadores_errors').html('<h2>'+data.error+'</h2>');
//                $('#form_jugadores_errors').fadeOut(8000, function () {
//                    $('#form_jugadores_errors').hide();
//                });
            }
        }

    });

	}
	
}

seleccionarMis5.bootstrap = function() {
	
	//$('.remove').hide();
	$('.player').draggable({
		opacity: 0.7,
		revert: true,
		cursorAt : { top:0, left:0 }
	});

	$('#goaly').droppable({
		drop : seleccionarMis5.dropGoaly,
		hoverClass : 'item-arrived'
	});
        $('#defense_left').droppable({
		drop : seleccionarMis5.dropDefenderLeft,
		hoverClass : 'item-arrived'
	});
        $('#defense_right').droppable({
		drop : seleccionarMis5.dropDefenderRight,
		hoverClass : 'item-arrived'
	});

        $('#attacker_left').droppable({
		drop : seleccionarMis5.dropAttackerLeft,
		hoverClass : 'item-arrived'
	});
        $('#attacker_right').droppable({
		drop : seleccionarMis5.dropAttackerRight,
		hoverClass : 'item-arrived'
	});

    $("#button_send_form").click(seleccionarMis5.enviar);


};