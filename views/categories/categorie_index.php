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
$sqlQuery = 'SELECT * FROM categories';
$query = $db->prepare($sqlQuery);
$query->execute();
$categories = $query->fetchAll();
?>
<div class="content-area overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Catégories</h1>
        <a href="categorie_create.php">
            <button class="bg-primary-500 hover:bg-primary-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau catégorie
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
                            ID</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Nom Catégorie</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-300">
                    <?php foreach ($categories as $categorie) {?>
                    <tr class="hover:bg-dark-300">
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $categorie['id']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $categorie['nom_categorie']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="categorie_update.php?id=<?= $categorie['id'] ?>">
                                    <button class="text-blue-400 hover:text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <form action="../../controllers/CategorieController.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $categorie["id"] ?>">
                                    <input type="hidden" name="action" value="deleteCategorie">
                                    <button type="submit" class="text-red-400 hover:text-red-500">
                                        <i class="fas fa-trash"></i>
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