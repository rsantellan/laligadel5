<?php include('header.php') ?>
<link href="css/lightbox.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
				
        $("#slider").easySlider({
            auto: true,
            continuous: true
        });
        $('#gallery a').lightBox();
        $('#gallery2 a').lightBox();
        $('#gallery4 a').lightBox();
        $('#menu_photos').addClass('active');
        var i = 0;
        for(i=0; i <listOfCategoryIds.length ; i++){
            $("#gallery_"+ listOfCategoryIds[i] +" a").lightBox();
        }
    });
</script>
<?php include('closeHeader.php') ?>

<?php include('logoAndMenu.php') ?>

<div id="body">
    <h2 class="title">Imagenes!!</h2>
    <div class="story">

        <?php
        include './logica/Image.class.php';
        include './logica/ImageHandler.class.php';
        include './logica/Category.class.php';
        ?>
<?php
                                //$imageList = Image::getAllWithoutCategory(true, true);
                        $categoryList = Category::getAllCategories(true, true, false);
                        $imageHandler = new ImageHandler();
     ?>
            <script type="text/javascript">
                var listOfCategoryIds = new Array();
            </script>
        <?php foreach ($categoryList as $category): ?>
<?php $imageCategoryList = Image::getAllOfCategory($category->getId(), true, false);?>
        <p><?php echo $category->getName();?></p>
        <div id="gallery_<?php echo $category->getId() ?>" class="gallery">
            <script type="text/javascript">
                listOfCategoryIds.push(<?php echo $category->getId() ?>);
            
            </script>
            <ul>
                                    <?php foreach ($imageCategoryList as $image): ?>

                    <li>
<?php $auxPath = $imageHandler->getConvertedPath($image->getFile(), 600, 400, false, false); ?>

                        <a href="<?php echo $auxPath ?>" title="Futbol">
<?php $auxPath = $imageHandler->getConvertedPath($image->getFile(), 101, 67, true, false); ?>
                            <img src="<?php echo $auxPath ?>" alt="" />
                        </a>
                    </li>



                                        
                                    <?php endforeach; ?>
                </ul>

            </div>
            <hr/>
        <?php endforeach;?>

        <?php include('logica/PictureListing.class.php') ?>

        <?php $list = PictureListing::getFileList('./photos/futbol4') ?>

        <p>Imagenes del cuarto partido</p>

        <div id="gallery4" class="gallery">
            <ul>
                <?php foreach ($list as $file): ?>
                    <li>
                        <a href="<?php echo $file['picture'] ?>" title="Futbol">
                            <img src="<?php echo $file['thumb'] ?>" width="101" height="67" alt="" />
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>

            </div>
            <hr/>

            <p>Imagenes del segundo partido</p>

            <div id="gallery2">
                <ul>
                    <li>
                        <a href="photos/futbol2/DSC07464.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07464.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07465.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07465.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07466.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07466.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07467.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07467.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07468.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07468.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07469.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07469.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07470.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07470.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07471.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07471.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07472.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07472.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07473.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07473.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07474.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07474.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07475.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07475.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07476.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07476.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07477.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07477.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07478.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07478.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07479.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07479.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 201.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 201.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07480.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07480.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07481.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07481.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07482.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07482.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07483.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07483.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07484.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07484.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07485.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07485.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07486.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07486.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07487.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07487.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07488.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07488.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07489.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07489.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07490.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07490.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07491.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07491.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07492.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07492.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07493.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07493.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07494.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07494.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol2/DSC07495.jpg" title="Futbol">
                            <img src="photos/futbol2/thumbs/DSC07495.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>

                </ul>
            </div>
            <hr/>
            <p>Imagenes del primer partido</p>

            <div id="gallery">
                <ul>
                    <li>
                        <a href="photos/futbol1/ma 200.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 200.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 201.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 201.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 202.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 202.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 203.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 203.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 204.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 204.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 206.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 206.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 207.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 207.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 209.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 209.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 210.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 210.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 211.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 211.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 212.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 212.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 213.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 213.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 214.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 214.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 191.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 191.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 193.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 193.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 194.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 194.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 195.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 195.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 196.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 196.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 198.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 198.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                    <li>
                        <a href="photos/futbol1/ma 199.jpg" title="Futbol">
                            <img src="photos/futbol1/thumbs/ma 199.jpg" width="101" height="67" alt="" />
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </div>

<?php include('bottom.php') ?>
