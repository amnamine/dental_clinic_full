<?php
include 'db.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if user is an admin
$isAdmin = $_SESSION['role'] === 'admin';

// Handle form submission to add new appointment (only if the user is an admin)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_name = $_POST['doctor_name'];
    $patient_name = $_POST['patient_name'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO calendar (doctor_name, patient_name, appointment_date, appointment_time)
            VALUES ('$doctor_name', '$patient_name', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        $message = "New appointment added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch existing appointments from the database
$sql = "SELECT * FROM calendar ORDER BY appointment_date, appointment_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Appointment Calendar</h1>
            <nav>
                <ul>
                    <li><a href="../index.php" class="button">Return to Main Page</a></li>
                    <li><a href="../php/logout.php" class="button">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Appointments</h2>

        <!-- Display success/error message -->
        <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

        <!-- Form to add new appointment (visible only for admin) -->
        <?php if ($isAdmin) { ?>
            <h3>Add New Appointment</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="doctor_name">Doctor Name:</label>
                    <input type="text" name="doctor_name" id="doctor_name" required>
                </div>
                <div class="form-group">
                    <label for="patient_name">Patient Name:</label>
                    <input type="text" name="patient_name" id="patient_name" required>
                </div>
                <div class="form-group">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" name="appointment_date" id="appointment_date" required>
                </div>
                <div class="form-group">
                    <label for="appointment_time">Appointment Time:</label>
                    <input type="time" name="appointment_time" id="appointment_time" required>
                </div>
                <button type="submit" class="button">Add Appointment</button>
            </form>
        <?php } ?>

        <h3>Scheduled Appointments</h3>
        <table border="1">
            <tr>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['doctor_name']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </main>

    <footer>
        <div class="footer-container">
            <p>Logged in as: <?php echo $_SESSION['username']; ?> | Role: <?php echo $_SESSION['role']; ?></p>
        </div>
    </footer>
</body>
</html>
