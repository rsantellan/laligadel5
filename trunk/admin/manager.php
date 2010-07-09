<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>

<?php include ('headerUpper.php'); ?>

        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.3.custom.css"/>
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
        <script type="text/javascript" src="../js/jquery-ui-1.7.3.custom.min.js"></script>
        <script type="text/javascript" src="../js/adminLaLiga.js"></script>

<?php include ('headerDown.php'); ?>

        <div id="top-panel">
            <div id="panel">
                <ul>
                    <li><a href="javascript:void(0)" id="top_agregar_jugador">Agregar jugador</a></li>
                    <li><a href="javascript:void(0)" id="top_agregar_equipo">Agregar equipo</a></li>
                    <li><a href="javascript:void(0)" id="top_agregar_ronda">Agregar ronda</a></li>
                    <li><a href="javascript:void(0)" id="top_agregar_team_vs_team">Equipo vs Equipo</a></li>
                    <li><a href="javascript:void(0)" id="top_agregar_player_goal_team">Goles del jugador</a></li>
                </ul>
            </div>
        </div>
        <div id="wrapper">
            <div id="content">
                <div id="dialog" title="Confirmacion requerida">
                    Estas seguro?
                </div>
                <div id="dialog_double_check" title="Realmente esta seguro?">
                    Si continua alterara la informacion estadistica de la liga.
                </div>
                <div id="information">
                    <h2>Utiliza los botones de arriba y los de la derecha para ingresar
                        <br/>
                        jugadores, equipos, fechas y etc...
                    </h2>

                </div>
                <hr/>
                <div id ="logos_container">

                </div>
                <div id="logo_ok" class="logo64">
                    <img src="../images/dialog-ok.png"/>
                </div>
                <br/>
                <br/>
                <br/>
        <?php include("../logica/Player.class.php"); ?>
        <?php
        include '../logica/ImageHandler.class.php';
        $imageHandler = new ImageHandler();
        ?>
        <?php $playerList = Player::getAllPlayersAdmin() ?>
        <h3><a href="javascript:void(0)" id="players_admin_table">Jugadores</a></h3>
        <div id="player_table_list">
            <table width="200" border="1" id="players_admin_table">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Vista previa de la imagen</th>
                    <th scope="col">Eliminar</th>
                </tr>
                <?php foreach ($playerList as $player): ?>
                    <tr id="player_tr_<?php echo $player->getId() ?>">
                        <td><a href="editPlayer.php?id=<?php echo $player->getId() ?>"><?php echo $player->getId() ?></a></td>
                        <td><?php echo $player->getName() ?></td>
                        <td><?php echo $player->getImage() ?></td>
                    <?php if ($player->hasImage()): ?>
                    <?php $auxPath = $imageHandler->getConvertedPath($player->getImage(), 54, 54, true, true); ?>
                        <td> <img src="<?php echo $auxPath ?>" width="54" height="54" tooltip="<?php echo $player->getName() ?>"/></td>
                    <?php else: ?>
                            <td> - </td>
                    <?php endif; ?>
                            <td><a href="javascript:void(0)" onclick="startDelete(<?php echo $player->getId() ?>,1)" >Eliminar</a></td>
                        </tr>
                <?php endforeach; ?>
                        </table>
                    </div>
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
                        <div id="form_jugadores_procesando"></div>
                        <div id="form_jugadores_errors"></div>
                    </div>
                    <br/>
                    <br/>
                    <h3><a href="javascript:void(0)" id="teams_admin_table">Equipos</a></h3>
                    <div id="teams_table_list">
            <?php include("../logica/Team.class.php"); ?>
            <?php $teamList = Team::getAllTeamsAdmin(); ?>
                            <table width="200" border="1" id="teams_admin_table">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                <?php foreach ($teamList as $team): ?>
                                <tr id="team_tr_<?php echo $team->getId() ?>">
                                    <td><?php echo $team->getId() ?></td>
                                    <td><?php echo $team->getName() ?></td>
                                    <td>...</td>
                                    <td><a href="javascript:void(0)" onclick="startDelete(<?php echo $team->getId() ?>,2)" >Eliminar</a></td>
                                </tr>
                <?php endforeach; ?>
                            </table>
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
                            <div id="form_equipos_procesando"></div>
                            <div id="form_equipos_errors"></div>
                        </div>

                        <br/>
                        <br/>
                        <h3><a href="javascript:void(0)" id="rounds_admin_table">Fechas</a></h3>
                        <div id="rounds_table_list">
            <?php include("../logica/Round.class.php"); ?>
            <?php $roundList = Round::getAllRoundsAdmin(); ?>
                                <table width="200" border="1" id="rounds_admin_table">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                <?php foreach ($roundList as $round): ?>
                                    <tr id="round_tr_<?php echo $round->getId() ?>">
                                        <td><?php echo $round->getId() ?></td>
                                        <td><?php echo $round->getName() ?></td>
                                        <td><a href="javascript:void(0)" onclick="startDelete(<?php echo $round->getId() ?>,3)" >Eliminar</a></td>
                                    </tr>
                <?php endforeach; ?>
                                </table>
                            </div>

                            <div id="addRound">
                                <p>Formulario fechas:</p>
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
                                <div id="form_fechas_procesando"></div>
                                <div id="form_fechas_errors"></div>
                            </div>

                            <div id="addTeamVsTeam" >
                                Equipo fecha:
                                <form id="team_vs_team_form" name="team_vs_team_form" method="post" action="" onsubmit="return false;">

                                    <label>equipo 1
                                        <select name="team_vs_team_form_equipo_1" id="team_vs_team_form_equipo_1">
                        <?php foreach ($teamList as $team): ?>
                                        <option value="<?php echo $team->getId() ?>"><?php echo $team->getName() ?></option>
                        <?php endforeach; ?>
                                    </select>
                                    <br />
                                </label>
                                <label>equipo 2
                                    <select name="team_vs_team_form_equipo_2" id="team_vs_team_form_equipo_2">
                        <?php foreach ($teamList as $team): ?>
                                            <option value="<?php echo $team->getId() ?>"><?php echo $team->getName() ?></option>
                        <?php endforeach; ?>
                                        </select>
                                        <br />
                                    </label>
                                    <label>Fecha

                                        <select name="team_vs_team_form_fecha" id="team_vs_team_form_fecha">
                        <?php foreach ($roundList as $round): ?>
                                                <option value="<?php echo $round->getId() ?>"><?php echo $round->getName() ?></option>
                        <?php endforeach; ?>
                                            </select>
                                        </label>
                                        <p>
                                            <label>
                                                <input type="submit" name="enviar_team_vs_team_form" id="enviar_team_vs_team_form" value="Guardar" />
                                            </label>
                                        </p>

                                    </form>
                                    <div id="team_vs_team_form_on_round_procesando"></div>
                                    <div id="team_vs_team_form_on_round"></div>
                                    <div id="team_vs_team_form_errors"></div>
                                </div>

                                <div id="addPlayerTeamGoals">
                                    <p>Jugador fecha: </p>
                                    <form id="player_team_goal_form" name="player_team_goal_form" method="post" action="" onsubmit="return false;">
                                        <p>
                                            <label>Jugador

                                                <select name="player_team_goal_form_select_player" id="player_team_goal_form_select_player">
                            <?php foreach ($playerList as $player): ?>
                                                    <option value="<?php echo $player->getId() ?>"><?php echo $player->getName() ?></option>
                            <?php endforeach; ?>
                                                </select>
                                                <br />
                                            </label>
                                            <label>equipo
                        <?php //$teamList = Team::getAllTeamsAdmin();   ?>
                                                    <select name="player_team_goal_form_select_team" id="player_team_goal_form_select_team">
                            <?php foreach ($teamList as $team): ?>
                                                        <option value="<?php echo $team->getId() ?>"><?php echo $team->getName() ?></option>
                            <?php endforeach; ?>
                                                    </select>
                                                    <br />
                                                </label>
                                                <label>Fecha
                        <?php //$roundList = Round::getAllRoundsAdmin();  ?>
                                                        <select name="player_team_goal_form_select_round" id="player_team_goal_form_select_round">
                            <?php foreach ($roundList as $round): ?>
                                                            <option value="<?php echo $round->getId() ?>"><?php echo $round->getName() ?></option>
                            <?php endforeach; ?>
                                                        </select>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label>Goles
                                                        <input type="text" name="player_team_goal_form_goles" id="player_team_goal_form_goles" />
                                                    </label>
                                                </p>
                                                <p>
                                                    <label>
                                                        <input type="submit" name="player_team_goal_form_enviar" id="player_team_goal_form_enviar" value="Guardar" />
                                                    </label>
                                                </p>

                                            </form>
                                            <div id="player_team_goal_form_on_round_procesando"></div>
                                            <div id="player_team_goal_form_on_round"></div>
                                            <div id="player_team_goal_form_errors"></div>

                                        </div>
                                    </div>

                                </div>
                                <div id="sidebar">
                                    <ul>
                                        <li><h3><a href="#" class="folder_table">Manejar la liga</a></h3>
                                            <ul>
                                                <li><a href="javascript:void(0)" class="folder_table" id="menu_agregar_jugador">Agregar jugador</a></li>
                                                <li><a href="javascript:void(0)" class="folder_table" id="menu_agregar_equipo">Agregar equipo</a></li>
                                                <li><a href="javascript:void(0)" class="folder_table" id="menu_agregar_ronda">Agregar ronda</a></li>
                                                <li><a href="javascript:void(0)" class="folder_table" id="menu_agregar_team_vs_team">Equipo vs Equipo</a></li>
                                                <li><a href="javascript:void(0)" class="folder_table" id="menu_agregar_player_goal_team">Goles del jugador</a></li>
                                            </ul>
                                        </li>
                                        <li><h3><a href="javascript:void(0)" class="folder_table">Imagenes</a></h3>
                                            <ul>
                                                <li><a href="javascript:void(0)" class="addorder">Nueva imagen</a></li>
                                                <li><a href="javascript:void(0)" class="shipping">Manejar</a></li>
                                            </ul>
                                        </li>
                                        <li><h3><a href="javascript:void(0)" class="user">Users</a></h3>
                                            <ul>
                                                <li><a href="javascript:void(0)" class="useradd">Nuevo usuario</a></li>
                                                <li><a href="javascript:void(0)" class="group">Mandar notificacion</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h3><a href="javascript:void(0)" onclick='return adminLogout()'>Salir</a></h3>
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
<?php endif; ?>
