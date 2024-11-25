<?php include 'db.php'; ?>
<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $habit = $_POST['habit'];
    $date = $_POST['date'];
    $sql = "UPDATE habits SET habit='$habit', date='$date' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_habits.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM habits WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Habit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Habit</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="habit">Habit Name:</label>
            <input type="text" id="habit" name="habit" value="<?php echo $row['habit']; ?>" required>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required>
            <button type="submit" name="update">Update Habit</button>
        </form>
    </div>
</body>
</html>
