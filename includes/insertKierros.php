<?php
//insert kierros
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $course_id = $request->course->id;
    $players = $request->scoreCards;
    include("connect.php");
    $query = "INSERT INTO kierros(rata_id) VALUES (?)";
    $sql = $db->prepare($query);
    $sql->bindParam(1, $course_id, PDO::PARAM_INT);
    $sql->execute();
//get kierrosID
    $query2 = "SELECT MAX(kierros_id) as max FROM kierros";
    $sql2 = $db->prepare($query2);
    $sql2->execute();
    $result;
    if($sql2->rowCount() > 0){
        $result = $sql2->fetch(PDO::FETCH_ASSOC);
    }
    
    $roundId = $result["max"];
    
    
    
    
    
//insert Course Scores
    foreach($players as $player){
        $playername = $player->name;
        $max = sizeof($player->scoreCard);
        for($i = 0; $i < $max; $i++){
            $k = $i+1;
            $throws = $player->scoreCard[$i];
            $query3 =  "INSERT INTO vaylatulos(kierros_id, player_id, vayla_id, heitot) VALUES(:roundId, (SELECT user_id FROM users WHERE username=:username),
            (SELECT vayla_id FROM vaylat WHERE rata_id=:course_id AND vayla_nro=:vaylanro), :throws)";
            $sql3 = $db->prepare($query3);
            $sql3->bindParam(':roundId', $roundId, PDO::PARAM_INT);
            $sql3->bindParam(':username', $playername, PDO::PARAM_STR);
            $sql3->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            $sql3->bindParam(':vaylanro', $k, PDO::PARAM_INT);
            $sql3->bindParam(':throws', $throws, PDO::PARAM_INT);
            $sql3->execute();
        }
        
    }
    
    
    foreach($players as $player){
    $query4 = "INSERT INTO ratatulos(kierros_id, player_id, tulos) VALUES (:roundId, (SELECT user_id FROM users WHERE username=:username), :throws)";
    $throws = $player->sum;
    $playername = $player->name;
    $sql4 = $db->prepare($query4);
    $sql4->bindParam(':roundId', $roundId, PDO::PARAM_INT);
    $sql4->bindParam(':username', $playername, PDO::PARAM_STR);
    $sql4->bindParam(':throws', $throws, PDO::PARAM_INT);
    $sql4->execute();
    }
    
?>
