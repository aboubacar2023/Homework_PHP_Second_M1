<?php
ob_start();
require '../racine.php';

if (!$auth->isLoggedIn()) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET["id"];
$db = Database::getInstance()->getConnection();
$sqlQuery = 'SELECT * FROM users WHERE id= :id';
$query = $db->prepare($sqlQuery);
$query->execute(['id' => $id]);
$user = $query->fetch();
?>
<div class="content-area overflow-y-auto p-6 m-6">
    <div class="mb-6 w-full">
        <a href="user.php"><button type="button"
                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900">
                Retour
            </button></a>
        <h3 class="text-2xl text-center pb-4">Modification d'un utilisateur</h3>
        <form action="../../controllers/UserController.php" method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <input type="hidden" name="id" value="<?= $user["id"] ?>">
                <input type="hidden" name="action" value="modificationUser">
                <div>
                    <label for="prenom" class="text-sm font-medium text-gray-100">Prénom</label>
                    <input type="text" name="prenom" value="<?= $user["prenom"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="nom" class="text-sm font-medium text-gray-100">Nom</label>
                    <input type="text" name="nom" value="<?= $user["nom"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="email" class="text-sm font-medium text-gray-100">Email</label>
                    <input type="text" name="email" value="<?= $user["email"] ?>" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="niveau" class="text-sm font-medium text-gray-100">Niveau</label>
                    <select type="text" name="niveau" required
                        class="text-black mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value=""></option>
                        <option <?= $user["niveau"] === 'admin' ? 'selected' : '' ?> class="text-black">
                            Administrateur</option>
                        <option <?= $user["niveau"] === 'simple' ? 'selected' : '' ?> class="text-black">
                            Utilisateur Simple</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-center text-center">
                <button type="submit"
                    class="w-60 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include '../template.php';