<html>
<head>
    <meta charset="utf-8">
    <title>Winery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"
    rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
    rel="stylesheet">
    <link href="css/style.css"rel="stylesheet">
    <link href="css/base_subpanels.css" rel="stylesheet">

    <script type="text/javascript">
        function deleteFavorite(wine_id) {
            $.post("php/delete_favorite.php", { "wine_id" : wine_id}, function() { location.reload();});
        }
        function deleteReview(email,time_stamp) {
            $.post("php/delete_review.php", {"email" : email, "time_stamp" : time_stamp}, function() { location.reload();});
        }
    </script>

</head>
<body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-rating-input.min.js" type="text/javascript"></script>
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
                    $_SESSION['admin'] = FALSE;

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
                                echo "<li><a href='wineryadmin.php'>Manage " . $winery_name . "</a></li>";
                                $_SESSION['admin'] = TRUE;
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
                <h3 class="panel-title">
                    <?php echo $_SESSION["first_name"]. " " . $_SESSION["last_name"] . "'s Account";?>
                </h3>
            </div>

            <div class="panel-body panel-default">
                <div>
                    <ul class="nav nav-pills nav-stacked pull-left" id="myTabList"role="tablist">
                        <li id="account-tab-li" class="active">
                            <a href="#accountTab" id="wine-tab" role="tab" data-toggle="pill">Information</a>
                        </li>
                        <li id="wines-tab-li">
                            <a href="#favoritesTab" id="event-tab" role="tab" data-toggle="pill">Favorites</a>
                        </li>
                        <li id="wineries-tab-li">
                            <a href="#reviewsTab" id="review-tab" role="tab" data-toggle="pill">Reviews</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="accountTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Account Info</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        include("php/config.php");
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT * FROM User WHERE email='$email'";
                                        $result = $db->query($sql);
                                        while($row = $result->fetch_assoc()) {

                                            echo "First Name: " . $row['first_name'] . "<br>";
                                            echo "Last Name: " . $row['last_name'] . "<br>";
                                            echo "Date of Birth: " . $row['dob'] . "<br>";
                                            echo "<br>";
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="favoritesTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Favorites</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT * FROM Favorites NATURAL JOIN Wine WHERE email='$email'";
                                        $result = $db->query($sql);

                                        while($row = $result->fetch_assoc()) {
                                            echo "<b>" . $row['wine_name'] . "</b>";
                                            echo "<span style='display:inline-block; width: 5px;'></span>";
                                            echo "<button onclick='deleteFavorite(" . $row['wine_id'] . ")' class='btn btn-danger btn-xs' > <span class='glyphicon glyphicon-trash'></span></button><br>";

                                            echo "Price: " . $row['price'] . "<br>";
                                            echo "Description: " . $row['description'] . "<br>";
                                            echo "<br>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="reviewsTab">
                            <div class="main-panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Winery Reviews</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT * FROM Reviews WHERE email='$email'";
                                        $result = $db->query($sql);
                                        
                                        while($row = $result->fetch_assoc()) {
                                            $timeStamp = strtotime($row['timestamp']);
                                            echo "<b>" . $row['winery_name'] . "</b>";
                                            echo "<span style='display:inline-block; width: 5px;'></span>";
                                            echo "<button onclick='deleteReview(\"" . $row['email'] . "\",\"" . $row['timestamp'] . "\")' class='btn btn-danger btn-xs' > <span class='glyphicon glyphicon-trash'></span></button><br>";
                                            echo "Date Visited: " . date('d-m-Y h:i a', $timeStamp) . "<br>";
                                            echo "Review: " . $row['description'] . "<br>";
                                            echo "<br>";
                                        }
                                        ?>

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

