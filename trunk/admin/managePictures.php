<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>
<?php include ('headerUpper.php'); ?>

        <link rel="stylesheet" type="text/css" href="css/managePictures.css" />
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
        <script type="text/javascript" src="../js/jquery-ui-1.7.3.custom.min.js"></script>
        <script type="text/javascript" src="js/picturesManagement.js"> </script>
        <script type="text/javascript" src="./js/pictureManagementTabs.js"> </script>

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
                    <h1>Manejador de imagenes</h1>
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


            <ul class="tabs">
                <?php foreach ($categoryList as $category): ?>
                    <li><a href="#tab<?php echo $category->getId() ?>"><?php echo $category->getName() ?></a></li>
                <?php endforeach; ?>
                </ul>

                <div class="tab_container">
                <?php foreach ($categoryList as $category): ?>
                        <div id="tab<?php echo $category->getId() ?>" class="tab_content">
                            <!--Content-->
                            <div id="category_holder_<?php echo $category->getId() ?>" placeId ="<?php echo $category->getId() ?>" class="category_holder">

                        <?php $imageCategoryList = Image::getAllOfCategory($category->getId(), true, true);
                        foreach ($imageCategoryList as $image): ?>
                        <?php $auxPath = $imageHandler->getConvertedPath($image->getFile(), 60, 60, true, true); ?>
                            <div id ="image_<?php echo $image->getId() ?>" class="image_div_on_container image_draggable" imageId ="<?php echo $image->getId() ?>">

                                <img src="<?php echo $auxPath ?>"  tooltip="<?php echo $image->getName() ?>" alt="<?php echo $image->getName() ?>"/>


                            </div>
                        <?php endforeach; ?>


                        </div>
                    </div>
                <?php endforeach; ?>

                        </div>

                        <div style="clear: both;"></div>
                        <hr/>
                        <br/>
                        <h4>Arrastra hasta aqui para sacarles las categorias</h4>
                        <div id="container_images_not_used" class ="container_images_not_used" placeId="0">
                            <img src="images/cancel-icon.png" alt="Cancelar"/>
                        </div>
                        <div style="clear: both;"></div>
                        <br/>
                        <br/>
                        <h3>Imagenes que no pertenecen a ninguna galeria</h3>
                        <div id="images_not_used_container">
                <?php foreach ($imageList as $image): ?>



<?php
                                $auxPath = $imageHandler->getConvertedPath($image->getFile(), 100, 100, true, true);
?>
                                <div id ="image_<?php echo $image->getId() ?>" class="image_div image_draggable" imageId ="<?php echo $image->getId() ?>">

                                    <img src="<?php echo $auxPath ?>"  tooltip="<?php echo $image->getName() ?>" alt="<?php echo $image->getName() ?>"/>


                                </div>

<?php endforeach; ?>
                            </div>
                            <br/>

                            <div style="clear: both;"></div>
                            <hr/>
                            <div id="trash_droppable" class="trash_droppable" placeId="-1">
                                <img src="images/Trash_128x128.png" alt="Basura"/>
                            </div>
                            <input type="button" value="Eliminar las imagenes" id="start_delete_images"/>

                            <div id="delete_confirmation" class="hide">
                                <input type="button" value="No eliminar las imagenes" id="cancel_delete_images"/>
                                <input type="button" value="Confirmar Eliminar las imagenes" id="finish_delete_images"/>
                            </div>

                            <div id="trash_image_container" class="trash_image_container"  >


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
<?php endif; ?>
