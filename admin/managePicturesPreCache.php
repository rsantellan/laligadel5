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
        
<?php        include ('imageTopPanel.php'); ?>
        
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
                    <br/>
                    <br/>
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
    <div id="holder_<?php echo $index?>" style="float:left;width:100px; height:100px;padding-top:10px;">
        <div id="container_<?php echo $index?>_show" style="float:left;width:100px; height:100px;"></div>
        <div id="container_<?php echo $index?>" name="<?php echo $filesList[$index]['name']?>" class="image_container"> <?php echo $filesList[$index]['name']?> <br/> </div>
    </div>

<?php
$index++;
endwhile;
?>




                        </div>
                    </div>
                    <?php        include ('defaultSideBar.php'); ?>
                </div>
<?php include ('endPage.php') ?>
<?php endif; ?>
