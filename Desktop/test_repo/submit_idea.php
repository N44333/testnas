<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST['title']);
    $description = sanitize_input($_POST['description']);
    $field_of_study = sanitize_input($_POST['field_of_study']);
    $tags = sanitize_input($_POST['tags']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO project_ideas (title, description, field_of_study, tags, user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $description, $field_of_study, $tags, $user_id);

    if ($stmt->execute()) {
        $success = "Idea submitted successfully!";
    } else {
        $error = "Failed to submit idea. Please try again.";
    }
}
?>

<main>
    <h1>Submit Project Idea</h1>
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="submit_idea.php" method="post">
        <input type="text" name="title" placeholder="Idea Title" required>
        <textarea name="description" placeholder="Idea Description" required></textarea>
        <input type="text" name="field_of_study" placeholder="Field of Study" required>
        <input type="text" name="tags" placeholder="Tags (comma-separated)">
        <input type="submit" value="Submit Idea">
    </form>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>