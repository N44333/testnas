<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Project Ideas Hub'; ?></title>
    <link rel="stylesheet" href="css/style9.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index2.php">Home</a></li>
                <li><a href="browse_ideas.php">Browse Ideas</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="submit_idea.php">Submit Idea</a></li>
                    <li><a href="ask_question.php">Ask Question</a></li>
                    <li><a href="profile1.php">Profile</a></li>
                    <li><a href="logout2.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login2.php">Login</a></li>
                    <li><a href="register2.php">Register</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'professor'): ?>
                    <li><a href="professor_dashboard.php">Professor Dashboard</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>