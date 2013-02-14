<?php session_start() ?>
<?php 
// Import
require_once('../config/db.php');
require_once('../lib/functions.php');

// Connect to DB
$conn = connect();

// Execute DELETE query
$sql = "DELETE FROM contacts WHERE contact_id={$_POST['contact_id']}";
$conn->query($sql);

// Check for error
if($conn->errno > 0) {
	echo "<h4>SQL Error #{$conn->errno}:</h4>";
	echo "<p>{$conn->error}</p>";
	echo "<p><strong>SQL Executed: </strong>$sql</p>";
	die();
}

// Close connection
$conn->close();

// Redirect with message
$_SESSION['message'] = array(
	'type' => 'warning',
	'text' => 'Your contact was successfully deleted'
);
header('Location:../?p=list_contacts');