<?php
require __DIR__ . '/../conf/Database.php';

function createCategorie() {
    $db = Database::getInstance()->getConnection();
    if (!empty($_POST)) {
        $nom_categorie = $_POST["nom_categorie"];
        
        $query = "INSERT INTO categories(nom_categorie) VALUES (:nom_categorie)";
        
        $save = $db->prepare($query);
        $save->execute([
            'nom_categorie' => $nom_categorie
        ]);
        
        header('Location: ../views/categories/categorie_index.php' );
        exit();
    }
}

function modificationCategorie() {
    $db = Database::getInstance()->getConnection();
    $id = $_POST["id"];
    $nom_categorie = $_POST["nom_categorie"];

    $query = "UPDATE categories SET nom_categorie = :nom_categorie WHERE id = :id";
    $modification = $db->prepare($query);
    $modification->execute(['id' => $id, 'nom_categorie' => $nom_categorie]);

    header('Location: ../views/categories/categorie_index.php' );
    exit();
}

function deleteCategorie() {
    $db = Database::getInstance()->getConnection();
    $id = $_POST["id"];

    $query = "DELETE FROM categories WHERE id = :id";
    $modification = $db->prepare($query);
    $modification->execute(['id' => $id]);

    header('Location: ../views/categories/categorie_index.php' );
    exit();
}

$action = $_POST['action'];

switch ($action) {
    case 'createCategorie':
        createCategorie();
        break;
    case 'modificationCategorie':
        modificationCategorie();
        break;
    case 'deleteCategorie' :
        deleteCategorie();
        break;
}