<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>Your role: <?php echo $_SESSION['role']; ?></p>
    <p><a href="add_complaint.php">Submit a Complaint</a></p>
<p><a href="my_complaints.php">My Complaints</a></p>
<?php if ($_SESSION['role'] == 'admin') { ?>
    <p><a href="admin_complaints.php">Manage All Complaints</a></p>
<?php } ?>
<p><a href="logout.php">Logout</a></p>
</body>
</html>