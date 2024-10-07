<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

if (isset($_GET['id'])) {
    $idea_id = $_GET['id'];
    $sql = "SELECT * FROM project_ideas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idea_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $idea = $result->fetch_assoc();
} else {
    header("Location: browse_ideas.php");
    exit();
}
?>

<main>
    <h1><?php echo $idea['title']; ?></h1>
    <p>Field of Study: <?php echo $idea['field_of_study']; ?></p>
    <p>Tags: <?php echo $idea['tags']; ?></p>
    <h2>Description:</h2>
    <p><?php echo $idea['description']; ?></p>
    <p>Submitted by: <?php echo get_username_by_id($idea['user_id']); ?></p>
    <p>Submitted on: <?php echo $idea['created_at']; ?></p>
    <a href="browse_ideas.php">Back to Browse Ideas</a>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
