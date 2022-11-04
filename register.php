\ <?php 
    
    include "./includes/connect.php"; 
    include "./includes/header.php";
    
?>

<?php 

if (isset($_POST['register'])){
  $user = $_POST['useremail'];
  $idno = $_POST['idno'];
  $contact = $_POST['contact'];
  $pwd = md5($_POST['password']);

  $query = "SELECT * FROM users WHERE usrEmail='$user'";
  $response = mysqli_query($connection,$query);

  if(mysqli_num_rows($response) > 0){
    echo "<div class='alert alert-danger' role='alert'>User already existed!</div>";
  }
  else{
    $query = "INSERT INTO users(usrEmail,usrID,usrContact,usrPwd) VALUES('$user','$idno','$contact','$pwd')";
    $response = mysqli_query($connection,$query);
    echo "<div class='alert alert-success' role='success'>User created successfully. Please login!</div>";
    header("refresh: 2; url = login.php");    
}

}

?>
 
 <div class="container">
  <center><h4>Enter the details</h4><br></center>
      <form method="post" action="#">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Enter valid email" name="useremail" required/>
        </div>
        <br />
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter RGUKT ID" name="idno" required/>
        </div>
        <br />
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter contact no" name="contact" required/>
        </div>
        <br />
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Create password" name="password" required/>
        </div>
        <br />
        <button type="submit" name="register" class="btn btn-info">Register</button>
      </form>
      <br>
      <a href="login.php">Already have an account?</a>
      <br>
    </div>

<?php 

include "./includes/footer.php";

?>