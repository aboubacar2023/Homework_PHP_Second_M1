<?php
ob_start();
require '../racine.php';

if (!$auth->isLoggedIn()) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET["id"];
$db = Database::getInstance()->getConnection();
$sqlQuery = 'SELECT nom_article, nom_categorie, quantite, articles.id, id_categorie FROM articles JOIN categories ON articles.id_categorie = categories.id WHERE articles.id= :id';
$query = $db->prepare($sqlQuery);
$query->execute(['id' => $id]);
$article = $query->fetch();

$sqlQueryCat = 'SELECT * FROM categories';
$query_2 = $db->prepare($sqlQueryCat);
$query_2->execute();
$categories = $query_2->fetchAll();
?>
<div class="content-area overflow-y-auto p-6">
    <div class="mb-6 w-full">
        <a href="article_index.php"><button type="submit"
                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900">
                Retour
            </button></a>
        <h3 class="text-2xl text-center pb-4">Modification d'un article</h3>
        <form action="../../controllers/ArticleController.php" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <input type="hidden" name="id" value="<?= $article["id"] ?>">
                <input type="hidden" name="action" value="modificationArticle">
                <div>
                    <label for="nom_article" class="text-sm font-medium text-gray-100">Nom Article</label>
                    <input type="text" name="nom_article" value="<?= $article["nom_article"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="quantite" class="text-sm font-medium text-gray-100">Quantité</label>
                    <input type="text" name="quantite" value="<?= $article["quantite"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="id_categorie" class="text-sm font-medium text-gray-100">Catégorie</label>
                    <select type="text" name="id_categorie" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value=""></option>
                        <?php foreach ($categories as $categorie) { ?>
                        <option value="<?= $categorie["id"] ?>"
                            <?= $categorie["id"] === $article["id_categorie"] ? 'selected' : '' ?> class="text-black">
                            <?= $categorie["nom_categorie"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include '../template.php';