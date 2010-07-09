<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>
<?php include ('headerUpper.php'); ?>
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.3.custom.css"/>
        <link rel="stylesheet" type="text/css" href="css/managePictures.css" />
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
        <script type="text/javascript" src="../js/jquery-ui-1.7.3.custom.min.js"></script>
        <script type="text/javascript" src="js/bringImages.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#managePictures').addClass('current');
            });
        </script>
<?php include ('headerDown.php'); ?>
        
<?php        include ('emptyTopPanel.php'); ?>
        
        <div id="wrapper">
            <div id="content">
                <div>
                    <h1>Pre Cache de imagenes</h1>
                    <br/>
                    <h2>El total de imagenes es: <label id="image_quantity"></label></h2>
                    <br/>
                    <h2>Imagenes procesadas: <label id="image_process"></label></h2>
                    <br/>
                    <div id="progressBar"></div>
            <?php
            //include '../logica/Image.class.php';
            include '../logica/ImageHandler.class.php';
            //include '../logica/Category.class.php';
            ?>
            <?php
            //$imageList = Image::getAllWithoutCategory(true, true);
            //$categoryList = Category::getAllCategories(false, true, true);
            $imageHandler = new ImageHandler();
            $index = 1;
            ?>

<?php
$dir = "../uploads";
$myArray = array();
$filesList = $imageHandler->getFileList($dir, true, true, true);

$index = 0;
while($index < count($filesList)): ?>

    <div id="container_<?php echo $index?>" name="<?php echo $filesList[$index]['name']?>" class="image_container"> <?php echo $filesList[$index]['name']?> <br/> </div>
    <br/>
    <hr/>

<?php
$index++;
endwhile;
?>




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
<?php endif; ?>
