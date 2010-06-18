<?php include('header.php') ?>
<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script src="js/jquery-ui-1.7.3.custom.min.js" type="text/javascript"> </script>
<script src="js/seleccionarMis5.js" type="text/javascript"> </script>
<link href="css/playersDragAndDrop.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/fieldMovement.js"></script>


<?php include('closeHeader.php')?>

<?php include('logoAndMenu.php')?>

<div id="body">
    <h2 class="title">Arma el cuadra de la fecha <label id="help"> Ayuda <img src="images/HelpIcon.gif" alt="Futbol" width="34" height="34" /></label></h2>
    <div class="story">


        <div id='field' class='field'>
            <div class="campo" id="campo">
                <img src='./images/cancha.jpg'/>
            </div>
            <div style="clear: both"><!-- --></div>
            <div class="selected-plan golero" id="goaly">
                <span class="help-text">Golero</span>
                <div style="clear: both"><!-- --></div>
            </div>

            <div style="clear: both"><!-- --></div>
            <br/>
            <div class="selected-plan defensaIzquierdo" id="defense_left">
                <span class="help-text">Defensa izquierdo</span>
                <div style="clear: both"><!-- --></div>
            </div>

            <div class="selected-plan defensaDerecho" id="defense_right">
                <span class="help-text">Defensa derecho</span>
                <div style="clear: both"><!-- --></div>
            </div>

            <div style="clear: both"><!-- --></div>
            <br/>
            <div class="selected-plan atacanteIzquierdo" id="attacker_left">
                <span class="help-text">Atacante izquierdo</span>
                <div style="clear: both"><!-- --></div>
            </div>

            <div class="selected-plan atacanteDerecho" id="attacker_right">
                <span class="help-text">Atacante derecho</span>
                <div style="clear: both"><!-- --></div>
            </div>
        </div>

        <div id="players">

            <div class="player" id="3">
                <img src="photos/images.jpg" width="54" height="54" tooltip="Este es el jugador 1"/>
                <p class="remove">sacar</p>
            </div>

            <div class="player" id ="1">
                Player 2
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id="2">
                Player 3
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>
            <div class="player" id="4">
                Player 4
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id ="5">
                Player 5
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id="6">
                Player 6
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>
            <div class="player" id="12">
                Player 12
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id ="11">
                Player 11
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id="10">
                Player 10
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>
            <div class="player" id="9">
                Player 9
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id ="8">
                Player 8
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id="7">
                Player 7
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>
            <div class="player" id="9">
                Player 9
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id ="8">
                Player 8
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>

            <div class="player" id="7">
                Player 7
                <img src="photos/images.jpg" width="40" height="40" alt="" />
                <p class="remove">sacar</p>
            </div>
            <script type="text/javascript">
                var pageHeight = 1000;
            </script>
        </div>
        <div style="clear: both"><!-- --></div>
        <br/>
        <div class="formulario" id="formulario">
		Escribe tu nombre:
            <input name="nombre" type="text" maxlength="255" id="text_person_name"/>

            <input name="enviar" type="button" value="enviar" id="button_send_form"/>
        </div>
        <div style="clear: both"><!-- --></div>
        <br/>
        <label id="selected_defense_right"></label>
        <br/>
        <label id="selected_defense_left"></label>
        <br/>
        <label id="selected_attacker_right"></label>
        <br/>
        <label id="selected_attacker_left"></label>
        <br/>
        <label id="selectedGoaly"></label>
    </div>
</div>

<?php include('bottom.php')?>
