

<!--
// Set timezone
date_default_timezone_set('Asia/Manila');

// Include the database configuration file
require_once '../core/config.php';// Adjust the path as needed

try {
    // Construct the DSN using the constants from config.php
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

    // Use the constants for username and password from config.php
    $username = DB_USER;
    $password = DB_PASS;

    // No custom options are defined in config.php, so $options can be left empty
    $options = [];

    // Create a new PDO instance for database connection using the settings from config.php
    $db = new PDO($dsn, $username, $password, $options);

    // Prepare and execute the DELETE statement to remove all rows from the table
    $stmt = $db->prepare("DELETE FROM attendances");
    $stmt->execute();

    echo "All rows deleted successfully.";
} catch(PDOException $e) {
    // Handle any database errors
    echo "Error: " . $e->getMessage();
}
?>





<!--
    meron den php <-?php
// Set timezone
date_default_timezone_set('Asia/Manila');

// Include your model class
require_once '../models/Attendance.php'; // Update the path accordingly

// Create an instance of the Attendance model
$attendance = new Attendance();

// Truncate the table
if (date('H:i:s') === '00:00:00') {
    $attendance->truncate();
}


echo "Table truncated successfully.";
my php dito php?>
-->