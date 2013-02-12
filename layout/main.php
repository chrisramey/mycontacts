<?php
// Store the 'p' parameter from the QS into a variable
if(isset($_GET['p'])) {
	$p = $_GET['p']; 
} else {
	$p = DEFAULT_PAGE;
}

include("pages/$p.php");