<?php 
    
    include "./includes/connect.php"; 
    include "./includes/header.php";
    include "./includes/getBack.php";
    
?>

<center><h2>Profile<h5></center>

<?php 


    echo "<div class='container'>";
    echo "<center><br><p>$user</p><br><a href='logout.php' class='btn btn-info'>Logout</a><br><center><br>";
    echo "<h4 class='heading'>Your bookings</h4>";

    $query = "SELECT * FROM movieBookings WHERE userName='$user' ORDER BY sno DESC";
    $response = mysqli_query($connection,$query);

    echo "<div class='tickets_container'>";
    while($movie = mysqli_fetch_assoc($response)){
        $movieParticulars = explode('_',$movie['movieParticulars']);
        $ticketID = $movie['ticketID'];
        $seats = $movie['seatPattern'];
        $movieName = $movie['movieName'];
        $movieDate = $movieParticulars[0];
        $movieSlot = $movieParticulars[1];
        $nOfSeats = count(explode(", ",$movie['seatPattern']));
        $status = $movie['isEntered'];

        echo "<div class='ticket'>";

        echo "<h1 class='movie_name'>$ticketID</h1>
              <div class='content'>
                <h5>$movieName</h5>
                <p>$movieDate | $movieSlot</p>
                <p>Seats: $seats</p>
                <br>
                <p>Status : "?> 
                
            <?php 

                if($status==0){
                    echo "Not entered";
                }
                else{
                    echo "Entered";
                }
            
                echo "</p>
              </div>";

        echo "</div><br>";
        
    }
    echo "</div></div>"

?>


<?php 

include "./includes/footer.php";

?>