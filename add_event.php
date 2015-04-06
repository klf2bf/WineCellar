<html>
<head>
    <meta charset="utf-8">
    <title>Wine Cellar</title>
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
                        $stmt = $db->stmt_init();
                        if($stmt->prepare("SELECT winery_name FROM Manages order by winery_name asc")) {
                            $stmt->execute();
                            $stmt->bind_result($winery_name);

                            while($stmt->fetch()){
                                echo "<li><a href='wineryadmin.php?winery_name=" . $winery_name . "'>Manage " . $winery_name . "</a></li>";
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
    <div class="container main-container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add Event</h3>
            </div>
            <div class="panel-body">
                <form action='php/add_event.php' method='post'>
                    <input type='hidden' name='winery' value='<?php
                                                echo $_GET["winery_name"];
                                            ?>'>
                    <div class='form-group'>
                        <label for='event_name'>Event Name:</label>
                        <input type='text' class='form-control' name='event_name'>
                    </div>
                    <div class='form-group'>
                        <label for='date'>Date:</label>
                        <input type="date" class='form-control' name="date">
                    </div>
                    <div class='form-group'>
                        <label for='start'>Start Time:</label>
                        <input type='time' class='form-control' name='start'>
                    </div>
                    <div class='form-group'>
                        <label for='end'>End Time:</label>
                        <input type='time' class='form-control' name='end'>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="public">Is the event Public?</label>
                    </div>
                    <div class='form-group'>
                        <label for='type'>Event Type:</label>
                        <input type='text' class='form-control' name='type'>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <input type='submit' class='btn btn-primary pull-right'>
                </form>
            </div>
        </div>
    </div>
</body>
</html>