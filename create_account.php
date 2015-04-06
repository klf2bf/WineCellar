<?php
include("php/config.php");


$account_error = "";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['dob'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password == $confirm_password) {
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];

        $password_hash = hash('sha256',$password);
        $query = "INSERT INTO User (email,first_name,last_name,password,dob) Values('$email','$first_name','$last_name','$password_hash','$dob')";

        if ($db->query($query) === TRUE) {
            $_SESSION['current_user'] = $email;
            header("Location: wineries.php");
        } else {
            $account_error = $db->error;
        }
    }
    else {
        $account_error = "Passwords must match";
    }

}
else
{
    $account_error = "";
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Wine Cellar | Create Account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"
        rel="stylesheet">
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
                        <li class="active"><a href="create_account.php">Create Account</a></li>
                        <li><a href="login.php">Log In</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container main-container">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create Account</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="POST">
                        <div class='form-group'>
                            <label for='email'>Email</label>
                            <input type='email' class='form-control' name='email'>
                        </div>
                        <div class='form-group'>
                            <label for='password'>Password</label>
                            <input type='password' class='form-control' name='password'>
                        </div>
                        <div class='form-group'>
                            <label for='confirm_password'>Confirm Password</label>
                            <input type='password' class='form-control' name='confirm_password'>
                        </div>
                        <div class='form-group'>
                            <label for='first_name'>First Name</label>
                            <input type='text' class='form-control' name='first_name'>
                        </div>
                        <div class='form-group'>
                            <label for='last_name'>Last Name</label>
                            <input type='text' class='form-control' name='last_name'>
                        </div>
                        <div class='form-group'>
                            <label for='dob'>Date of Birth</label>
                            <input type='date' class='form-control' name='dob'>
                        </div>
                        <input class='btn btn-primary' type="Submit" value="Create Account"><br/>
                    </form>
                    <?php echo $account_error ?>
                </div>
            </div>
        </div>
    </body>
</html>


