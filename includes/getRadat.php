<?php

$rata = "";
$query = 'SELECT * FROM radat';

if(isset($_GET['rata'])){
    $clean['rata'] = strip_tags($_GET['rata']);
    $query = $query . " WHERE nimi LIKE ?";
    $rata = $clean['rata'] . "%";
    
}

class course {
    var $nimi;
    var $par;
    var $vayla_lkm; 
}

require_once ("connect.php");

$sql = $db->prepare($query);
if($rata !== ""){
$sql->bindParam(1, $rata, PDO::PARAM_STR);
}
$ok = $sql->execute();

$array = [];
if($sql->rowCount() > 0){
    
    while($row = $sql->fetch(PDO::FETCH_OBJ)){
        $course = new course();
        $course->nimi = $row->nimi;
        $course->par = $row->par;
        $course->vayla_lkm = $row->vayla_lkm;
        array_push($array, $course);
    }
}

echo json_encode($array, JSON_UNESCAPED_UNICODE);
?>










