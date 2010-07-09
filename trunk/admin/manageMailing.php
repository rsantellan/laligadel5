<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
    <?php header("location:loginForm.php"); ?>
<?php else: ?>
    <?php        include ('headerUpper.php'); ?>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/manageMailing.js"></script>
    <?php        include ('headerDown.php'); ?>


    <?php        include ('emptyTopPanel.php'); ?>

<div id="wrapper">
    <div id="content">

            <?php include '../logica/CommentsMailing.class.php';?>
            <?php $list = CommentsMailing::getAllCommentsMailsAdmin();?>
                <form action="" onsubmit="return false;" class="formulario">
                    <label for="nombre">Nombre</label> <input type="text" name="nombre" id="nombre"/>
                    <br/>
                    <input type="submit" onclick="return saveForm()" value="Guardar"/>
                </form>
                <div id="errores"></div>
                <hr/>
        <table>
            <thead>
                <tr>
                    <th><a href="#">Email</a></th>
                    <th><a href="#">Activo</a></th>
                </tr>
            </thead>
            <tbody id="mailing_table_body">
                    <?php foreach($list as $commentEmail):?>
                <tr>
                    <td><?php echo $commentEmail->getEmail()?></td>
                    <td><input type="checkbox" name="estado" value="<?php echo $commentEmail->getActive()?>" <?php if($commentEmail->getActive()) echo 'checked';?> onclick="changeMailingStatus(this,<?php echo $commentEmail->getId()?>)"/></td>
                </tr>
                    <?php endforeach;?>
            </tbody>
        </table>

    </div>
        <?php        include ('defaultSideBar.php'); ?>
</div>
    <?php include ('endPage.php') ?>
<?php endif;?>
