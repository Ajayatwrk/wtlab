<?php include 'db.php'; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM habits WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_habits.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
