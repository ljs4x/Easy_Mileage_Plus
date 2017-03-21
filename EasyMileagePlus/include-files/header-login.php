<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content = "width=device-width, initial-scale=1.0">
  <meta name="description" content = "Easy Mileage Plus">
  <meta name="author" content ="Me">
  
  <title><?php echo $title; ?></title>
  <!-- Bootstrap CSS File -->
  <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet" /> 
  <link href="style.css" rel="stylesheet" />
  
<!-- JQueryUi 1.12.1 datepicker CSS -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

<!-- Google font links -->
<link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
   
</head>

<body>
  <!-- JQuery and Bootstrap Script files -->
  <script src="jquery-3.1.1.js"></script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
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
			   <!--added href to guide user to logout page -Khang-->
				<a href="./logout.php" class="button-link-menu">Log Out</a>
			  </form>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="./addmiles.php">Add Mileage</a></li>
                  <li><a href="./mileagesummary.php">Mileage Summary</a></li>
                  <li><a href="./account.php">Account</a> </li>
              </ul>
            </nav>
        </div>
	</header>