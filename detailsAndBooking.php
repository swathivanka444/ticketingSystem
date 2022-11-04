<?php 
    
    include "./includes/connect.php"; 
    include "./includes/header.php";
    include "./includes/getBack.php";
    $movieSelected = $_GET['moviename'];
    
?>
    <!-- tickets booking after selection with new pattern generation -->
    <?php 
    
    if(isset($_POST['bookNow'])){
        $selections = $_POST['slot'];

        if($selections==''){
            echo "<div class='alert alert-warning' role='warning'>Please select more than one valid seat...</div>";
        }
        else if(sizeof($selections) > 9){
            echo "<div class='alert alert-warning' role='warning'>You can not reserve more than 5 seats for a movie...</div>";
        }

        else{
            $query = "SELECT * FROM movieBookings WHERE movieBookings.userName = '$user' AND movieBookings.movieName = '$movieSelected'";
            $res = mysqli_query($connection,$query);

            $countOf = 0;

            if(mysqli_num_rows($res) > 0){
                while($booking = mysqli_fetch_assoc($res)){
                    $seats = explode(', ',$booking['seatPattern']);
                    $countOf = $countOf + sizeof($seats);
                }
            }

            if(( $countOf + sizeof($selections) ) > 9 ){
                $variance = 9 - $countOf;
                echo "<div class='alert alert-warning' role='warning'>You already reserved $countOf seats. You can reserve $variance more seat(s).</div>";
            }
            else{

                $date = $_POST['date'];
                $time = $_POST['time'];
                $query = "SELECT * FROM movieSeatPattern WHERE movieSeatPattern.movieDate = '$date' AND movieSeatPattern.movieName = '$movieSelected'";
                $response = mysqli_query($connection,$query);
                $movie = mysqli_fetch_assoc($response);
                $movieSlot1 = explode("#",$movie['slot1']);
                $movieSlot2 = explode("#",$movie['slot2']);
                $movieSlot3 = explode("#",$movie['slot3']);
                $movieSlot4 = explode("#",$movie['slot4']);
                $movieCode = $movie['movieCode'];
                $column = '';
                $oldPattern = '';
                if($movieSlot1[0] == $time){
                    $column = 'slot1';
                    $oldPattern = $movieSlot1[1];
                }
                if($movieSlot2[0] == $time){
                    $column = 'slot2';
                    $oldPattern = $movieSlot2[1];
                }
                if($movieSlot3[0] == $time){
                    $column = 'slot3';
                    $oldPattern = $movieSlot3[1];
                }
                if($movieSlot4[0] == $time){
                    $column = 'slot4';
                    $oldPattern = $movieSlot4[1];
                }

                //generating new pattern

                $newPattern = $time."#";
                $oldPatternSplit = explode('_',$oldPattern);
                $oldPatternArr = '';
                $reserves = '';

                foreach($selections as $mark=>$selection){
                    $match = explode('.',$selection);
                    $rowName = $match[0];
                    $seatNum = $match[1];
                    $rowLetter =  utf8_encode( chr((int)$rowName+65) );
                    $temp = $rowLetter."-".((int)$seatNum+1);
                    if($mark!=count($selections)-1){
                        $reserves = $reserves.$temp.', ';
                    }
                    else{
                        $reserves = $reserves.$temp;
                    }
                    foreach($oldPatternSplit as $key=>$pat){
                        if($key==$rowName){
                            $oldPatternSplit[$key][$seatNum] = '1';
                        }
                    }
                }

                foreach($oldPatternSplit as $key=>$ele){
                    if($key!=count($oldPatternSplit)-1){
                            $newPattern = $newPattern.$ele."_";
                    }
                    else{
                        $newPattern = $newPattern.$ele;
                    }
                }

                $query = "UPDATE movieSeatPattern SET {$column} = '$newPattern' WHERE movieSeatPattern.movieDate = '$date' AND movieSeatPattern.movieName = '$movieSelected'";
                mysqli_query($connection,$query);

                $movieParticular = $date."_".$time;


                $ticketID = '';
                $rows = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM movieBookings WHERE movieBookings.movieName = '$movieSelected'")); 
                $ticketID = $movieCode.'00'.(((int)$rows)+1);

                mysqli_query($connection,"INSERT INTO movieBookings(ticketID,userName,movieName,movieParticulars,seatPattern) VALUES('$ticketID','$user','$movieSelected','$movieParticular','$reserves')");
                echo "<div class='alert alert-success' role='success'>Seats reserved successfully....</div>";
                header("refresh: 2; url = profile.php");
                
            }
        }
    
    }
    
    ?>

    <!-- loading seat matrix -->
    <?php 
        if(isset($_POST['load'])){
            $data = explode('.',$_POST['slot']);
            $date = $data[0];
            $time = $data[1];
            $query = "SELECT * FROM movieSeatPattern WHERE movieSeatPattern.movieDate = '$date' AND movieSeatPattern.movieName = '$movieSelected'";
            $response = mysqli_query($connection,$query);
            $movie = mysqli_fetch_assoc($response);
            $movieSlot1 = explode("#",$movie['slot1']);
            $movieSlot2 = explode("#",$movie['slot2']);
            $movieSlot3 = explode("#",$movie['slot3']);
            $movieSlot4 = explode("#",$movie['slot4']);
            $pattern = '';
            if($movieSlot1[0]==$time){
                $pattern = $movieSlot1[1];
            }
            if($movieSlot2[0]==$time){
                $pattern = $movieSlot2[1];
            }
            if($movieSlot3[0]==$time){
                $pattern = $movieSlot3[1];
            }
            if($movieSlot4[0]==$time){
                $pattern = $movieSlot4[1];
            }

            echo "<div class='container'>";

            echo "<center><h5>Please select the seats</h5> <input type='checkbox' id='demo1' class='seat'><label for='demo1' class='lbl2'></label> Available <br> <input type='checkbox' id='demo2' class='seat seat_filled'><label for='demo2' class='lbl2'></label> Occupied </center>";
            
            echo "<center><form action='#' method='post' class='seat_matrix'>";
            echo "<input type='text' value=$date name='date' class='hidden'>";
            echo "<input type='text' value=$time name='time' class='hidden'";
            echo "<br><br>";
            $seatRows = explode('_',$pattern);
            foreach($seatRows as $rowNum=>$row){
                $seats = str_split($row);
                foreach($seats as $seatNum=>$seat){
                    if($seat=='0'){
                        echo "<input type='checkbox' value='$rowNum.$seatNum' id='$rowNum.$seatNum' name='slot[]' class='seat'><label for='$rowNum.$seatNum' class='lbl2'></label>";
                    }
                    else{
                        echo "<input type='checkbox' id='$rowNum.$seatNum' class='seat seat_filled'><label for='$rowNum.$seatNum' class='lbl2'></label>";
                    }
                }
                echo "<br>";
            }
            echo "<br><button type='submit' class='book' name='bookNow' style='display:none;'>Book Now</button></form></center>";
            echo "</div><br><br>";
        }
    ?>

    <!-- loading movie dates and time slots -->
    <?php 
    
    $query = "SELECT * FROM movieSeatPattern WHERE movieName='$movieSelected'";
    $response = mysqli_query($connection,$query);
    echo "<form action='#' method='post'>";
    while($movie = mysqli_fetch_assoc($response)){
        $moviedate = $movie['movieDate'];
        $movieposter = $movie['moviePoster'];
        $moviename = $movie['movieName'];
        $moviedesc = $movie['movieDescription'];
        $fare = $movie['ticketCost'];

        echo "<div class='container'>
                <div class='movie_details_row'>
                    <div class='movie_details_col img'>
                        <img src='./images/$movieposter'>
                    </div>
                    <div class='movie_details_col content'>
                        <h2>$moviename</h2>
                        <p>$moviedate</p>
                        <p>Ticket Cost: Rs $fare</p>
                        <h5>About the movie</h5>
                        <p>$moviedesc</p>
                    </div>
                </div>";
        $movieSlot1 = explode("#",$movie['slot1']);
        $movieSlot2 = explode("#",$movie['slot2']);
        $movieSlot3 = explode("#",$movie['slot3']);
        $movieSlot4 = explode("#",$movie['slot4']);
        if($movieSlot1[0]){
            echo "<input type='radio' name='slot' value='$moviedate.$movieSlot1[0]' class='checked' id='slot1'><label for='slot1' class='lbl'>$movieSlot1[0]</label>";
        }
        if($movieSlot2[0]){
            echo "<input type='radio' name='slot' value='$moviedate.$movieSlot2[0]' class='checked' id='slot2'><label for='slot2' class='lbl'>$movieSlot2[0]</label>";
        }
        if($movieSlot3[0]){
            echo "<input type='radio' name='slot' value='$moviedate.$movieSlot3[0]' class='checked' id='slot3'><label for='slot3' class='lbl'>$movieSlot3[0]</label>";
        }
        if($movieSlot4[0]){
            echo "<input type='radio' name='slot' value='$moviedate.$movieSlot4[0]' class='checked' id='slot4'><label for='slot4' class='lbl'>$movieSlot4[0]</label>";
        }
    }

    echo "</div><br><br>";

    echo "<center><button type='submit' name='load' class='load' style='display:none;'>Load tickets</button></center></form>";
    
    
    ?>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function() {
            $("input[name$='slot']").click(function() {
                $(".load").show();
            });
        });
        $(document).ready(function() {
            $("input[name$='slot[]']").click(function() {
                
                $(".book").show();
            });
        });
    </script>


<?php 

include "./includes/footer.php";

?>
