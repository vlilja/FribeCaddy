<?php


$user = "";
$query = 'SELECT username FROM users';

if(isset($_GET['user']) && $_GET['user'] !== "undefined"){
    $clean['user'] = strip_tags($_GET['user']);
    $query = $query . " WHERE username LIKE ? ORDER BY username";
    $user = $clean['user'] . "%";
    
}


require_once ("connect.php");

$sql = $db->prepare($query);
if($user !== ""){
$sql->bindParam(1, $user, PDO::PARAM_STR);
}
class player {
    var $name;
    var $average;
   /* function setName($n){
        this->$name = $n;
    }
    function setAvg($a){
        this->$average = $a;
    }*/
}

$ok = $sql->execute();
$array = [];
if($sql->rowCount() > 0){
    while($row = $sql->fetch(PDO::FETCH_OBJ)){
        $pelaaja = new player();
        $username = $row->username;
        $pelaaja->name = $username;
                $query = "SELECT par, tulos FROM kierros INNER JOIN ratatulos ON kierros.kierros_id = ratatulos.kierros_id
        INNER JOIN radat ON kierros.rata_id = radat.rata_id WHERE ratatulos.player_id = (SELECT user_id FROM users WHERE username = :username)";
        
        $sql2 = $db->prepare($query);
        $sql2->bindParam(':username', $username, PDO::PARAM_STR);
        if(isset($_GET['course'])){
            $sql2->bindParam(':radanNimi', $course, PDO::PARAM_STR);
        }
        $sql2->execute();
        if($sql2->rowcount() > 0){
            $scores = [];
            while($row = $sql2->fetch(PDO::FETCH_OBJ)){
                 $par = $row->par;
                 $throws = $row->tulos;
                 $score = $throws-$par;
                array_push($scores, $score);
                
            }
            $avg = array_sum($scores) / sizeof($scores);
            $pelaaja->average = $avg;
            
            
        }
        array_push($array, $pelaaja);
    }
}
echo json_encode($array, JSON_UNESCAPED_UNICODE);



?>
