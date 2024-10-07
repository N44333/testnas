<?php
session_start();
include 'includes/db_connect.php';
include 'includes/functions.php';
include 'includes/header1.php';

// Fetch all fields of study for filtering
$fields_query = "SELECT DISTINCT field_of_study FROM project_ideas";
$fields_result = $conn->query($fields_query);

// Apply filters if any
$where_clause = "";
if (isset($_GET['fields']) && !empty($_GET['fields'])) {
    $selected_fields = $_GET['fields'];
    $where_clause = "WHERE field_of_study IN ('" . implode("','", $selected_fields) . "')";
}

// Fetch ideas
$ideas_query = "SELECT * FROM project_ideas $where_clause ORDER BY created_at DESC";
$ideas_result = $conn->query($ideas_query);
?>

<main>
    <h1>Browse Project Ideas</h1>
    
    <form action="browse_ideas.php" method="get">
        <h2>Filter by Field of Study:</h2>
        <?php while ($field = $fields_result->fetch_assoc()): ?>
            <label>
                <input type="checkbox" name="fields[]" value="<?php echo $field['field_of_study']; ?>"
                    <?php echo (isset($_GET['fields']) && in_array($field['field_of_study'], $_GET['fields'])) ? 'checked' : ''; ?>>
                <?php echo $field['field_of_study']; ?>
            </label>
        <?php endwhile; ?>
        <input type="submit" value="Apply Filters">
    </form>

    <div class="ideas-container">
        <?php while ($idea = $ideas_result->fetch_assoc()): ?>
            <div class="idea-card">
                <h2><?php echo $idea['title']; ?></h2>
                <p><?php echo substr($idea['description'], 0, 100) . '...'; ?></p>
                <p>Field: <?php echo $idea['field_of_study']; ?></p>
                <p>Tags: <?php echo $idea['tags']; ?></p>
                <a href="idea_details.php?id=<?php echo $idea['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="index2.php">Back to Home</a>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>