<?php
function format_phone($phone) {
	$number = '1-'.substr($phone,0,3).'-'.substr($phone,3,3).'-'.substr($phone,-4);
	return '('.substr($phone,0,3).') '.substr($phone,3,3).'-'.substr($phone,-4);
}

/**
 * Generates an HTML input element with the given attribute values.
 * This function also examines SESSION data for previously
 * entered values with the same name
 * @param String $name
 * @param String $placeholder
 * @return HTML input element
 */
function input($name, $placeholder, $value=null, $class='') {
	if($value == null && isset($_SESSION['POST'][$name])) {
		$value = $_SESSION['POST'][$name];
		
		// Remove from session data
		unset($_SESSION['POST'][$name]);
		
		if($value == '') { // nothing was entered for this item in the form
			$class .= ' error';
		}
	} else { // No session data (probably first time visiting form)
		$value = ''; // no pre-populated value
	}
	return "<input class=\"$class\" type=\"text\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\" />";
}

/**
 * Generates an HTML select element with the given name
 * attribute and option elements.
 * This function also examines session data for a previously
 * submitted value
 * @param String $name Name attribute
 * @param Array $options Array of options in the form value => text
 * @return HTML select element
 */
function dropdown($name, $options) {
	$select = "<select name=\"$name\">";
	
	// Add option elements to select element
	foreach($options as $value => $text) {
		// If there is session form data for $name, AND its value
		// is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name] == $value) {
			unset($_SESSION['POST'][$name]);
			$selected = 'selected="selected"';
		} else {
			$selected = '';
		}
		$select .= "<option $selected value=\"$value\">$text</option>";
	}
	
	$select .= "</select>";
	return $select;
}

/**
 * Generates a HTML radio buttons with the given name
 * attribute and options
 * This function also examines session data for a previously
 * submitted value
 * @param String $name Name attribute
 * @param Array $options Array of options in the form value => text
 * @return HTML input[type=radio] elements, wrapped in labels
 */
function radio($name, $options) {
	$radio = '';
	
	// Loop over options
	foreach($options as $value => $text) {
		// If there is session form data for $name, AND its value
		// is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name] == $value) {
			unset($_SESSION['POST'][$name]);
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}
		$radio .= "<label><input type=\"radio\" name=\"$name\" value=\"$value\" $checked /> $text</label>";
	}
	return $radio;
}