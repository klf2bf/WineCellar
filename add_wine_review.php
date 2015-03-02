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
          <a class="navbar-brand" href="wineries.html">Wine Cellar</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="account.html">Account</a></li>
            <li><a href="login.html">Log In</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container main-container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Wine Review
                </h3>
            </div>
            
            <div class="panel-body panel-default">
            	<form action="submit_wine_review.php" method="post" id="submit_wine_review">
                <?php
                  $winery_name = $_GET["winery_name"];
                  echo "<input type='hidden' id='winery_name' name='winery_name' value='" . $winery_name . "'>";
                ?>
                Wine: <select name="wine_id" id="wine_id">
                <?php

                  include("php/config.php");
                  $winery_name = $_GET["winery_name"];
                  $sql = "SELECT wine_name, wine_id, year, classification FROM Wine NATURAL JOIN Winery WHERE winery_name=\"$winery_name\"";
                  $result = $db->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value=" . $row["wine_id"] . ">" . $row["wine_name"] . " (". $row["year"] . ", " . $row["classification"] . ")" . "</option>";
                    }
                  }
                  else {
                      echo "0 results";
                  }

                  $db->close();
                ?>
                </select>
                <br>
            		Email: <input type="email" name="email" id="email" required placeholder="test@example.com" maxlength="50"><br>
                Stars: <input type="number" name="stars" id="stars" min="1" max="5" required><br>
            		Comment: <input type="text" cols="40" rows="5" style="width:200px; height:50px;" id="comment" name="comment" required maxlength="350" placeholder=""><br>
            		
            		<a type="submit" id="submitWineReview" class="btn pull-right btn-primary">Submit</a>
                <a type="cancel" id="cancel" class="btn pull-right btn-default">Cancel</a>

            	</form>
            </div>
        </div>
    </div>
  </body>
</html>