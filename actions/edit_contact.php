<?php session_start() ?>
<?php 
// Import
require_once('../config/db.php');
require_once('../lib/functions.php');

extract($_POST);

// Validate form data
$required = array(
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone1',
	'contact_phone2',
	'contact_phone3'
);
// Validate form data
foreach($required as $r) {
	// If invalid, redirect with message
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
		// Store message into session
		$_SESSION['message'] = array(
			'type'	=> 'danger',
			'text'	=> 'Please provide all required information.'
		);
		
		// Store form data into session data
		$_SESSION['POST'] = $_POST;
		
		// Set location header
		header("Location:../?p=form_edit_contact&id=$contact_id");
		
		// Kill script
		die();
	}
}

// If we're here, data must be valid...proceed

// Construct phone number
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;

// Connect to DB
$conn = connect();

// Execute UPDATE query
$sql = "UPDATE contacts SET contact_firstname='$contact_firstname',contact_lastname='$contact_lastname',contact_email='$contact_email',contact_phone=$contact_phone WHERE contact_id=$contact_id";
$conn->query($sql);

// Check for SQL error
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
	'text' => "<strong>$contact_firstname $contact_lastname</strong> was successfully updated"
);
header('Location:../?p=list_contacts');