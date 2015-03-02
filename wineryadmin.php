<html>
<head>
    <meta charset="utf-8">
    <title>Fixed Top Navbar Example for Bootstrap</title>
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
                    <li><a href="account.html">Account</a></li>
                    <li><a href="login.html">Log In</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container main-container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Winery Information</h3>
            </div>
            <div class="panel-body">
                <?php 
                    include("php/config.php");
                    if (mysqli_connect_errno()) {
                        printf("Failed to connect to MySQL: " . mysqli_connect_error()) ;
                    }
                    $stmt = $db->stmt_init();
                    if($stmt->prepare("SELECT event_name, date, description, type, public, start, end,  FROM Hosts NATURAL JOIN Event WHERE winery_name='Trump Winery'")) {
                        $stmt->execute();
                        $stmt->bind_result($winery_name);

                        while($stmt->fetch()){
                            echo "<a href='winery.php?winery_name=" . $winery_name . "'>" .$winery_name . "</a>";
                        }
                    }
                    $db->close();
                ?>

            </div>
        </div>
    </div>
</body>
</html>