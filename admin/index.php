<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Admin Theta Terra</title>
                <link rel="stylesheet" type="text/css" href="../css/adminTheme.css" />
                <link rel="stylesheet" type="text/css" href="../css/adminStyle.css" />
                <link rel="stylesheet" type="text/css" href="../css/adminTheme4.css" />
                <link rel="stylesheet" type="text/css" href="css/cssGraphics.css" />
                <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
                
                <script type="text/javascript" src="js/adminGraphs.js"></script>

                <!--
                [if IE]>
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
                                <li><a href="manager.php">Manejar la liga</a></li>
                                <li><a href="index_upload.php">Subir fotos</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="top-panel">
                        <div id="panel">

                        </div>
                    </div>
                    <div id="wrapper">
                        <div id="content">
                            <div>
                                <h1>Bienvenido al admin de la liga del 5</h1>
                                <p>Desde este lugar podra manejar toda la pagina</p>
                                <p>Cosas que estan quedando pendientes</p>
                                <ol>
                                    <li>Subir fotos y que se muestren automaticamente</li>
                                    <li>Poder ingresar desde aqui textos de la pantalla principal</li>
                                    <li>Poder filtrar los comentarios</li>
                                </ol>
                            </div>
                            <hr/>
                            <div id="place_for_graphs">
                            </div>
                            <select id="graph_options">
                                <option value="1">Comentarios por dia</option>
                                <option value="2">Comentarios por persona</option>
                            </select>
                            <input type="button" onclick="askForData()" value="Click"/>
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
<?php endif; ?>