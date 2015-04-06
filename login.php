<?php 
include("php/config.php");
session_start();
$login_error = "";
if (isset($_POST['email']) && isset($_POST['password']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];

  $hash = hash('sha256',$password);

  $query = "SELECT password FROM User WHERE email = '$email'";
  $result = $db->query($query);
  $num_rows = $result->num_rows;
  $row = $result->fetch_array();
  $_SESSION['email'] = $email;
  if ($hash == $row['password']) {
    $login_error = "";
    
    #Get user information
    $stmt = $db->stmt_init();
    if($stmt->prepare("SELECT first_name, last_name, is_superuser FROM User WHERE email = '$email'")) {
      $stmt->execute();
      $stmt->bind_result($first_name, $last_name, $is_superuser);
      $row = $stmt->fetch();
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      $_SESSION['is_superuser'] = $is_superuser;
    }
    $_SESSION['loggedin'] = true;
    header("Location: wineries.php");
  }
  else
  {
    $login_error = "Invalid email or password.";
    $_SESSION['loggedin'] = false;
  }
}
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>

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
          <a class="navbar-brand" href="wineries.html">Wine Cellar</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="create_account.php">Create Account</a></li>
            <li class="active"><a href="login.php">Log In</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  <div class="container main-container">
<form action="" method="POST">
  <div class='form-group'>
    <label for='email'>Email</label>
    <input type='email' class='form-control' name='email'>
  </div>
  <div class='form-group'>
    <label for='email'>Password</label>
    <input type='password' class='form-control' name='password'>
  </div>
  <input class='btn btn-default' type="Submit" value="Login"> 
</form>
<?php echo "<br/>"; echo $login_error; ?>
</form>
</div>
  </body>
</html>
