<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>
           <?php        include ('headerUpper.php'); ?>

                <link rel="stylesheet" type="text/css" href="css/cssGraphics.css" />
                <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>

                <script type="text/javascript" src="js/adminGraphs.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dashboard').addClass('current');
    });
</script>
            <?php        include ('headerDown.php'); ?>


             <?php        include ('emptyTopPanel.php'); ?>

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

                        <?php        include ('defaultSideBar.php'); ?>
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
