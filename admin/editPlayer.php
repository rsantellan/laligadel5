<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
<?php header("location:loginForm.php");?>
<?php else:?>

<?php
$noId = true;
if ($_REQUEST['id']!= null){
	$id = $_REQUEST['id'];
	include("../logica/Player.class.php");
	$player = Player::getPlayerAdmin($id);
	$noId = false;
}
	//if(!is_null($player)):
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Theta Terra</title>
<link rel="stylesheet" type="text/css" href="../css/adminTheme.css" />
<link rel="stylesheet" type="text/css" href="../css/adminStyle.css" />
<link rel="stylesheet" type="text/css" href="../css/adminTheme4.css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->

<?php if(!$noId): ?>
<script type="text/javascript" src="./swfupload/swfupload.js"></script>
<script type="text/javascript" src="./js/swfupload.queue.js"></script>
<script type="text/javascript" src="./js/fileprogress.js"></script>
<script type="text/javascript" src="./js/handlers.js"></script>

<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "upload_avatar.php",
				post_params: {
								"PHPSESSID": "<?php echo session_id(); ?>",
								"ID" : "<?php echo $player->getId() ?>",
								"OBJECTCLASSNAME" : "<?php echo get_class($player);?>"
							},

				// File Upload Settings
				file_size_limit : "2 MB",	// 2MB
				file_types : "*.jpg",
				file_types_description : "JPG Images",
				file_upload_limit : "1",

				// Event Handler Settings - these functions as defined in Handlers.js
				//  The handlers are not part of SWFUpload but are part of my website and control how
				//  my website reacts to the SWFUpload events.
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 180,
				button_height: 18,
				button_text : '<span class="button">Elegir nueva imagen</span>',
				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
				button_text_top_padding: 0,
				button_text_left_padding: 18,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				// Flash Settings
				flash_url : "./swfupload/swfupload.swf",

				custom_settings : {
					upload_target : "divFileProgressContainer",
					cancelButtonId : "btnCancel"
				},
				
				// Debug Settings
				debug: true
			});
		};
	</script>

<?php endif;?>
	
<!--


<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "./swfupload/swfupload.swf",
				upload_url: "upload.php",
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "2 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Subir</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
	
--></head>


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
             
            <?php if($noId):?>
            	<h2>No hay jugador seleccionado</h2>
            <?php else:?>
            	<?php if(is_null($player)):?>
            		<h2>No existe ningun jugador con ese Id</h2>
            	<?php else:?>
            		<div class ="player_info">
						<img src="../<?php echo $player->getImage()?>" width="54" height="54" tooltip="<?php echo $player->getName()?>" alt="<?php echo $player->getName()?>"/>
					</div>
					
					<div class ="big_player_info">
						<br/>
						<h3><?php echo $player->getName()?></h3>
						<br/>
						<form>
							<div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
								<span id="spanButtonPlaceholder"></span>
					
							</div>
							<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
						</form>
						
					</div>
					<div id="divFileProgressContainer" style="height: 75px;"></div>
					<div id="thumbnails"></div>
					
            	<?php endif;?>
            <?php endif;?>
            <br/>
			<br/>
			<br/>
			<hr/>
			<a href="manager.php">Volver</a>
            
                
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
<?php endif;?>
