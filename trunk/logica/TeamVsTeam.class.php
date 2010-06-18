<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TeamVsTeamclass
 *
 * @author rodrigo
 */
class TeamVsTeam {
    //put your code here
    private $id_team_1;
    private $id_team_2;
    private $id_round;

    public function getId_team_1() {
        return $this->id_team_1;
    }

    public function setId_team_1($id_team_1) {
        $this->id_team_1 = $id_team_1;
    }

    public function getId_team_2() {
        return $this->id_team_2;
    }

    public function setId_team_2($id_team_2) {
        $this->id_team_2 = $id_team_2;
    }

    public function getId_round() {
        return $this->id_round;
    }

    public function setId_round($id_round) {
        $this->id_round = $id_round;
    }

    public static function saveTeamVsTeam($team1_id, $team2_id, $round_id){

        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        $per1 = new Persistencia ( "INSERT" );
        $per1->setTable("team_vs_team");
        $per1->addColum ( 'id_team_1' );
        $per1->addColum ( 'id_team_2' );
        $per1->addColum ( 'id_round' );
        $per1->addValue ( $team1_id);
        $per1->addValue ( $team2_id);
        $per1->addValue ( $round_id);
        $str = $per1->constructQuery ();
        $result = $per1->doQuery ( $str );
        return true;
    }

        public static function getRoundTeamsAdmin($round_id){
            require_once '../../persistencia/dBase.php';
            require_once '../../persistencia/persistencia.php';
            require_once '../../persistencia/laligadel5DBase.php';
            require_once '../../logica/Team.class.php';
            $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
            $conn->selectDB ( laligadel5DBase::$database );
            $per = new Persistencia ( 'select' );

            $per->addColum ( "*" );
            $per->setTable ( "team_vs_team" );
            $per->addWhere("id_round = ".$round_id);
            $str = $per->constructQuery ();
            $result = $per->doQuery ( $str );
            $per->viewData($result);
            $auxDatos = $per->returnValores();
            $index = 0;
            $list = array();
            while($index+3 <= count($auxDatos)){
                $teamVsTeam = new TeamVsTeam();
                $teamVsTeam->setId_round($round_id);
                $team = Team::getTeamById($auxDatos[$index]);
                $teamVsTeam->setId_team_1($team);
                $team2 = Team::getTeamById($auxDatos[$index+1]);
                $teamVsTeam->setId_team_2($team2);
                array_push($list,$teamVsTeam);
                $index = $index+3;
            }
            return $list;
    }

    public static function getRoundTeams($round_id){
            require_once './persistencia/dBase.php';
            require_once './persistencia/persistencia.php';
            require_once './persistencia/laligadel5DBase.php';
            require_once 'Team.class.php';
            $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
            $conn->selectDB ( laligadel5DBase::$database );
            $per = new Persistencia ( 'select' );

            $per->addColum ( "*" );
            $per->setTable ( "team_vs_team" );
            $per->addWhere("id_round = ".$round_id);
            $str = $per->constructQuery ();
            $result = $per->doQuery ( $str );
            $per->viewData($result);
            $auxDatos = $per->returnValores();
            $index = 0;
            $list = array();
            while($index+3 <= count($auxDatos)){
                $teamVsTeam = new TeamVsTeam();
                $teamVsTeam->setId_round($round_id);
                $team = Team::getTeamById($auxDatos[$index]);
                $teamVsTeam->setId_team_1($team);
                $team2 = Team::getTeamById($auxDatos[$index+1]);
                $teamVsTeam->setId_team_2($team2);
                array_push($list,$teamVsTeam);
                $index = $index+3;
            }
            return $list;
    }

    public static function getTeamListPosition(){
        require_once 'Round.class.php';
        require_once 'Player.class.php';
        $roundList = Round::getAll();
        $list = array();
        foreach($roundList as $round){
            $teamVsTeamList = self::getRoundTeams($round->getId());
            foreach($teamVsTeamList as $teamVsTeam){
                $goalsTeam1 = 0;
                $goalsTeam2 = 0;
                $listPlayerTeam = Player::getTeamRoundPlayers($teamVsTeam->getId_team_1()->getId(),$round->getId());
                foreach($listPlayerTeam as $player){
                    $goalsTeam1 += $player->getAuxGoals();
                }
                $listPlayerTeam = Player::getTeamRoundPlayers($teamVsTeam->getId_team_2()->getId(),$round->getId());
                foreach($listPlayerTeam as $player){
                    $goalsTeam2 += $player->getAuxGoals();
                }
                
                $id2 = $teamVsTeam->getId_team_2()->getId();
                $id1 = $teamVsTeam->getId_team_1()->getId();
                $auxTeam1 = new auxTeam();
                if(array_key_exists($id1,$list)){
                    $auxTeam1 = auxTeam::fromArray($list[$id1]);
                }else{
                    $auxTeam1->setTeamName($teamVsTeam->getId_team_1()->getName());
                }

                $auxTeam2 = new auxTeam();
                if(array_key_exists($id2,$list)){
                    $auxTeam2 = auxTeam::fromArray($list[$id2]);
                }else{
                    $auxTeam2->setTeamName($teamVsTeam->getId_team_2()->getName());
                }
                $auxTeam1->setGoalsFavor($goalsTeam1);
                $auxTeam1->setGoalsAgainst($goalsTeam2);
                $auxTeam2->setGoalsFavor($goalsTeam2);
                $auxTeam2->setGoalsAgainst($goalsTeam1);

                if($goalsTeam1 > $goalsTeam2){
                    $auxTeam1->setWin(1);
                    $auxTeam2->setLost(1);
                }else{
                    if($goalsTeam1 == $goalsTeam2){
                        $auxTeam1->setTie(1);
                        $auxTeam2->setTie(1);
                    }else{
                        $auxTeam2->setWin(1);
                        $auxTeam1->setLost(1);
                    }
                }
                $list[$id1] = auxTeam::resultToArray($auxTeam1);
                $list[$id2] = auxTeam::resultToArray($auxTeam2);
            }
        }
        $auxaux = new auxTeam();
        //return $auxaux->orderByGoalsDifference($list);
        return auxTeam::orderByGoalsDifference($list); //$list;
    }

}

