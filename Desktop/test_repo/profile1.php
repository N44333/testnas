<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_info = get_user_info($user_id);

// Fetch user's submitted ideas
$ideas_sql = "SELECT * FROM project_ideas WHERE user_id = ? ORDER BY created_at DESC";
$ideas_stmt = $conn->prepare($ideas_sql);
$ideas_stmt->bind_param("i", $user_id);
$ideas_stmt->execute();
$ideas_result = $ideas_stmt->get_result();

// Fetch user's questions
$questions_sql = "SELECT * FROM questions WHERE user_id = ? ORDER BY created_at DESC";
$questions_stmt = $conn->prepare($questions_sql);
$questions_stmt->bind_param("i", $user_id);
$questions_stmt->execute();
$questions_result = $questions_stmt->get_result();
?>

<main>
    <h1>User Profile</h1>
    <p>Username: <?php echo $user_info['username']; ?></p>
    <p>Email: <?php echo $user_info['email']; ?></p>
    <p>User Type: <?php echo ucfirst($user_info['user_type']); ?></p>

    <h2>Submitted Ideas</h2>
    <ul>
    <?php while ($idea = $ideas_result->fetch_assoc()): ?>
        <li><a href="idea_details.php?id=<?php echo $idea['id']; ?>"><?php echo $idea['title']; ?></a></li>
    <?php endwhile; ?>
    </ul>

    <h2>Asked Questions</h2>
    <ul>
    <?php while ($question = $questions_result->fetch_assoc()): ?>
        <li><a href="question_details.php?id=<?php echo $question['id']; ?>"><?php echo $question['title']; ?></a></li>
    <?php endwhile; ?>
    </ul>

    <a href="logout2.php">Logout</a>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>