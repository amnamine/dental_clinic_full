<?php
include 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission for adding prosthetics
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prosthetic_name = $_POST['prosthetic_name'];
    $patient_name = $_POST['patient_name'];
    $payment_status = $_POST['payment_status'];

    $sql = "INSERT INTO prosthetics (prosthetic_name, patient_name, payment_status) 
            VALUES ('$prosthetic_name', '$patient_name', '$payment_status')";

    if ($conn->query($sql) === TRUE) {
        $message = "Prosthetic added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch all prosthetics data
$sql = "SELECT * FROM prosthetics ORDER BY payment_status, prosthetic_name";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Prosthetics Management</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Prosthetics Management</h1>
        <nav>
            <a href="../index.php" class="button">Main Page</a>
            <a href="logout.php" class="button">Logout</a>
        </nav>
    </header>
    <main>
        <?php if (isset($message)) { ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php } ?>

        <form method="POST" class="form">
            <label for="prosthetic_name">Prosthetic Name:</label>
            <input type="text" name="prosthetic_name" required>
            <br>

            <label for="patient_name">Patient Name:</label>
            <input type="text" name="patient_name" required>
            <br>

            <label for="payment_status">Payment Status:</label>
            <select name="payment_status" required>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>
            <br>

            <button type="submit">Add Prosthetic</button>
        </form>

        <h2>Prosthetics List</h2>
        <table>
            <thead>
                <tr>
                    <th>Prosthetic Name</th>
                    <th>Patient Name</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['prosthetic_name']; ?></td>
                        <td><?php echo $row['patient_name']; ?></td>
                        <td><?php echo $row['payment_status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
    </footer>
</body>
</html>
