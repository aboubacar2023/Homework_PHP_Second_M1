<?php
ob_start(); 
session_start();
require __DIR__ . '/../../controllers/AuthController.php';
$auth = new Auth();

if (!$auth->isLoggedIn()) {
    header('Location: ../login.php');
    exit;
}
$db = Database::getInstance()->getConnection();
$sqlQuery = 'SELECT nom_article, nom_categorie, quantite, articles.id FROM articles JOIN categories ON articles.id_categorie = categories.id';
$query = $db->prepare($sqlQuery);
$query->execute();
$articles = $query->fetchAll();
?>
<div class="content-area overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Articles</h1>
        <a href="article_create.php">
            <button class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouvel article
            </button>
        </a>
    </div>

    <div class="bg-dark-200 rounded-lg border border-dark-300 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-dark-300">
                <thead class="bg-dark-300">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Nom Article</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Catégorie</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Quantité</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-300">
                    <?php foreach ($articles as $article) {?>
                    <tr class="hover:bg-dark-300">
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $article['nom_article']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $article['nom_categorie']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $article['quantite']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="article_update.php?id=<?= $article['id'] ?>">
                                    <button class="text-blue-400 hover:text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <form action="../../controllers/ArticleController.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $article["id"] ?>">
                                    <input type="hidden" name="action" value="deleteArticle">
                                    <button type="submit" class="text-red-400 hover:text-red-500">
                                        <i class="fas fa-rotate-right"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../template.php';