<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
    <?php header("location:loginForm.php"); ?>
<?php else: ?>
    <?php include ('headerUpper.php'); ?>

<link rel="stylesheet" type="text/css" href="css/managePictures.css" />
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
<script type="text/javascript" src="../js/jquery-ui-1.7.3.custom.min.js"></script>
<script type="text/javascript" src="js/pictureManagementBatch.js"></script>

<script type="text/javascript">

</script>
    <?php include ('headerDown.php'); ?>

 <?php        include ('imageTopPanel.php'); ?>

<div id="wrapper">
    <div id="content">
        <div>
            <h1>Manejador de imagenes en cantidad</h1>
                <?php
                include '../logica/Image.class.php';
                include '../logica/ImageHandler.class.php';
                include '../logica/Category.class.php';
                ?>
                <?php
                $imageList = Image::getAllWithoutCategory(true, true);
                $categoryList = Category::getAllCategories(false, true, true);
                $imageHandler = new ImageHandler();
                $index = 1;
                ?>

            <h3>Seleccione una categoria:</h3>
            <br/>
            <select id="category_select">
                    <?php foreach ($categoryList as $category): ?>
                <option value ="<?php echo $category->getId() ?>"><?php echo $category->getName() ?></option>
                    <?php endforeach; ?>
            </select>

            <input type="button" value="Agregar seleccionados" style="margin-left: 250px;" id="addButton"/>
          


            <h3>Imagenes que no pertenecen a ninguna galeria</h3>
            <div id="images_not_used_container">
                    <?php foreach ($imageList as $image): ?>



                        <?php
                        $auxPath = $imageHandler->getConvertedPath($image->getFile(), 100, 100, true, true);
                        ?>
                <div id="image_container_<?php echo $image->getId() ?>" class="image_div image_draggable" style="height: 120px !important;">
                    <input type="checkbox" value="<?php echo $image->getId() ?>" class="checkbox"/>
                <div id ="image_<?php echo $image->getId() ?>"  imageId ="<?php echo $image->getId() ?>">

                    <img src="<?php echo $auxPath ?>"  tooltip="<?php echo $image->getName() ?>" alt="<?php echo $image->getName() ?>"/>


                </div>
                </div>
                    <?php endforeach; ?>
            </div>
            <br/>

        </div>
    </div>
    <?php        include ('defaultSideBar.php'); ?>
</div>
<?php include ('endPage.php') ?>
<?php endif; ?>
