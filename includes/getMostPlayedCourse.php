<?php
session_start();
$username = $_SESSION["logged_in"];
$query = "SELECT kierros.kierros_id, rata_id FROM vaylatulos INNER JOIN kierros ON vaylatulos.kierros_id = kierros.kierros_id WHERE vaylatulos.player_id = (SELECT user_id FROM users WHERE username=?)";

include ("connect.php");

$sql = $db->prepare($query);
$sql->bindParam(1, $username, PDO::PARAM_STR);
$sql->execute();
if($sql -> rowCount() > 0){
    $radat = [];
    $first = true;
    $currKierros;
    while($row = $sql->fetch(PDO::FETCH_OBJ)) {
        if($first){
            array_push($radat, $row->rata_id);
            $currKierros = $row->kierros_id;
            $first = false;
        }
        else {
            if($row->kierros_id !== $currKierros){
                array_push($radat, $row->rata_id);
                $currKierros = $row->kierros_id;
            }
            else {
               //do nothing 
            }
        }
    }
    
    $count = array_count_values($radat);
    arsort($count);
    $mostPlayed = current(array_keys($count));
       
    
    $query = "SELECT nimi FROM radat WHERE rata_id = ?";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $mostPlayed, PDO::PARAM_INT);
    $sql->execute();
    $result = "";
    if($sql->rowCount() > 0){
        $result = $sql->fetchAll();
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    
}