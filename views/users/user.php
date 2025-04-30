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
$sqlQuery = 'SELECT * FROM users';
$query = $db->prepare($sqlQuery);
$query->execute();
$users = $query->fetchAll();
?>
<div class="content-area overflow-y-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Utilisateurs</h1>
    </div>

    <div class="bg-dark-200 rounded-lg border border-dark-300 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-dark-300">
                <thead class="bg-dark-300">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Prenom</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Nom</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Email</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Niveau</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Etat</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Date Creation</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-300">
                    <?php foreach ($users as $user) {?>
                    <tr class="hover:bg-dark-300">
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['prenom']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['nom']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['email']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo ucfirst($user['niveau']); ?></td>
                        <?php if($user['etat'] === 1) { ?>
                        <td class="px-6 py-4 whitespace-nowrap"><span
                                class="px-2 py-1 text-xs rounded-full bg-green-500/10 text-green-500">Activé</span>
                        </td>
                        <?php }else {?>
                        <td class="px-6 py-4 whitespace-nowrap"><span
                                class="px-2 py-1 text-xs rounded-full bg-red-500/10 text-red-500">Bloquée</span>
                        </td>
                        <?php }?>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $user['created_at']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="update_user.php?id=<?= $user['id'] ?>">
                                    <button class="text-blue-400 hover:text-blue-500">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <form action="../../controllers/UserController.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $user["id"] ?>">
                                    <input type="hidden" name="action" value="modificationEtat">
                                    <input type="hidden" name="etat" value="<?= $user["etat"] ?>">
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