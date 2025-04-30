<?php
ob_start();
require '../racine.php';

if (!$auth->isLoggedIn()) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET["id"];
$db = Database::getInstance()->getConnection();
$sqlQuery = 'SELECT * FROM categories WHERE id= :id';
$query = $db->prepare($sqlQuery);
$query->execute(['id' => $id]);
$categorie = $query->fetch();
?>
<div class="content-area overflow-y-auto p-6">
    <div class="mb-6 w-full">
        <a href="categorie_index.php"><button type="submit"
                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900">
                Retour
            </button></a>
        <h3 class="text-2xl text-center pb-4">Modification d'une Catégorie</h3>
        <form action="../../controllers/CategorieController.php" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <input type="hidden" name="id" value="<?= $categorie["id"] ?>">
                <input type="hidden" name="action" value="modificationCategorie">
                <div>
                    <label for="nom_categorie" class="text-sm font-medium text-gray-100">Nom Catégorie</label>
                    <input type="text" name="nom_categorie" value="<?= $categorie["nom_categorie"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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