<?php 
    include("php/config.php");
    if (mysqli_connect_errno()) {
        printf("Failed to connect to MySQL: " . mysqli_connect_error()) ;
    }
    if($_SESSION['is_superuser']!=true){
        header("Location: /403-error.php");
        die();
    }

?>
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
                $email = $_SESSION['email'];
                if($_SESSION['loggedin']){
                    $stmt = $db->stmt_init();
                    if($stmt->prepare("SELECT winery_name FROM Winery WHERE owner_email='$email'")) {
                        $stmt->execute();
                        $stmt->bind_result($winery_name);

                        while($stmt->fetch()){
                            echo "<li class='active'><a href='wineryadmin.php'>Manage " . $winery_name . "</a></li>";
                        }
                    }
                    $db->close();
                    echo "<li><a href='account.php'>" . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . "'s Account</a></li>";
                    echo "<li><a href='php/logout.php'>Log Out</a></li>";
                }
                else {
                    echo "<li><a href='login.php'>Log In</a></li>";
                }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
  </nav>
  

    <script type="text/javascript" src="js/winery.js"></script>
    <script>
        filterWines("All");
    </script>
    <div class="container main-container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php
                        include("php/config.php");
                        echo $winery_name;
                        //echo $_GET["winery_name"]
                        //$db->close();
                    ?> Admin
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
                                        <?php
                                            echo "<a href='add_wine.php?winery_name=$winery_name' class='btn pull-right btn-primary'>Add Wine</a>";
                                            $_SESSION['winery_name'] = $winery_name;

                                            echo "<input type=hidden id='winery_name' value='" . $winery_name . "'>";
                                        ?>
                                        <h3 class="panel-title">Wines</h3>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button style="width: 99.9%;" class="btn btn-default dropdown-toggle" type="button" id="classification" data-toggle="dropdown" aria-expanded="true">
                                            Type of Wine
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" style="width: 99.8%;" role="menu" aria-labelledby="classification">
                                                <?php
                                                    include("php/config.php");
                                                    $winery_name = $winery_name;
                                                    $_SESSION['winery_name'] = $winery_name;
                                                    $stmt = $db->stmt_init();
                                                    $sql = "SELECT classification FROM Wine WHERE winery_name='$winery_name' GROUP BY classification";
                                                    if ($stmt->prepare($sql)) {
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($classification);

                                                        while ($stmt->fetch()) {
                                                            echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='#'>" . $classification . "</a></li>";
                                                        }
                                                    }
                                                ?>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">All</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel list-group" id="wine-data">

                                    </div>
                                </div>
                            </div>
                        </div>
              
                        <div class="tab-pane" id="eventTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php
                                            echo "<a href='add_event.php?winery_name=$winery_name' class='btn pull-right btn-primary'>Add Event</a>"
                                        ?>
                                        <h3 class="panel-title">Events</h3>
                                    </div>
                                    <div>
                                    </div>
                                    <div class="panel list-group">
                                        <?php
                                        include("php/config.php");
                                        $sql = "SELECT * FROM Event WHERE winery_name=\"$winery_name\" ORDER BY date DESC";
                                        $result = $db->query($sql);
                                        
                                        if ($result->num_rows > 0) {
                                            $count = 0;
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo "<a  class='list-group-item' data-toggle='collapse' data-target='#event_" . $count . "'>" . $row["event_name"] . " - " .  $row["date"] . "</a>";
                                                echo "<div id='event_" . $count . "' class='sublinks collapse'>
                                                    <a class='list-group-item small tab'>" . date('h:i a', strtotime($row['start'])) . " - " . date('h:i a', strtotime($row['end'])) . "</br>
                                                    " . $row['description'] . "</a></div>";
                                                $count++;
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
                                        <a href="php/export_reviews.php" id='export_reviews' style="margin-right: 3px;" class="btn pull-right btn-primary">Export Reviews</a>
                                        <h3 class="panel-title">Reviews</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        include("php/config.php");
                                        $stmt_2 = $db->stmt_init();
                                        $sql_2 = "SELECT first_name, stars, description, timestamp FROM Reviews NATURAL JOIN User WHERE winery_name='$winery_name'";
                                        if($stmt_2->prepare($sql_2)) {
                                            $stmt_2->execute();
                                            $stmt_2->store_result();
                                            $stmt_2->bind_result($commenter_name, $stars, $description, $timestamp);
                                            $num = $stmt_2->num_rows();

                                            $timeStamp = strtotime($timestamp);
                                            $date = date('d-m-Y', $timeStamp);

                                            if($num == 0){
                                                echo "&nbsp;&nbsp;No reviews";
                                            }
                                            while($stmt_2->fetch()){
                                                echo "<div>";
                                                for ($x = 0; $x < $stars; $x++)
                                                {
                                                    echo "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
                                                }
                                                for ($x = $stars; $x < 5; $x++)
                                                {
                                                    echo "<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";
                                                }
                                                echo " by " . $commenter_name . " on " . $date;
                                                echo "</br><p>" . $description . "</p></br></div>";
                                            }  


                                        } else {
                                            echo("error: " . htmlspecialchars($stmt_2->error));
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
                                                        echo "<form action='php/update_winery_hours.php' class='form-inline' method='post'>";
                                                        echo "<input type='hidden' name='winery' value='$winery_name'>";
                                                        echo "<input type='hidden' name='day' value='" . $row["day_of_week"] . "'>";
                                                        echo $row["day_of_week"] . ": " . "<input type='time' class='form-control' name='open' value='" . $row["open"] . "'> to <input type='time' class='form-control' name='close' value='" . $row["close"] . "'>";
                                                        echo " <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
                                                        echo " <button type='submit' class='btn btn-default' formaction='php/delete_winery_hours.php'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                                                        echo "</form>";
                                                        $count = 1;
                                                    } else {
                                                        echo "<form action='php/update_winery_hours.php' class='form-inline' method='post'>";
                                                        echo "<input type='hidden' name='winery' value='$winery_name'>";
                                                        echo "<input type='hidden' name='day' value='" . $row["day_of_week"] . "'>";
                                                        echo $row["day_of_week"] . ": " . "<input type='time' class='form-control' name='open' value='" . $row["open"] . "'> to <input type='time' class='form-control' name='close' value='" . $row["close"] . "'>";
                                                        echo " <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>";
                                                        echo " <button type='submit' class='btn btn-default' formaction='php/delete_winery_hours.php'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
                                                        echo "</form>";
                                                    }
                                                }
                                                echo "<br>";
                                            } else {
                                                echo "0 results";
                                            }
                                            $db->close();
                                        ?>
                                        <label>Add Hours:</label>
                                        <form class='form-inline' action='php/add_winery_hours.php' method='post'>
                                            <input type='hidden' name='winery' value='<?php
                                                //include("php/config.php");
                                                echo $winery_name;
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
                                            <div class='form-group'>
                                                Open:
                                                <input class='form-control' required type='time' name='open'>
                                            </div>
                                            <div class='form-group'>
                                                Close:
                                                <input class='form-control' required type='time' name='close'>
                                            </div>
                                            <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>
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