<html>
  <head>
  	<meta charset="utf-8">
  	<title>Winery Review</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
    rel="stylesheet">
    <link href="css/style.css"rel="stylesheet">
  </head>
  <body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="js/winery.js"></script>
  
  <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="wineries.php">Wine Cellar</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                    include("php/config.php");

                    if (mysqli_connect_errno()) {
                        printf("Failed to connect to MySQL: " . mysqli_connect_error()) ;
                    }
                    $email = $_SESSION['email'];
                    if($_SESSION['loggedin']){
                        $stmt = $db->stmt_init();
                        if($stmt->prepare("SELECT winery_name FROM Winery WHERE owner_email='$email'")) {
                            $stmt->execute();
                            $stmt->bind_result($winery_name);

                            while($stmt->fetch()){
                                echo "<li><a href='wineryadmin.php?winery_name=" . $winery_name . "'>Manage " . $winery_name . "</a></li>";
                            }
                        }
                        $db->close();
                        echo "<li><a href='account.php'>" . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "'s Account</a></li>";
                        echo "<li><a href='php/logout.php'>Log Out</a></li>";
                    }
                    else {
                        echo "<li><a href='create_account.php'>Create Account</a></li>";
                        echo "<li><a href='login.php'>Log In</a></li>";
                    }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container main-container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title" id="review_title">
                    
                </h3>
            </div>

            <div class="panel-body panel-default">
            	<form action="submit_winery_review.php" method="post" id="new_winery_review">
                <div class='form-group'>
                  <label for='description'>Description</label>
                  <input class='form-control' type="text" cols="40" rows="5" style="width: 100%; height:100px;" id="description" name="description" required maxlength="350" placeholder="">
                </div>
                <div class='form-group'>
                  <label for='rating'>Stars</label>
                  <input class='form-control' type="number" name="rating" id="rating" min="1" max="5" required>
                </div>
                <?php
                  $winery_name = $_GET["winery_name"];
                  $email = $_SESSION['email'];
                  echo "<input type='hidden' id='winery_name' name='winery_name' value='" . $winery_name . "'>";
                  echo "<input type='hidden' id='email' name='email' value='" . $email . "'>";
                ?>

            		<a type="submit" id="submit" class="btn pull-left btn-primary">Submit</a>
                <a type="cancel" id="cancel" class="btn pull-left btn-default">Cancel</a>

            	</form>
              <div id="message"> </div>
            </div>
        </div>
    </div>
  </body>
</html>