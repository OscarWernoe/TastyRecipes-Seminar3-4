<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tasty Recipes</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>../resources/css/normalize.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>../resources/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?=base_url();?>../resources/js/user.js"></script>
    <script src="<?=base_url();?>../resources/js/comments.js"></script>
	</head>
	<body>
		<header>
			<h1>Tasty Recipes</h1>
		</header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><a href="<?=base_url();?>home">Home</a></li>
          <li><a href="<?=base_url();?>calendar">Calendar</a></li>
          <?php if(!$this->session->userdata('logged_in')): ?>
            <li><a href="<?=base_url();?>register">Register</a></li>
            <li><a href="<?=base_url();?>sign_in">Sign in</a></li>
          <?php endif; ?>
          <?php if($this->session->userdata('logged_in')): ?>
          <li><a href="" id="sign-out">Sign out</a></li>
          <?php endif; ?>
        </ul>
			</div>
	</nav>