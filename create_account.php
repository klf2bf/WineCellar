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
            header("Location: index.html");
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
    <title>Create Account</title>
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
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="account.html">Account</a></li>
        <li><a href="login.php">Log In</a></li>
    </ul>
</div><!--/.nav-collapse -->
</div>
</nav>

<div class="container main-container">
    <form action="" method="POST">
        Email:<input type="text" name="email"><br/>
        Password:<input type="password" name="password"><br/>
        Confirm Password:<input type="password" name="confirm_password"><br/>
        First Name:<input type="text" name="first_name"><br/>
        Last Name:<input type="text" name="last_name"><br/>
        Date of Birth:<input type="date" name="dob"><br/>
        <input type="Submit" value="Create Account"><br/>
    </form>
    <?php echo $account_error ?>
</div>
</body>
</html>


