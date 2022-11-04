<?php 
    
    include "./includes/connect.php"; 
    include "./includes/header.php";
    
?>

<?php 

// user login
if (isset($_POST['login'])){
  $user = $pwd = '';

  $user = $_POST['username'];
  $pwd = md5($_POST['password']);

  $query = "SELECT * FROM users WHERE usrEmail='$user' AND usrPwd='$pwd'";
  $response = mysqli_query($connection,$query);

  if(mysqli_num_rows($response) > 0){
    $row = mysqli_fetch_assoc($response);
    session_start();
    $_SESSION['user'] = $row["usrEmail"];
    $id = $row["usrID"];
    if($id=='admin@src'){
      $_SESSION['type'] = "admin";
      header("Location: admin.php");
    }
    else{
      header("Location: profile.php");
    }
  }
  else{
    echo "<div class='alert alert-danger' role='alert'>User not existed or Incorrect details!</div>";
  }
  
}

?>

<div class="container">
    <center><h4>Enter the details</h4><br></center>
    <form action="#" method="post">
        <input type="text" name="username" class="form-control" placeholder="Email" required>
        <br>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <br>
        <button class="btn btn-info" type="submit" name="login">Login</button>
    </form>
    <br>
    <a href="register.php">Don't have an account?</a>
</div>

<?php 

include "./includes/footer.php";

?>