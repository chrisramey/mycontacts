<?php
session_start();
require_once('../config/db.php');
require_once('../lib/functions.php');

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
		header('Location:../?p=form_add_contact');
		
		// Kill script
		die();
	}
}

// Add contact to DB
// Extract form data
extract($_POST);

// Construct phone number
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;

// Connect to DB
$conn = connect();

// Query DB
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone) VALUES ('$contact_firstname','$contact_lastname','$contact_email',$contact_phone)";
$conn->query($sql);

// Close connection
$conn->close();

// Set message in session data
$_SESSION['message'] = array(
	'type'	=> 'success',
	'text'	=> "<strong>$contact_firstname $contact_lastname</strong> was successfully added."
);

// Set location header
header('Location:../?p=list_contacts');