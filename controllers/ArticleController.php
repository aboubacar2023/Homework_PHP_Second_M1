<?php
require __DIR__ . '/../conf/Database.php';

function createArticle() {
    $db = Database::getInstance()->getConnection();
    if (!empty($_POST)) {
        $nom_article = $_POST["nom_article"];
        $quantite = $_POST["quantite"];
        $id_categorie = $_POST["id_categorie"];
        
        $query = "INSERT INTO articles(nom_article, quantite, id_categorie) VALUES (:nom_article, :quantite, :id_categorie)";
        
        $save = $db->prepare($query);
        $save->execute([
            'nom_article' => $nom_article,
            'quantite' => $quantite,
            'id_categorie' => $id_categorie
        ]);
        
        header('Location: ../views/articles/article_index.php' );
        exit();
    }
}

function modificationArticle() {
    $db = Database::getInstance()->getConnection();
    $id = $_POST["id"];
    $nom_article = $_POST["nom_article"];
    $quantite = $_POST["quantite"];
    $id_categorie = $_POST["id_categorie"];
    $query = "UPDATE articles SET nom_article = :nom_article, quantite = :quantite, id_categorie = :id_categorie WHERE id = :id";
    $modification = $db->prepare($query);
    $modification->execute([
        'id' => $id, 
        'nom_article' => $nom_article,
        'quantite' => $quantite,
        'id_categorie' => $id_categorie,
    ]);

    header('Location: ../views/articles/article_index.php' );
    exit();
}

function deleteArticle() {
    $db = Database::getInstance()->getConnection();
    $id = $_POST["id"];

    $query = "DELETE FROM articles WHERE id = :id";
    $modification = $db->prepare($query);
    $modification->execute(['id' => $id]);

    header('Location: ../views/articles/article_index.php' );
    exit();
}

$action = $_POST['action'];

switch ($action) {
    case 'createArticle':
        createArticle();
        break;
    case 'modificationArticle':
        modificationArticle();
        break;
    case 'deleteArticle' :
        deleteArticle();
        break;
}