<?php
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = password_hash(sanitize_input($_POST['password']), PASSWORD_DEFAULT);
    $user_type = sanitize_input($_POST['user_type']); // 'student' or 'professor'

    $sql = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $user_type);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: login2.php");
        exit();
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>

<main>
    <h1>Register</h1>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="register2.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="user_type" required>
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select>
        <input type="submit" value="Register">
    </form>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>