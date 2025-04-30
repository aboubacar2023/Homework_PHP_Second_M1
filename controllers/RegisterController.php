<?php

require __DIR__ . '/../conf/Database.php';


$db = Database::getInstance()->getConnection(); 

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$password = $_POST["password"];
$niveau = 'simple';
$etat = true;

$query = "INSERT INTO users(prenom, nom, email, password, niveau, etat) VALUES (:prenom, :nom, :email, SHA2(:password, 256), :niveau, :etat)";
$insertion = $db->prepare($query);
$insertion->execute([
    'prenom' => $prenom,
    'nom' => $nom,
    'email' => $email,
    'password' => $password,
    'niveau' => $niveau,
    'etat' => $etat
]);
header('Location: ../views/login.php');
exit();