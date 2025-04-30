<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
    <form action="../controllers/RegisterController.php" method="POST"
        class="bg-white dark:bg-gray-800 p-8 rounded shadow-md w-96">
        <h1 class="text-2xl mb-6 text-gray-900 dark:text-white">Enregistrement</h1>
        <input type="text" name="prenom" placeholder="Votre Prénom" required class="w-full p-2 mb-4 border rounded">
        <input type="text" name="nom" placeholder="Votre Nom" required class="w-full p-2 mb-4 border rounded">
        <input type="email" name="email" placeholder=" Votre email" required class="w-full p-2 mb-4 border rounded">
        <input type="password" name="password" placeholder="Votre mot de passe" required
            class="w-full p-2 mb-4 border rounded">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white p-2 rounded">Enregistrer</button>
        <p class="mt-4 text-gray-700 dark:text-gray-300"><a href="login.php" class="text-blue-500">Se
                connecter</a></p>
    </form>
</body>

</html>