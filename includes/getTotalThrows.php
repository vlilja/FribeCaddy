<?php
session_start();
$username = $_SESSION['logged_in'];
$query = "SELECT SUM(tulos) as throws, username FROM ratatulos INNER JOIN users ON ratatulos.player_id = users.user_id WHERE player_id = (SELECT user_id FROM users WHERE username = :username)";
require_once('connect.php');
$sql = $db->prepare($query);
$sql->bindParam(':username', $username, PDO::PARAM_STR);
$sql->execute();
if($sql->rowCount() > 0 ){
    $result = $sql->fetchAll();
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>