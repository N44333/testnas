<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO questions (title, content, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $user_id);

    if ($stmt->execute()) {
        $success = "Question submitted successfully!";
    } else {
        $error = "Failed to submit question. Please try again.";
    }
}
?>

<main>
    <h1>Ask a Coding Question</h1>
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="ask_question.php" method="post">
        <input type="text" name="title" placeholder="Question Title" required>
        <textarea name="content" placeholder="Question Details" required></textarea>
        <input type="submit" value="Submit Question">
    </form>
    <a href="index2.php">Back to Home</a>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
