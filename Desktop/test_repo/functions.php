<?php

function get_user_info($user_id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function get_username_by_id($user_id) {
    global $conn;
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user ? $user['username'] : 'Unknown User';
}

function sanitize_input($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function redirect($location) {
    header("Location: $location");
    exit();
}

function display_error($message) {
    return "<p class='error'>$message</p>";
}

function display_success($message) {
    return "<p class='success'>$message</p>";
}

// Add more functions as needed for your project