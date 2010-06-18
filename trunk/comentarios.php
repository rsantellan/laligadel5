<?php include('header.php') ?>
<link href="css/commets.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/comments.js"></script>
<?php include('closeHeader.php')?>

<?php include('logoAndMenu.php')?>

<div id="body">
	<h2 class="title">Comentarios</h2>
	<div class="story">
		<p>
		<a href="javascript.void(0)" onclick="$('#block_add_comment').show();return false">Agregar comentario</a>
                
		<div id="block_add_comment" >
		<?php 
			include("logica/Comments.class.php");
			include("./logica/SendMail.class.php");
		?>
		
		<?php 
			if ($_POST["email"]<>'') {
				
				//Comments::saveComment($_POST["name"],$_POST["email"],$_POST["comment"]);
				
				//$sendMail = new SendMail();

				//$sendMail->sendFeedBackMail($_POST["email"],$_POST["name"],$_POST["comment"]);
			?> 
			<h2>Gracias por su comentario</h2>
		<?php 
		} 
		?> 
		<form action="comentarios.php" method="post"> 
			<table width="400" border="0" cellspacing="2" cellpadding="0"> 
				<tr> 
					<td width="29%" class="bodytext">Nombre:</td> 
					<td width="71%"><input name="name" type="text" id="name" size="32"></td> 
				</tr> 
				<tr> 
					<td class="bodytext">Correo Electronico:</td> 
					<td><input name="email" type="text" id="email" size="32"></td> 
				</tr> 
				<tr> 
					<td class="bodytext">Comentario:</td> 
					<td><textarea name="comment" cols="45" rows="6" id="comment" class="bodytext"></textarea></td> 
				</tr> 
				<tr> 
					<td class="bodytext">&nbsp;</td> 
                                        <td align="left" valign="top"><input type="button" name="Comentar" value="Comentar" id="submitAjax"/></td>
				</tr> 
			</table>
		</form> 

		</div>
		<div id="flash"></div>
			
			<?php $list = Comments::getAllComents(0,25);?>
		<ol class="comments" id ="commentsList">
			
			<?php foreach($list as $comment):?>
		
			<li>
				<ul class="meta">
					<li class="image"><img src="http://www.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=48" alt="Author's name" /></li>
					<li class="author"><a href="#"><?php echo $comment->getName();?></a></li>
					<?php ?>
					<li class="date">Posteado el <?php echo $comment->getDate();?></li>

				</ul>
				<div class="body"><?php echo $comment->getComment();?></div>
			</li>

			<?php endforeach;?>
		
		
		</ol>
		
		<p>
		</p>

	</div>
	
</div>

<?php include('bottom.php')?>