class auxTeam{

    private $teamName = '';
    private $lost = 0;
    private $tie = 0;
    private $win = 0;
    private $goalsFavor = 0;
    private $goalsAgainst = 0;
    

    public function getTeamName() {
        return $this->teamName;
    }

    public function setTeamName($teamName) {
        $this->teamName = $teamName;
    }

    public function getLost() {
        return $this->lost;
    }

    public function setLost($lost) {
        $this->lost += $lost;
    }

    public function getTie() {
        return $this->tie;
    }

    public function setTie($tie) {
        $this->tie += $tie;
    }

    public function getWin() {
        return $this->win;
    }

    public function setWin($win) {
        $this->win += $win;
    }

    public function getPoints() {
        return $this->getTie() + (3 * $this->getWin());
    }

    public function getGoalsFavor() {
        return $this->goalsFavor;
    }

    public function setGoalsFavor($goalsFavor) {
        $this->goalsFavor += $goalsFavor;
    }

    public function getGoalsAgainst() {
        return $this->goalsAgainst;
    }

    public function setGoalsAgainst($goalsAgainst) {
        $this->goalsAgainst += $goalsAgainst;
    }

    public function getGoalDifference() {
        return $this->getGoalsFavor() - $this->getGoalsAgainst();
    }



    public static function resultToArray(auxTeam $auxTeam){
        $array = array();
        $array['name'] = $auxTeam->getTeamName();
        $array['lost'] = $auxTeam->getLost();
        $array['tie'] = $auxTeam->getTie();
        $array['won'] = $auxTeam->getWin();
        $array['points'] = $auxTeam->getPoints();
        $array['goalsFavor'] = $auxTeam->getGoalsFavor();
        $array['goalsAgainst'] = $auxTeam->getGoalsAgainst();
        $array['goalsDifference'] = $auxTeam->getGoalDifference();
        return $array;
    }

    public static function fromArray(array $array){
        $auxTeam = new auxTeam();
        $aux = $array['name'];
        $auxTeam->setTeamName((string)$aux);
        //print_r('aux team '. $auxTeam->getTeamName());
        $aux = $array['lost'];
        $auxTeam->setLost((int) $aux);
        $auxTeam->setTie($array['tie']);
        $auxTeam->setWin($array['won']);
        $auxTeam->setGoalsFavor($array['goalsFavor']);
        $auxTeam->setGoalsAgainst($array['goalsAgainst']);
        return $auxTeam;
    }

    public static function orderBy($data, $field) {
        $code = "return strnatcmp(\$a['$field'], \$b['$field']);";
        usort($data, create_function('$a,$b', $code));
        return $data;

    }

    public static function orderByGoalsDifference($data){

        $data = self::orderBy($data, 'points');

        $data = self::reorderByGoalDifference($data);

        $data = self::bubbleOrderByGoalDifference($data);
        //usort($data, 'compare_results');
        return $data;
    }

    public static function reorderByGoalDifference($data){
        $index = count($data) - 1;
        $change = false;
        while($index >= 0){
            if($index != 1){
                if($data[$index]['points'] == $data[$index-1]['points']){
                    if($data[$index]['goalsDifference'] < $data[$index-1]['goalsDifference']){
                        $aux = $data[$index];
                        $data[$index] = $data[$index -1];
                        $data[$index -1] = $aux;
                    }
                    $change = true;
                }
            }
            $index--;
        }
//        if($change){
//            $data = self::reorderByGoalDifference($data);
//        }
        return $data;
    }

public static function bubbleOrderByGoalDifference($data) {
    $size = count($data);
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-1-$i; $j++) {
            if($data[$j]['points'] == $data[$j+1]['points']){
                if($data[$j]['goalsDifference'] > $data[$j + 1]['goalsDifference']){
                        self::swap($data, $j, $j+1);
                    }
            }
        }
    }
    return $data;
}

public static function swap(&$data, $a, $b) {
    $aux = $data[$a];
    $data[$a] = $data[$b];
    $data[$b] = $aux;
}


    public function compare_results($a, $b) {
        $retval = strnatcmp($a['points'], $b['points']);
        if(!$retval) return strnatcmp($a['goalsDifference'], $b['goalsDifference']);
        return $retval;
    }

    
}

