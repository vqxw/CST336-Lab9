<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$score = $_GET['score'];

// echo $score;

//Adding new score to database

$sql = "INSERT INTO scores (username, score) VALUES (:username, :score)";

$data = array(
    ":username" => $_SESSION['username'],
    ":score" => $score
);

$stmt = $connect -> prepare ($sql);
$stmt -> execute($data);

$sql = "SELECT count(1) times, avg (score) average
        FROM scores
        WHERE username = :username";
        
$stmt = $connect -> prepare ($sql);

$data = array(
    ":username" => $_SESSION['username']
);

$stmt -> execute ($data);
$result = $stmt -> fetch(PDO::FETCH_ASSOC);


//Encoding data using JSON
echo json_encode($result); 

?>