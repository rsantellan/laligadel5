<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
    <?php header("location:loginForm.php");?>
<?php else:?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin Theta Terra</title>
        <link rel="stylesheet" type="text/css" href="../css/adminTheme.css" />
        <link rel="stylesheet" type="text/css" href="../css/adminStyle.css" />
        <link rel="stylesheet" type="text/css" href="../css/adminTheme4.css" />
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="../js/adminLaLiga.js"></script>
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
        <![endif]-->
    </head>


    <body>
        <div id="container">
            <div id="header">
                <h2>Admin area</h2>
                <div id="topmenu">
                    <ul>
                        <li class="current"><a href="index.php">Dashboard</a></li>
                        <li><a href="addPlayer.php">addPlayer</a></li>
                        <li><a href="addTeam.php">addTeam</a></li>
                        <li><a href="addRound.php">addRound</a></li>
                        <li><a href="addPlayerTeamGoal.php">addPlayerTeamGoal</a></li>
                        <li><a href="addTeamVsTeam.php">addTeamVsTeam</a></li>

                    </ul>
                </div>
            </div>
            <div id="top-panel">
                <div id="panel">

                </div>
            </div>
            <div id="wrapper">
                <div id="content">


                    <div id="addPlayer">
                        <p>Formulario jugadores:</p>
                        <form id="form_jugadores" name="form_jugadores" method="post"  action="" onsubmit="return false;">
                            <p>Nombre:
                                <label>
                                    <input type="text" name="nombre_jugador" id="form_jugadores_nombre_jugador" />
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="submit" name="enviar_jugador" id="form_jugadores_enviar_jugador" value="Guardar" />
                                </label>
                            </p>
                        </form>
                        <div id="form_jugadores_errors"></div>
                    </div>

                    <div id="addTeam">
                        <p>Formulario equipos:</p>
                        <form id="form_equipos" name="form_equipos" method="post" action="" onsubmit="return false;">
                            <p>Nombre:
                                <label>
                                    <input type="text" name="nombre_equipo" id="form_equipos_nombre_equipo" />
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="submit" name="enviar_equipo" id="form_equipos_enviar_equipo" value="Guardar" />
                                </label>
                            </p>
                        </form>
                        <div id="form_equipos_errors"></div>
                    </div>

                    <div id="addRound">
                        <form id="form_fechas" name="form_fechas" method="post" action="" onsubmit="return false;">
                            <p>Nombre:
                                <label>
                                    <input type="text" name="nombre_fechas" id="form_fechas_nombre_fechas" />
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="submit" name="enviar_fechas" id="form_fechas_enviar_fechas" value="Guardar" />
                                </label>
                            </p>
                        </form>
                        <div id="form_fechas_errors"></div>
                    </div>
                        <?php
                        include("../logica/Team.class.php");
                        include("../logica/Round.class.php");
                        ?>
                    <div id="addTeamVsTeam">
                        Equipo fecha:
                        <form id="team_vs_team_form" name="team_vs_team_form" method="post" action="" onsubmit="return false;">
                                <?php $teamList = Team::getAllTeamsAdmin(); ?>
                            <label>equipo 1
                                <select name="team_vs_team_form_equipo_1" id="team_vs_team_form_equipo_1">
                                        <?php foreach($teamList as $team): ?>
                                    <option value="<?php echo $team->getId()?>"><?php echo $team->getName()?></option>
                                        <?php endforeach; ?>
                                </select>
                                <br />
                            </label>
                            <label>equipo 2
                                <select name="team_vs_team_form_equipo_2" id="team_vs_team_form_equipo_2">
                                        <?php foreach($teamList as $team): ?>
                                    <option value="<?php echo $team->getId()?>"><?php echo $team->getName()?></option>
                                        <?php endforeach; ?>
                                </select>
                                <br />
                            </label>
                            <label>Fecha
                                    <?php $roundList = Round::getAllRoundsAdmin();?>
                                <select name="team_vs_team_form_fecha" id="team_vs_team_form_fecha">
                                        <?php foreach($roundList as $round): ?>
                                    <option value="<?php echo $round->getId()?>"><?php echo $round->getName()?></option>
                                        <?php endforeach; ?>
                                </select>
                            </label>
                            <p>
                                <label>
                                    <input type="submit" name="enviar_team_vs_team_form" id="enviar_team_vs_team_form" value="Guardar" />
                                </label>
                            </p>

                        </form>
                        <div id="team_vs_team_form_on_round"></div>
                        <div id="team_vs_team_form_errors"></div>
                    </div>
                </div>

            </div>
            <div id="sidebar">
                <ul>

                    <li><h3><a href="#" class="folder_table">Imagenes</a></h3>
                        <ul>
                            <li><a href="#" class="addorder">Nueva imagen</a></li>
                            <li><a href="#" class="shipping">Manejar</a></li>
                        </ul>
                    </li>
                    <li><h3><a href="#" class="user">Users</a></h3>
                        <ul>
                            <li><a href="#" class="useradd">Nuevo usuario</a></li>
                            <li><a href="#" class="group">Mandar notificacion</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3><a href="#" onclick='return adminLogout()'>Salir</a></h3>
                    </li>
                </ul>
            </div>
        </div>
        <div id="footer">
            <div id="credits">
   		Template by Yo
            </div>
            <div id="styleswitcher">

            </div><br />

        </div>
        </div>
    </body>
</html>
<?php endif;?>