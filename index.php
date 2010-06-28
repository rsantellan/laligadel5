<?php include('header.php') ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#slider").easySlider({
            auto: true,
            continuous: true
        });
        /*$("img").lazyload({
                    placeholder : "photos/waiting.gif",
                    effect : "fadeIn"
            });*/
        $('#menu_index').addClass('active');
    });
</script>
<link href="css/playersList.css" type="text/css" rel="stylesheet" />
<?php include('closeHeader.php') ?>

<?php include('logoAndMenu.php') ?>

<div id="body">
    <h2 class="title">Resumen de la ultima fecha</h2>

    <div class="story">
        <p>
        <h2>Los equipos!!</h2>
        <?php include_once 'logica/Team.class.php'; ?>
        <?php include_once 'logica/Player.class.php'; ?>
        <?php 
            $teamList = Team::getAllTeams();
            
        ?>
        <br/>
        <?php foreach ($teamList as $team): ?>
            <h4><?php echo $team->getName() ?></h4>
            <br/>
            <br/>
            <h5>Los jugadores</h5>
        <?php 
            $playersList = Player::getPlayersOfATeam($team->getId());
            
        ?>
        <?php foreach ($playersList as $player): ?>

                <div class="player" id="<?php echo $player->getId() ?>">
                    <img src="<?php echo $player->getImage() ?>" width="54" height="54" tooltip="<?php echo $player->getName() ?>"/>
                    <p class="remove"><?php echo $player->getName(); ?></p>
                </div>
               
        <?php endforeach; ?>
            <div class="clear"></div>
                <hr/>
        <?php endforeach; ?>
 

            </div>

        </div>

<?php include('bottom.php') ?>
