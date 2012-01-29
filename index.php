<?php

	$possible_lang = array (
		'English',
		'French',
		'Spanish'
	);
	
	$errors = array();
	
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
	$lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_STRING);
	$terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_STRING);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (empty($name)) {
			$errors['name'] = true;
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = true;	
		}
		
		if (mb_strlen($username) < 25) {
			$errors['username'] = true;		
		}
		
		if (empty($password)) {
			$errors['password'] = true ;	
		}
		
		if (!in_array($lang, $possible_lang)) {
			$errors['lang'] = true;	
		}
		
		
		
	}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Form Validation</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
	
	<form method="post" action="index.php">
		<div>
			<label for="name">Name</label>
			<input type="name" id="name" name="name" required><?php if (isset($errors['name'])) : ?> <strong>is required</strong><?php endif; ?>
		</div>
		<div>
			<label for="email">Email</label>
			<input type="email" id="email" name="email" required><?php if (isset($errors['email'])) : ?> <strong>enter a valid email address</strong><?php endif; ?>
		</div>
		<div>
			<label for="username">Username</label>
			<input type="text" id="username" name="username"required><?php if (isset($errors['username'])) : ?> <strong>less than 25 characters</strong><?php endif; ?>
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" id="password" name="password" required><?php if (isset($errors['password'])) : ?> <strong>please enter a password</strong><?php endif; ?>
		</div>
		<div>
			<fieldset>
				<legend>Preferred Language</legend><?php if (isset($errors['lang'])) : ?> <strong>choose a language</strong><?php endif; ?>
				<input type="radio" id="lang" name="lang" required>
				<label for="lang"></label>
			</fieldset>
		</div>
		<div>
			<label for="notes">Notes</label>
			<textarea id="notes" name="notes"></textarea>
		</div>
		<div>
			<fieldset>
				<input type="checkbox" id="terms" name="terms" required>
				<label for="terms">Accept the Terms</label><?php if (isset($errors['terms'])) : ?> <strong>must accept the terms</strong><?php endif; ?>
			</fieldset>
		</div>
		<div>
			<button type="submit">Send Message</button>
		</div>
	</form>


@name 	@type 	required 	notes
name 	text 	• 	
email 	email 	• 	valid e-mail address
username 	text 	• 	max length 25 characters
password 	password 	• 	

notes 	textarea 		
acceptterms 	checkbox 	• 


</body>
</html>