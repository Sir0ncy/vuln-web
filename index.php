<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Practice Target</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 text-center">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Welcome</h1>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <p class="text-green-600 font-semibold mb-6">You are currently logged in as <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
            <div class="space-y-4">
                <a href="dashboard.php" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Go to Dashboard
                </a>
                <a href="logout.php" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Logout
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <a href="login.php" class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Login
                </a>
                <a href="register.php" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Register
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>