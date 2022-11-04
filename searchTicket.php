<?php 

include "./includes/header.php";
include "./includes/connect.php";
include "./includes/adminGetBack.php";


?>

<?php 

if(isset($_POST['update'])){
    $id = $_POST['ticketID'];
    $query = "UPDATE movieBookings SET isEntered = 1 WHERE movieBookings.ticketID = '$id'";
    mysqli_query($connection,$query);
    echo "Updated successfully";
}


?>

<div class='container'>

<?php 

if(isset($_POST['search'])){
    $id = $_POST['ticketID'];
    if($id!=''){
        $query = "SELECT * FROM movieBookings WHERE ticketID='$id'";
        $response = mysqli_query($connection,$query);
        $movie = mysqli_fetch_assoc($response);
        if($movie){
            $movieParticulars = explode('_',$movie['movieParticulars']);
            $ticketID = $movie['ticketID'];
            $seats = $movie['seatPattern'];
            $movieName = $movie['movieName'];
            $movieDate = $movieParticulars[0];
            $movieSlot = $movieParticulars[1];
            $nOfSeats = count(explode(", ",$movie['seatPattern']));
            $status = $movie['isEntered'];
            $user = $movie['userName'];

            echo "<form action='#' method='post'>";

            if($status==0){
                echo "<input type='text' class='form-control' value='$ticketID' name='ticketID' readonly>";
            }

            echo "<div class='ticket'>";

            echo "<h1 class='movie_name'>$ticketID</h1>
                <div class='content'>
                    <h5>$movieName</h5>
                    <p>$movieDate | $movieSlot</p>
                    <p>Seats: $seats</p>
                    <p>User: $user</p>
                    <br>
                    <p>Status : "?> 
                    
                <?php 

                    if($status==0){
                        echo "Not entered";
                        echo "<br>";
                    }
                    else{
                        echo "Entered";
                    }
                
                    echo "</p>
                </div>";

            echo "</div><br>";

            if($status==0){
                echo "<label for='reg'>Update entry status: </label>
                    <br>
                            <input type='radio' value='0' name='reg' checked class='form-check-input'>
                            <button type='submit' name='update' class='btn btn-info btn-sm'>Update</button><br><br>";
            }

            echo "</form>";
        }
        else{
            echo "No Ticket found";
        }
    }
    else{
        echo "Do not enter blank ticket";
    }
}

?>

<form action="#" method='post'>
    <input type="text" placeholder='Enter ticket ID' name='ticketID' class='form-control'>
    <br>
    <button type='submit' name='search' class='btn btn-warning'>Search</button>
</form>

</div>



<?php 

include "./includes/footer.php";

?>