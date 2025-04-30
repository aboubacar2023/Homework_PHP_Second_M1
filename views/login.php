<?php
require 'racine.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($auth->login($_POST['email'], $_POST['password'])) {
        header('Location: categories/categorie_index.php');
        exit;
    } else {
        if ($_SESSION['error']) {
            $error = $_SESSION['error'];
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <title>Page Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
    <form method="POST" class="bg-white dark:bg-gray-800 p-8 rounded shadow-md w-96">
        <h1 class="text-2xl mb-6 text-gray-900 dark:text-white">Connexion</h1>
        <?php if (isset($error)) echo "<p class='text-red-500 pb-3'>$error</p>"; ?>
        <input type="email" name="email" placeholder="Votre email" required class="w-full p-2 mb-4 border rounded">
        <input type="password" name="password" placeholder="Votre mot de passe" required
            class="w-full p-2 mb-4 border rounded">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white p-2 rounded">Se connecter</button>
        <p class="mt-4 text-gray-700 dark:text-gray-300"><a href="register.php" class="text-blue-500">Créer
                un compte</a></p>
    </form>
</body>

</html>