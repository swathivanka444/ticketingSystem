<?php 

include "./includes/header.php";
include "./includes/connect.php";
include "./includes/adminGetBack.php";

?>

<?php 

if(isset($_POST['regChange'])){
    $moviename =  $_POST['moviename'];
    $date = $_POST['date'];
    $regStatus = $_POST['reg'];

    $query = "UPDATE movieSeatPattern SET isRegistrationsOpened = '$regStatus' WHERE movieSeatPattern.movieDate = '$date' AND movieSeatPattern.movieName = '$moviename'";
    mysqli_query($connection,$query);
}


?>

<div class='container'>

    <a href="createMovie.php" class='btn btn-success'>Add a movie</a>

    <a href="searchTicket.php" class='btn btn-warning'>Search a ticket</a>

    <br><br><br>

    <h3>Added movies</h3>
    <br>

    <?php 

    echo "<form action='#' method='post'>";
        $query = "SELECT * FROM movieSeatPattern ORDER BY sno DESC";
        $response = mysqli_query($connection,$query);

        if(mysqli_num_rows($response) > 0){
                while($movie = mysqli_fetch_assoc($response)){
                $movieName = $movie['movieName'];
                $movieDate = $movie['movieDate'];
                $reg = $movie['isRegistrationsOpened'];
                ?>
                <form action='#' method='post'>
                    <?php 
                        echo "<input type='text' class='form-control' readonly value='$movieName' name='moviename'> <br> <input type='text' class='form-control' readonly value='$movieDate' name='date'>";
                    ?>
                    <br>
                    Open
                    <input type='radio' name='reg' class='form-check-input' value='1' <?php if($reg==1){echo 'checked';}?>>
                    Close
                    <input type='radio' name='reg' class='form-check-input' value='0' <?php if($reg==0){echo 'checked';}?>> 
                    <br><br>
                    <button name='regChange' class='btn btn-info' type='submit'>Update</button>
                </form>
                <br>
                <br>
                <?php
            }
        }
        else{
            echo "Add a movie....";
        }
    ?>

</div>


<?php 

include "./includes/footer.php";

?>