<?php
require __DIR__ . '/../conf/Database.php';

function modificationUser() {
    $db = Database::getInstance()->getConnection();
    if (!empty($_POST)) {
        $id = $_POST["id"];
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        if($_POST["niveau"] === 'Administrateur'){
            
            $niveau = 'admin';
        } else {
            $niveau = 'simple';
            
        }
        
        $query = "UPDATE users SET prenom = :prenom, nom = :nom, email = :email, niveau = :niveau WHERE id = $id";
        
        $modification = $db->prepare($query);
        $modification->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'niveau' => $niveau
        ]);
        
        header('Location: ../views/users/user.php' );
        exit();
    }
}

function modificationEtat() {
    $db = Database::getInstance()->getConnection();
    $id = $_POST["id"];
    $etat = !$_POST["etat"];

    $query = "UPDATE users SET etat = :etat WHERE id = :id";
    $modification = $db->prepare($query);
    $modification->execute(['id' => $id, 'etat' => $etat]);

    header('Location: ../views/users/user.php' );
    exit();
}
$action = $_POST['action'];

switch ($action) {
    case 'modificationUser':
        modificationUser();
        break;
    case 'modificationEtat':
        modificationEtat();
        break;
}