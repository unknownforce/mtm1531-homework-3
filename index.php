<?php

	$possible_lang = array (
		'eng' => 'English',
		'fre' => 'French',
		'spa' => 'Spanish'
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
		
		if (mb_strlen($username) > 25) {
			$errors['username'] = true;		
		}
		
		if (empty($password)) {
			$errors['password'] = true ;	
		}
		
		if (!array_key_exists($lang, $possible_lang)) {
			$errors['lang'] = true;	
		}
		
		if ($terms == 'unchecked') {
			$errors['terms'] = true;	
		}
		
		
	}
	
	$thanks = "Thank you for using our mail form";

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Form Validation</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>
	
<h3><?php
if (isset($_REQUEST['email'])){ //if "email" is filled out, send email {
	$email = $_REQUEST['email'];
	$name = $_REQUEST['name'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$notes = $_REQUEST['notes'];
	$from = "Petrus";
	$headers = "From:" . $from;
	mail($email,$name,$notes,$username,$password,$lang,$headers);
  	echo $thanks;
  
  }
?></h3>



	
	<form method="post" action="index.php">
		<div>
			<label for="name">Name</label>
			<input type="name" id="name" name="name" value="<?php echo $name; ?>" required><?php if (isset($errors['name'])) : ?> <strong>is required</strong><?php endif; ?>
		</div>
		<div>
			<label for="email">Email</label>
			<input type="email" id="email" name="email" value="<?php echo $email; ?>" required><?php if (isset($errors['email'])) : ?> <strong>enter a valid email address</strong><?php endif; ?>
		</div>
		<div>
			<label for="username">Username</label>
			<input type="text" id="username" name="username" value="<?php echo $username; ?>" required><?php if (isset($errors['username'])) : ?> <strong>less than 25 characters</strong><?php endif; ?>
		</div>
		<div>
			<label for="password">Password</label>
			<input type="password" id="password" name="password" value="<?php echo $password; ?>" required><?php if (isset($errors['password'])) : ?> <strong>please enter a password</strong><?php endif; ?>
		</div>
		<div>
			<fieldset>
				<legend>Preferred Language</legend><?php if (isset($errors['lang'])) : ?> <strong>choose a language</strong><?php endif; ?>
			<?php foreach($possible_lang as $key => $value) : ?>
				<input type="radio" id="<?php echo $key; ?>" name="lang" value="<?php echo $key; ?>"<?php if ($key == $lang) { echo ' checked'; } ?> required>
				<label for="<?php echo $key; ?>"><?php echo $value; ?></label>
			<?php endforeach; ?>
			</fieldset>
		</div>
		<div>
			<label for="notes">Notes</label>
			<textarea id="notes" name="notes"><?php echo $notes; ?></textarea>
		</div>
		<div>
			<fieldset>
				<input type="checkbox" id="terms" name="terms" required>
				<label for="terms">Accept the Terms</label><?php if (isset($errors['terms'])) : ?> <strong>must accept the terms</strong><?php endif; ?>
			</fieldset>
		</div>
		<div>
			<button type="submit" name="submit">Send Message</button>
		</div>
	</form>

</body>
</html>