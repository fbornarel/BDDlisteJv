<?php include('common.php');

$title='Liste jeux';

$pdo->exec('SET NAMES UTF8');

$query = $pdo->prepare('SELECT image, titre, notice, état, console, remarque, prix FROM listejv  ORDER BY titre');

$query->execute();

$orders = $query->fetchAll(PDO::FETCH_ASSOC);



$template='liste';
include('layout.phtml');