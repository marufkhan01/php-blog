<?php

	include_once dirname(__FILE__) . '/../db.php';
	include_once dirname(__FILE__) . '/../error.php';
	include_once dirname(__FILE__) . '/../classes/likes.php';


	$pid = $_POST['id']; //takes id from the "like form" in single.php

    $pdo = Database::connection();
    $db = new Likes($pdo);


	$votsById = $db->getLikesByPid($pid); //tar ut alla likes som fev inns i databasen med detta pid och sparar i en variabel

	if($votsById == array()){ //om det inte finns någon like på detta pid i databasen:
		$db->insertLike($pid); //lägg till en likeskolumn (se likes.php)
	}

    elseif($votsById != array()){ //om det redan finns en likeskolumn i databasen för dett pid:
		$db->uppdateLike($pid); //uppdatera antalet likes på denna kolumn med 1 (se likes.php)
	}

	$response = json_encode(array('status' => 200, 'pid' => $pid));
	echo $response;

?>

