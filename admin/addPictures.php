<?php session_start (); ?>
<?php if (!$_SESSION['userAdmin']): ?>
<?php header("location:loginForm.php"); ?>
<?php else: ?>

        <?php        include ('headerUpper.php'); ?>

                <script type="text/javascript" src="./swfupload/swfupload.js"></script>
                <script type="text/javascript" src="./js/swfupload.queue.js"></script>
                <script type="text/javascript" src="./js/fileprogress.js"></script>
                <script type="text/javascript" src="./js/swfOnlyButton/handlersAppend.js"></script>
                <script type="text/javascript" src="../js/jquery-1.3.2.min.js"> </script>
                <script type="text/javascript">
                    var swfu;
                    window.onload = function () {
                        swfu = new SWFUpload({
                            // Backend Settings
                            upload_url: "upload_avatar.php",
                            post_params: {
                                "PHPSESSID": "<?php echo session_id(); ?>",
                                "ID" : "0",
                                "OBJECTCLASSNAME" : "Images"
                            },

                            // File Upload Settings
                            file_size_limit : "2 MB",	// 2MB
                            file_types : "*.jpg",
                            file_types_description : "JPG Images",
                            file_upload_limit : "100",
                            file_queue_limit:   "100",

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
                                progressTarget : "fsUploadProgress1",
                                object_class_name : "<?php echo get_class($player); ?>"
                            },

                            // Debug Settings
                            debug: false
                        });
                    };
                </script>


                    <script type="text/javascript">
    $(document).ready(function(){
        $('#addPicture').addClass('current');
    });
</script>
            <?php        include ('headerDown.php'); ?>
                
            <?php        include ('emptyTopPanel.php'); ?>
                    <div id="wrapper">
                        <div id="content">
                            <div>
                                <div class ="images_left_floating">
                                <h2>Elija las fotos que quiere subir </h2>

                                <form>
                                    <div class="fieldset flash" id="fsUploadProgress1">
                                        <span class="legend">Progreso...</span>
                                    </div>
                                    <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                                        <span id="spanButtonPlaceholder"></span>

                                    </div>

                                </form>
                                </div>
                                <div class ="images_left_floating_pictures" id="div_image_update">

                                </div>
                                <div style="clear: both"></div>
                            </div>

                            <br/>
                            <br/>
                            <br/>
<!--                            <a href="managePictures.php">Manejar imagenes subidas</a>
                            <hr/>
                            <a href="manager.php">Volver</a>-->


                        </div>
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
