<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Habits</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
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
                $sql = "SELECT * FROM habits";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['habit']}</td>
                                <td>{$row['date']}</td>
                                <td>
                                    <a href='update_habit.php?id={$row['id']}'>Edit</a> | 
                                    <a href='delete_habit.php?id={$row['id']}'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No habits found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
