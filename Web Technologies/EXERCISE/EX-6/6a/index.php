<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root123";
$dbname = "eco_friendly_tracker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add habit
if (isset($_POST['submit'])) {
    $habit = $_POST['habit'];
    $date = $_POST['date'];
    $sql = "INSERT INTO habits (habit, date) VALUES ('$habit', '$date')";
    $conn->query($sql);
}

// Delete habit
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM habits WHERE id=$id");
}

// Update habit
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $habit = $_POST['habit'];
    $date = $_POST['date'];
    $conn->query("UPDATE habits SET habit='$habit', date='$date' WHERE id=$id");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Friendly Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f9f7; margin: 0; padding: 0; }
        .container { width: 80%; margin: 0 auto; padding: 20px; }
        h1, h2 { color: #00695c; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #004d40; color: white; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #00897b; color: white; text-decoration: none; margin: 10px 0; }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Green Tracker</h1>
    <p>Track your eco-friendly habits daily.</p>
    <a href="#addHabitForm" class="btn">Add New Habit</a>

    <h2>Your Eco-Friendly Habits</h2>
    <table>
        <thead>
            <tr>
                <th>Habit</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM habits");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['habit']}</td>
                        <td>{$row['date']}</td>
                        <td>
                            <a href='?edit_id={$row['id']}'>Edit</a> | 
                            <a href='?delete_id={$row['id']}'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php if (isset($_GET['edit_id'])):
        $id = $_GET['edit_id'];
        $result = $conn->query("SELECT * FROM habits WHERE id=$id");
        $habit = $result->fetch_assoc();
    ?>
    <h2>Edit Habit</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $habit['id'] ?>">
        <label for="habit">Habit Name:</label>
        <input type="text" id="habit" name="habit" value="<?= $habit['habit'] ?>" required>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?= $habit['date'] ?>" required>
        <button type="submit" name="update">Update Habit</button>
    </form>
    <?php endif; ?>

    <h2 id="addHabitForm">Add New Eco-Friendly Habit</h2>
    <form method="POST">
        <label for="habit">Habit Name:</label>
        <input type="text" id="habit" name="habit" required>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit" name="submit">Add Habit</button>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
