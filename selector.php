<?php
	require_once('AdminerThemes.php');

	// ----- Themes
	
	$themesDirectory = 'styles';
	$themeDestination = './';
	
	$themeProvider = new AdminerThemes($themesDirectory, $themeDestination);
	
	// themes list
	$themeList = $themeProvider->themesList;
	
	// selected theme
    $selected = $themeProvider->getSelection();
	
	
	// ----- Theme selection

	// capture form submission
    if (isset($_GET['theme'])) {
    	
    	$selectedTheme = $_GET['theme'];
    	
    	$themeProvider->selectTheme($selectedTheme);
    	
    	// getting updated selected
		$selected = $themeProvider->getSelection();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Adminer theme selector</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="bg-info">

<nav class="navbar navbar-expand-md navbar-light bg-primary">
	
	<a class="navbar-brand">Adminer Theme Selector</a>
	<div class="collapse navbar-collapse"></div>

	<ul class="navbar-nav my-2 my-lg-0 mr-5">
		<li class="nav-item">
			<a class="nav-link text-light" href="./adminer.php">Adminer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link text-light" href="/phpmyadmin">PHP MyAdmin</a>
		</li>
 		<li class="nav-item">
			<a class="nav-link text-light" href="/dashboard/phpinfo.php">PHP Info</a>
		</li>
	</ul>
</nav>

<div class="container bg-light p-5">
    <section>
        <div class="row">
			
            <div class="col-md-3">
                <div class="lead">Available themes</div>
                <hr>
                
                <ul class="list-group">
                    <?php
                    	foreach($themeList as $name => $path) {
					?>
							<li class="list-group-item <?php echo ($name === $selected) ? 'active' : '' ?>">
								<?php echo $name ?>
							</li>
					<?php
						}
                    ?>
                </ul>
            </div>
			
			<div class="col-md-9">
				<div class="lead">Select Theme</div>
				<hr>
				
				<form action="">
					<div class="input-group mb-3">
						<select class="custom-select" name="theme">
							<option selected>Choose...</option>
							<?php
							foreach($themeList as $name => $path) {
							?>
								<option value="<?php echo $name ?>"><?php echo $name ?></option>
							<?php
							}
							?>
							
						</select>
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary" type="button">Select</button>
						</div>
					</div>
				</form>
			</div>
			
        </div>
    </section>
</div>

<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
