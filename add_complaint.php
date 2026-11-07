<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO complaints (user_id, title, category, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $category, $description);

    if ($stmt->execute()) {
        $message = "Complaint submitted successfully!";
    } else {
        $message = "Something went wrong. Try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Complaint</title>
</head>
<body>
    <h2>Submit a Complaint</h2>
    <p><?php echo $message; ?></p>
    <form method="POST">
        <input type="text" name="title" placeholder="Complaint title" required><br><br>
        <select name="category" required>
            <option value="">Select category</option>
            <option>Hostel</option>
            <option>Mess</option>
            <option>Classroom</option>
            <option>Internet / Wi-Fi</option>
            <option>Other</option>
        </select><br><br>
        <textarea name="description" rows="5" cols="40" placeholder="Describe the problem" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>
    <p><a href="dashboard.php">Back to dashboard</a></p>
</body>
</html>