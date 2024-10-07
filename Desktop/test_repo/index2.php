<?php
session_start();

// Ensure this file exists: includes/db_connect.php
include 'includes/db_connect.php';

// Ensure this file exists: includes/header1.php
include 'includes/header1.php';
?>

<main>
    <h1>Welcome to Project Ideas Hub</h1>
    <p>A platform for students to share and explore project ideas, and get help with coding questions.</p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Welcome back, <?php echo $_SESSION['username']; ?>!</p>
        <ul>
            <li><a href="submit_idea.php">Submit a Project Idea</a></li>
            <li><a href="browse_ideas.php">Browse Project Ideas</a></li>
            <li><a href="ask_question.php">Ask a Coding Question</a></li>
        </ul>
    <?php else: ?>
        <p>Please <a href="login2.php">login</a> or <a href="register2.php">register</a> to participate.</p>
    <?php endif; ?>
</main>

<?php 
// Ensure this file exists: includes/footer.php
include 'includes/footer.php'; 
?>
</body>
</html>