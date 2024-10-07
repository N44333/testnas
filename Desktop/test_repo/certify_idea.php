<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

// Check if the user is logged in and is a professor/professional
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'professor') {
    header("Location: login2.php");
    exit();
}

function log_error($message) {
    $log_file = 'error_log.txt'; // Specify your log file path
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idea_id = $_POST['idea_id'];
    $certifier_id = $_SESSION['user_id'];
    $comments = sanitize_input($_POST['comments']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Update the project idea status
        $update_idea_sql = "UPDATE project_ideas SET certification_status = 'certified' WHERE id = ?";
        $update_idea_stmt = $conn->prepare($update_idea_sql);
        $update_idea_stmt->bind_param("i", $idea_id);
        $update_idea_stmt->execute();

        // Insert the certification record
        $insert_cert_sql = "INSERT INTO certifications (idea_id, certifier_id, comments) VALUES (?, ?, ?)";
        $insert_cert_stmt = $conn->prepare($insert_cert_sql);
        $insert_cert_stmt->bind_param("iis", $idea_id, $certifier_id, $comments);
        $insert_cert_stmt->execute();

        // Commit the transaction
        $conn->commit();

        $success = "Project idea successfully certified!";
    } catch (Exception $e) {
        // An error occurred; rollback the transaction
        $conn->rollback();
        $error_message = "Error certifying project idea: " . $e->getMessage();
        log_error($error_message); // Log the error
        $error = "There was a problem certifying the project idea. Please try again later."; // User-friendly message
    }
}
?>

<main>
    <h1>Certify Project Idea</h1>
    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form action="certify_idea.php" method="post">
        <input type="hidden" name="idea_id" value="<?php echo $_GET['id']; ?>">
        <textarea name="comments" placeholder="Certification Comments"></textarea>
        <input type="submit" value="Certify Project Idea">
    </form>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>