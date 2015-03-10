<html>
  <head>
    <meta charset="utf-8">
    <title>Your Winery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
    rel="stylesheet">
    <link href="css/style.css"rel="stylesheet">
    <link href="css/base_subpanels.css" rel="stylesheet">
  </head>
  <body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
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
                $stmt = $db->stmt_init();
                if($stmt->prepare("SELECT winery_name FROM Manages order by winery_name asc")) {
                    $stmt->execute();
                    $stmt->bind_result($winery_name);

                    while($stmt->fetch()){
                        echo "<li class='active'><a href='wineryadmin.php?winery_name=" . $winery_name . "'>Manage " . $winery_name . "</a></li>";
                    }
                }
                $db->close();
            ?>
            <li><a href="account.html">Account</a></li>
            <li><a href="login.html">Log In</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
  </nav>
  

  <script type="text/javascript" src="js/winery.js"></script>
    <div class="container main-container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php
                        include("php/config.php");
                        echo $_GET["winery_name"]
                        //$db->close();
                    ?>
                </h3>
            </div>

            <div class="panel-body panel-default">
                <div>
                    <ul class="nav nav-pills nav-stacked pull-left" id="myTabList"role="tablist">
                        <li id="wine-tab-li" class="active">
                            <a href="#wineTab" id="wine-tab" role="tab" data-toggle="pill">Wines</a>
                        </li>
                        <li id="event-tab-li">
                            <a href="#eventTab" id="event-tab" role="tab" data-toggle="pill">Events</a>
                        </li>
                        <li id="review-tab-li">
                            <a href="#reviewTab" id="review-tab" role="tab" data-toggle="pill">Reviews</a>
                        </li>
                        <li id="information-tab-li">
                            <a href="#informationTab" id="information-tab" role="tab" data-toggle="pill">Information</a>
                        </li>
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane active" id="wineTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a id="add_wine_review" class="btn pull-right btn-primary">Add Wine Review</a>
                                        <h3 class="panel-title">Wines</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            include("php/config.php");
                                            
                                            $winery_name = $_GET["winery_name"];
                                            echo "<input type=hidden id='winery_name' value='" . $winery_name . "'>";
                                            $sql = "SELECT * FROM `Wine` NATURAL JOIN `Produces` LEFT JOIN `Rate` ON Rate.wine_id=Wine.wine_id WHERE winery_name=\"$winery_name\"";
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo $row["wine_name"] . " (" . $row["year"] . ") " . $row["classification"] . "<br>";
                                                    
                                                    if ($row["email"]) {
                                                        echo $row["email"] . " says: (" . $row["stars"] . ") " . $row["comment"] . "<br>";
                                                    }
                                                    echo "<br>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            
                                            $db->close();

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
              
                        <div class="tab-pane" id="eventTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a id="add_event" class="btn pull-right btn-primary">Add Event</a>
                                        <h3 class="panel-title">Events</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            include("php/config.php");
                                            $winery_name = $_GET["winery_name"];
                                            $sql = "SELECT * FROM Event NATURAL JOIN Hosts WHERE winery_name=\"$winery_name\"";
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo $row["event_name"] . " (" . $row["date"] . "): " . $row["description"] . "<br>";
                                                    echo "(" . $row["start"] . " - " . $row[end] . ")" . "<br><br>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            
                                            $db->close();

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
              
                        <div class="tab-pane" id="reviewTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <a id="add_winery_review" class="btn pull-right btn-primary">Add Winery Review</a>
                                        <h3 class="panel-title">Reviews</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            include("php/config.php");
                                            $winery_name = $_GET["winery_name"];
                                            $sql = "SELECT * FROM Reviews WHERE winery_name=\"$winery_name\" ORDER BY timestamp DESC";
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo $row["email"] . " says: (" . $row["rating"] . ") " . $row["description"] . "<br><br>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            
                                            $db->close();

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="informationTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Information</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            include("php/config.php");
                                            $winery_name = $_GET["winery_name"];
                                            $sql = "SELECT * FROM Winery NATURAL JOIN Winery_Hours WHERE winery_name=\"$winery_name\"";
                                            $result = $db->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                $count = -1;
                                                while($row = $result->fetch_assoc()) {
                                                    if ($count < 0) {
                                                        echo "Website: " . $row["website"] . "<br>";
                                                        echo "Owner: " . $row["owner"] . "<br>";
                                                        echo "Address: " . $row["street"] . ", " . $row["city"] . ", " . $row["state"] . "  " . $row["zipcode"] . "<br><br>";
                                                        echo "<form action='php/update_winery_hours.php' method='post'>";
                                                        echo "<input type='hidden' name='winery' value='$winery_name'>";
                                                        echo "<input type='hidden' name='day' value='" . $row["day_of_week"] . "'>";
                                                        echo $row["day_of_week"] . ": " . "<input type='time' name='open' value='" . $row["open"] . "'> to <input type='time' name='close' value='" . $row["close"] . "'>";
                                                        echo " <button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
                                                        echo " <button type='submit' class='btn btn-default btn-sm' formaction='php/delete_winery_hours.php'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                                                        echo "</form>";
                                                        echo "<br>";
                                                        $count = 1;
                                                    } else {
                                                        echo "<form action='php/update_winery_hours.php' method='post'>";
                                                        echo "<input type='hidden' name='winery' value='$winery_name'>";
                                                        echo "<input type='hidden' name='day' value='" . $row["day_of_week"] . "'>";
                                                        echo $row["day_of_week"] . ": " . "<input type='time' name='open' value='" . $row["open"] . "'> to <input type='time' name='close' value='" . $row["close"] . "'>";
                                                        echo " <button type='submit' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
                                                        echo " <button type='submit' class='btn btn-default btn-sm' formaction='php/delete_winery_hours.php'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                                                        echo "</form>";
                                                        echo "<br>";
                                                    }
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            $db->close();
                                        ?>
                                        <label>Add Hours</label>
                                        <form class='form-inline' action='php/add_winery_hours.php' method='post'>
                                            <input type='hidden' name='winery' value='<?php
                                                //include("php/config.php");
                                                echo $_GET["winery_name"];
                                            ?>'>
                                            <div class='form-group'>
                                                Day: 
                                                <select required class='form-control' name='day'>
                                                    <option value='Sunday'>Sunday</option>
                                                    <option value='Monday'>Monday</option>
                                                    <option value='Tuesday'>Tuesday</option>
                                                    <option value='Wednesday'>Wednesday</option>
                                                    <option value='Thursday'>Thursday</option>
                                                    <option value='Friday'>Friday</option>
                                                    <option value='Saturday'>Saturday</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

  </body>
</html>