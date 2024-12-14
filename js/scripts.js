document.addEventListener("DOMContentLoaded", () => {
    console.log("Dental Office Management Platform Loaded.");

    // Function to handle the display of the logged-in user's role
    function displayUserRole() {
        // Check if user is logged in by looking for session data
        fetch('php/check_user.php')
            .then(response => response.json())
            .then(data => {
                if (data.loggedIn) {
                    // Display the role in the footer
                    const footer = document.getElementById('footer');
                    footer.innerHTML = `Logged in as: ${data.username} (${data.role})`;

                    // Show the logout button
                    const logoutButton = document.getElementById('logout-btn');
                    logoutButton.style.display = 'inline-block';
                } else {
                    // If not logged in, don't display the role or the logout button
                    const footer = document.getElementById('footer');
                    footer.innerHTML = `Not logged in`;

                    const logoutButton = document.getElementById('logout-btn');
                    logoutButton.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching user role:', error));
    }

    // Call displayUserRole when the page is loaded to show the logged-in status
    displayUserRole();

    // Handle the logout functionality
    const logoutButton = document.getElementById('logout-btn');
    if (logoutButton) {
        logoutButton.addEventListener('click', () => {
            // Log out the user by making an AJAX request to the logout PHP file
            fetch('php/logout.php')
                .then(response => response.text())
                .then(data => {
                    // After successful logout, reload the page or redirect to login
                    window.location.href = "index.html";
                })
                .catch(error => console.error('Error during logout:', error));
        });
    }

    // Return to the main page when the "Return to Main" button is clicked
    const returnToMainButton = document.getElementById('return-to-main');
    if (returnToMainButton) {
        returnToMainButton.addEventListener('click', () => {
            window.location.href = 'index.html';
        });
    }
});
