<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta data -->
  <meta charset="utf-8">
  <meta name="viewport" content = "width=device-width, initial-scale=1.0">
  <meta name="description" content = "Easy Mileage Plus">
  
  <!-- Bootstrap CSS File -->
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" /> 
  <link href="style.css" rel="stylesheet" />
  <!-- Google font files -->
  <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
  
  <!-- Title -->
  <title><?php echo $title; ?></title>
</head>

<body>
  <!-- JQuery and Bootstrap Script files -->
  <script src="jquery-3.1.1.js"></script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
   
   <!-- Nav bar and header-->
    <header class="navbar navbar-inverse fixed-top bs-docs-nav" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a href="index.php" class="navbar-brand">Easy Mileage Plus</a>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			  <form class="navbar-form navbar-right" role="search">
				<a href="./login.php" class="button-link-menu">Log in</a>
			  </form>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="./index.php">Home</a></li>
                  <li><a href="./about.php">About</a></li>
                  <li><a href="./contact.php">Contact</a></li>
              </ul>
            </nav>
        </div>
	</header>