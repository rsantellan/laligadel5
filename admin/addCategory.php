<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>
<?php include ('headerUpper.php'); ?>

        <link rel="stylesheet" type="text/css" href="css/cssAddCategory.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.3.custom.css"/>
        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
        <script type="text/javascript" src="../js/jquery-ui-1.7.3.custom.min.js"></script>
        <script type="text/javascript" src="js/addCategory.js"> </script>
<?php include ('headerDown.php'); ?>


<?php include ('emptyTopPanel.php'); ?>

        <div id="wrapper">
            <div id="content">
                <div id="dialog" title="Confirmacion requerida">
                    Estas seguro?
                </div>
        
                <form action="" onsubmit="return false;" class="formulario">
                    <label for="nombre">Nombre</label> <input type="text" name="nombre" id="nombre"/>
                    <br/>
                    <br/>
                    <label for="visibilidad">Visible</label> <input type="checkbox" name="visible" id="visibilidad"/>
                    <br/>
                    <input type="submit" onclick="return saveForm()" value="Guardar"/>
                </form>
                <div id="errores"></div>
        <?php
        include '../logica/Category.class.php';
        $categoryList = Category::getAllCategories(false, true, true);
        ?>
        <div id="player_table_list">
            <table width="200" border="1" id="category_admin_table">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Eliminar</th>
                </tr>
                <?php foreach ($categoryList as $category): ?>
                    <tr id="category_tr_<?php echo $category->getId() ?>">
                        <td><?php echo $category->getId() ?></td>
                        <td><?php echo $category->getName() ?></td>
                        <td><input type="checkbox" value="<?php echo $category->getVisible() ?>" onclick="changeVisibility(this, <?php echo $category->getId() ?>)"/> </td>
                        <td><a href="javascript:void(0)" onclick="deleteCategory(<?php echo $category->getId() ?>)"> Eliminar </a></td>
                    </tr>
                <?php endforeach; ?>
                </table>
            </div>
        </div>

    <?php include ('defaultSideBar.php'); ?>
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
