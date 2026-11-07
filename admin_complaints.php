<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE complaints SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

$result = $conn->query("SELECT c.id, c.title, c.category, c.description, c.status, c.created_at, u.name
                        FROM complaints c
                        JOIN users u ON c.user_id = u.id
                        ORDER BY c.created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Complaints</title>
</head>
<body>
    <h2>All Complaints (Admin)</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Student</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option <?php if ($row['status'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                    </select>
                    <button type="submit">Save</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <p><a href="dashboard.php">Back to dashboard</a></p>
</body>
</html>