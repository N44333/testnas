<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'professor') {
    header("Location: login2.php");
    exit();
}

// Fetch pending ideas
$pending_ideas_sql = "SELECT * FROM project_ideas WHERE status = 'pending' ORDER BY created_at DESC";
$pending_ideas_result = $conn->query($pending_ideas_sql);

// Handle idea approval/rejection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idea_id = $_POST['idea_id'];
    $action = $_POST['action'];
    $new_status = ($action === 'approve') ? 'approved' : 'rejected';

    $update_sql = "UPDATE project_ideas SET status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $idea_id);
    $update_stmt->execute();

    header("Location: professor_dashboard.php");
    exit();
}
?>

<main>
    <h1>Professor Dashboard</h1>
    <h2>Pending Project Ideas</h2>
    <?php if ($pending_ideas_result->num_rows > 0): ?>
        <?php while ($idea = $pending_ideas_result->fetch_assoc()): ?>
            <div class="idea-card">
                <h3><?php echo $idea['title']; ?></h3>
                <p><?php echo substr($idea['description'], 0, 100) . '...'; ?></p>
                <p>Field: <?php echo $idea['field_of_study']; ?></p>
                <p>Submitted by: <?php echo get_username_by_id($idea['user_id']); ?></p>
                <form action="professor_dashboard.php" method="post" style="display: inline;">
                    <input type="hidden" name="idea_id" value="<?php echo $idea['id']; ?>">
                    <button type="submit" name="action" value="approve">Approve</button>
                    <button type="submit" name="action" value="reject">Reject</button>
                </form>
                <a href="idea_details.php?id=<?php echo $idea['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No pending ideas to review.</p>
    <?php endif; ?>
    <a href="index2.php">Back to Home</a>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>