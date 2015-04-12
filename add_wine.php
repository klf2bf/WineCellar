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
    <script>
        var grape_type_count = 1;
        function addGrapeType(){
            var div = document.createElement('div');

            div.className = 'row bottom-margin';

            div.innerHTML = "<div class='col-md-1'><div class='pull-right'>Name:</div></div>\
                <div class='col-md-11'>\
                <input type='text' class='form-control' name='grapes[" + grape_type_count + "]'>\
                </div>";
            document.getElementById('grape_types_div').appendChild(div);
            grape_type_count++;
            document.getElementById('grape_type_count').value = grape_type_count;
        }
    </script>

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
                                echo "<li><a href='wineryadmin.php'>Manage " . $winery_name . "</a></li>";
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
                <h3 class="panel-title">Add Wine</h3>
            </div>
            <div class="panel-body">
                <form action='php/add_wine.php' method='post'>
                    <input type='hidden' name='winery' value='<?php
                                                echo $_GET["winery_name"];
                                            ?>'>
                    <div class='form-group'>
                        <label for='wine_name'>Wine Name:</label>
                        <input type='text' class='form-control' name='wine_name'>
                    </div>
                    <div class='form-group'>
                        <label for='year'>Year:</label>
                        <input type="number" class='form-control' name="year" step="1" min="1800" max="3000">
                    </div>
                    <div class='form-group'>
                        <label for='classification'>Classification:</label>
                        <input type='text' class='form-control' name='classification'>
                    </div>
                    <input type='hidden' id='grape_type_count' class='form-control' name='grape_type_count' value='1'>
                    <div class='form-group' id='grape_types_div'>
                        <label for='type_of_grape'>Grape Types:</label>
                        <div class='row bottom-margin'>
                            <div class='col-md-1'><div class='pull-right'>Name:</div></div>
                            <div class='col-md-11'>
                                <input type='text' class='form-control' name='grapes[0]'>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="addGrapeType()" class='btn btn-default'>Add Another Type</button>
                    <br>
                    <input type='submit' class='btn btn-primary pull-right'>
                </form>
            </div>
        </div>
    </div>
</body>
</html>