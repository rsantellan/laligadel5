<?php

$data = array();
if ($_POST['id'] <> '' && $_POST['type'] <> '') {
    
    switch ($_POST['type']) {
        case 1:
            try {
                include("../../logica/Player.class.php");
                $strict = false;
                if($_POST['strict'] <> ''){
                    $strict = true;
                }
                $cantidad = Player::removePlayer($_POST["id"], $strict);
                if($cantidad > 0){
                    $data = array('result' => 2, 'body' => 'Too many');
                }else{
                    $data = array('result' => 1, 'body' => 'player', 'place'=>'player_tr_'.$_POST['id']);
                }
                
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }

            break;
        case 2:
            try {
                include("../../logica/Team.class.php");
                $strict = false;
                if($_POST['strict'] <> ''){
                    $strict = true;
                }
                $cantidad = Team::removeTeam($_POST["id"], $strict);
                if($cantidad > 0){
                    $data = array('result' => 2, 'body' => 'Too many');
                }else{
                    $data = array('result' => 1, 'body' => 'team', 'place'=>'team_tr_'.$_POST['id']);
                }
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 3:
            try {
         include("../../logica/Round.class.php");
                $strict = false;
                if($_POST['strict'] <> ''){
                    $strict = true;
                }
                $cantidad = Round::removeRound($_POST["id"], $strict);
                if($cantidad > 0){
                    $data = array('result' => 2, 'body' => 'Too many');
                }else{
                    $data = array('result' => 1, 'body' => 'team', 'place'=>'round_tr_'.$_POST['id']);
                }
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        case 4:
            try {
                include("../../logica/Category.class.php");
                $id = Category::removeCategory($_POST["id"]);
                $data = array('result' => 1, 'body' => 'categoria');
            } catch (Exception $e) {
                $data = array('result' => 0, 'error' => $e->getMessage());
            }
            break;
        default:
            break;
    }
} else {
    $data = array('result' => 0, 'error' => 'El nombre esta vacio');
}

// JSON encode and send back to the server
echo json_encode($data);
exit;

