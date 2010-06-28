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

                <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
                <script type="text/javascript" src="../js/jquery.flot.js"> </script>

                <style type="text/css">

                    td.value {
                        background-image: url(gridline58.gif);
                        background-repeat: repeat-x;
                        background-position: left top;
                        border-left: 1px solid #e5e5e5;
                        border-right: 1px solid #e5e5e5;
                        padding:0;
                        border-bottom: none;
                        background-color:transparent;
                    }
                    td {
                        padding: 4px 6px;
                        border-bottom:1px solid #e5e5e5;
                        border-left:1px solid #e5e5e5;
                        background-color:#fff;
                    }
                    body {
                        font-family: Verdana, Arial, Helvetica, sans-serif;
                        font-size: 80%;
                    }
                    td.value img {
                        vertical-align: middle;
                        margin: 5px 5px 5px 0;
                    }
                    th {
                        text-align: left;
                        vertical-align:top;
                    }
                    td.last {
                        border-bottom:1px solid #e5e5e5;
                    }
                    td.first {
                        border-top:1px solid #e5e5e5;
                    }
                    .auraltext
                    {
                        position: absolute;
                        font-size: 0;
                        left: -1000px;
                    }
                    table {
                        background-image:url(bg_fade.png);
                        background-repeat:repeat-x;
                        background-position:left top;
                        width: 33em;
                    }
                    caption {
                        font-size:90%;
                        font-style:italic;
                    }

                </style>


                <script type="text/javascript">
                    $(document).ready(function(){

                    });
                    function askForData(){
                        var dataString = "";
                        $.ajax({
                            type: "POST",
                            url: "process/commentsPerDay.php",
                            data: dataString,
                            dataType: "json",
                            beforeSend: function(x) {
                                if(x && x.overrideMimeType) {
                                    x.overrideMimeType("application/json;charset=UTF-8");
                                }
                            },
                            success: function(data){
                                if(data.result == 1){
                                    //$.plot($("#placeholder"), [ data.ordenados ]);


                                }else{

                                }
                            }

                        });
                    }
                </script>
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

                            <table cellspacing="0" cellpadding="0" summary="Sweden was the top importing country by far in 1998.">
                                <caption align="top">Top banana importers 1998 (value of banana imports in millions of US dollars per million people)<br /><br /></caption>
                                <tr>
                                    <th scope="col"><span class="auraltext">Country</span> </th>
                                    <th scope="col"><span class="auraltext">Millions of US dollars per million people</span> </th>

                                </tr>
                                <tr>
                                    <td class="first">Sweden</td>
                                    <td class="value first"><img src="images/bar.png" alt="" width="200" height="16" />17.12</td>
                                </tr>
                                <tr>
                                    <td>United&nbsp;Kingdom</td>

                                    <td class="value"><img src="images/bar.png" alt="" width="104" height="16" />8.88</td>
                                </tr>
                                <tr>
                                    <td>Germany</td>
                                    <td class="value"><img src="images/bar.png" alt="" width="98" height="16" />8.36</td>
                                </tr>
                                <tr>

                                    <td>Italy</td>
                                    <td class="value"><img src="images/bar.png" alt="" width="70" height="16" />5.96</td>
                                </tr>
                                <tr>
                                    <td>United States </td>
                                    <td class="value"><img src="images/bar.png" alt="" width="56" height="16" />4.78</td>
                                </tr>

                                <tr>
                                    <td>Canada</td>
                                    <td class="value"><img src="images/bar.png" alt="" width="54" height="16" />4.62</td>
                                </tr>
                                <tr>
                                    <td>Japan</td>
                                    <td class="value"><img src="images/bar.png" alt="" width="50" height="16" />4.30</td>

                                </tr>
                                <tr>
                                    <td>France</td>
                                    <td class="value"><img src="images/bar.png" alt="" width="39" height="16" />3.33</td>
                                </tr>
                                <tr>
                                    <td>Russia</td>

                                    <td class="value last"><img src="images/bar.png" alt="" width="12" height="16" />1.04</td>
                                </tr>
                            </table>

        
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
