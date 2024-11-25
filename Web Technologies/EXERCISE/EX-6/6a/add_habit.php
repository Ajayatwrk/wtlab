<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Habit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add a New Eco-Friendly Habit</h2>
        <form action="" method="POST">
            <label for="habit">Habit Name:</label>
            <input type="text" id="habit" name="habit" required>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <button type="submit" name="submit">Add Habit</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $habit = $_POST['habit'];
            $date = $_POST['date'];
            $sql = "INSERT INTO habits (habit, date) VALUES ('$habit', '$date')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Habit added successfully!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
    </div>
</body>
</html>
