<?php
$username = "";
require_once("connect.php");
$query = "SELECT par, tulos FROM kierros INNER JOIN ratatulos ON kierros.kierros_id = ratatulos.kierros_id
INNER JOIN radat ON kierros.rata_id = radat.rata_id WHERE ratatulos.player_id = (SELECT user_id FROM users WHERE username = :username)";
if(isset($_GET['username'])){
    $clean['username'] = strip_tags($_GET['username']);
    $username = $clean['username'];
    
}
if(isset($_GET['course'])){
    $clean['course'] = strip_tags($_GET['course']);
    $query = $query . " AND radat.nimi = :radanNimi";
    $course = $clean['course'];
    
}
$sql = $db->prepare($query);
$sql->bindParam(':username', $username, PDO::PARAM_STR);
if(isset($_GET['course'])){
    $sql->bindParam(':radanNimi', $course, PDO::PARAM_STR);
}
$sql->execute();
if($sql->rowcount() > 0){
    $scores = [];
    while($row = $sql->fetch(PDO::FETCH_OBJ)){
         $par = $row->par;
         $throws = $row->tulos;
         $score = $throws-$par;
        array_push($scores, $score);
        
    }
    $avg = array_sum($scores) / sizeof($scores);
    echo json_encode($avg);
    
    
}