<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission for adding new stock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $supplier = $_POST['supplier'];

    $sql = "INSERT INTO stock (product_name, quantity, expiration_date, supplier) 
            VALUES ('$product_name', $quantity, '$expiration_date', '$supplier')";

    if ($conn->query($sql) === TRUE) {
        $message = "New stock added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch stock data
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Stock Management</h1>
            <nav>
                <ul>
                    <li><a href="../index.php" class="button">Return to Main Page</a></li>
                    <li><a href="logout.php" class="button">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Manage Your Stock</h2>
        <?php if (isset($message)) { echo "<p style='color: green;'>$message</p>"; } ?>

        <!-- Add Stock Form -->
        <section>
            <h3>Add New Stock</h3>
            <form method="POST">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" required>
                <br>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
                <br>
                <label for="expiration_date">Expiration Date:</label>
                <input type="date" name="expiration_date" required>
                <br>
                <label for="supplier">Supplier:</label>
                <input type="text" name="supplier" required>
                <br>
                <button type="submit" name="add_stock" class="button">Add Stock</button>
            </form>
        </section>

        <!-- Stock Table -->
        <section>
            <h3>Current Stock</h3>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Expiration Date</th>
                    <th>Supplier</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { 
                    $status = "";
                    $current_date = time();
                    $expiration_date = strtotime($row['expiration_date']);
                    
                    if ($row['quantity'] < 5) {
                        $status = "Low Stock!";
                    } elseif ($expiration_date - $current_date < 30 * 86400) {
                        $status = "Near Expiration!";
                    }
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($row['expiration_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                    <td><?php echo htmlspecialchars($status); ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong></p>
        </div>
    </footer>
</body>
</html>
