<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Dental Office Management</title>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Dental Office Management Platform</h1>
            <nav>
                <ul>
                    <li><a href="php/stock.php" class="button">Stock Management</a></li>
                    <li><a href="php/prosthetics.php" class="button">Prosthetics</a></li>
                    <li><a href="php/calendar.php" class="button">Calendar</a></li>
                    <li><a href="php/roles.php" class="button">Role Management</a></li>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <li><a href="php/logout.php" class="button">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="php/login.php" class="button">Login</a></li>
                        <li><a href="php/register.php" class="button">Register</a></li> <!-- Register Link -->
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="welcome-section">
            <h2>Welcome to the Dental Office Management Platform</h2>
            <p>Manage your office efficiently with our intelligent tools. Our platform provides:</p>
            <ul>
                <li>Comprehensive stock tracking and management</li>
                <li>Streamlined prosthetics management</li>
                <li>Advanced calendar for scheduling and appointments</li>
                <li>Flexible role management for dynamic user assignments</li>
                <li>Simple and user-friendly interfaces</li>
            </ul>
        </section>

        <section class="features-section">
            <h2>Platform Features</h2>
            <div class="features">
                <div class="feature">
                    <h3>Stock Management</h3>
                    <p>Track products, monitor quantities, and get alerts for expiration dates.</p>
                </div>
                <div class="feature">
                    <h3>Prosthetics Management</h3>
                    <p>Manage patient prosthetics and payment statuses efficiently.</p>
                </div>
                <div class="feature">
                    <h3>Intelligent Calendar</h3>
                    <p>Filter appointments by doctor, date, and month for streamlined scheduling.</p>
                </div>
                <div class="feature">
                    <h3>Role Management</h3>
                    <p>Assign and manage user roles dynamically with ease.</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Dental Office Management Platform. All rights reserved.</p>
            <p id="role-display">
                <?php
                session_start();
                if (isset($_SESSION['role'])) {
                    echo "Logged in as: " . htmlspecialchars($_SESSION['role']);
                    echo " | <a href='php/logout.php'>Logout</a>";
                } else {
                    echo "Not logged in.";
                }
                ?>
            </p>
        </div>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
