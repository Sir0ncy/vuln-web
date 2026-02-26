<?php

use LDAP\Result;

require 'db.php';

session_start();
$msg = '';
$debug_query = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $debug_query = "SELECT * FROM users WHERE username = '" . htmlspecialchars($username) . "' AND password = '" . htmlspecialchars($password) . "'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "Salah user/pw king";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <?php if($msg): ?>
            <p class="text-red-500 mb-4 text-center"><?php echo $msg; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring">
            </div>
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                Login
            </button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-600">Need an account? <a href="register.php" class="text-blue-500 hover:text-blue-800">Register</a></p>
        
        <?php if($debug_query): ?>
        <div class="mt-6 p-4 bg-gray-800 text-green-400 text-xs rounded break-words font-mono">
            <strong>Executed Query:</strong><br>
            <?php echo htmlspecialchars($debug_query); ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>