<?php 
    
    include "./includes/connect.php"; 
    include "./includes/header.php";
    
?>



<div class='container'>


  <?php
          $query1 = "SELECT * FROM movieSeatPattern ORDER BY sno DESC";
          $response1 = mysqli_query($connection,$query1);

          if(mysqli_num_rows($response1) > 0){
            echo "<h6 class='heading'>Watch trailers of featuring movies (Feel free to scroll using arrows)</h6>
                  <br>
                <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
                <div class='carousel-inner'>";

            $count = 0;
            while($movie = mysqli_fetch_assoc($response1)){
                $movieImg = $movie['moviePoster'];
                $moviename = $movie['movieName'];
                $trailer = $movie['movieTrailer'];
                
                if($count==0){
                  echo "<div class='carousel-item active'>
                          <iframe class='d-block w-100' src='$trailer' title='$moviename' allow='accelerometer' allowfullscreen></iframe>
                        </div>";
                }
                else{
                  echo "<div class='carousel-item'>
                          <iframe class='d-block w-100' src='$trailer' title='$moviename' allow='accelerometer' allowfullscreen></iframe>
                        </div>";
                }
                $count = $count+1;
                if($count==3){
                  break;
                }
            }
            echo "</div>
                    <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
                      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    </a>
                    <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                      <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    </a>
                </div>";
          }

  ?>

  <br>

    <?php 

        $query1 = "SELECT * FROM movieSeatPattern WHERE isRegistrationsOpened=1";
        $response1 = mysqli_query($connection,$query1);

        echo "<h4 class='heading'>Now Playing</h4>";

        echo "<div class='movies_container'>";

        if(mysqli_num_rows($response1) > 0){
          while($movie = mysqli_fetch_assoc($response1)){
            $movieName = $movie['movieName'];
            $movieImg = $movie['moviePoster'];
            $date = $movie['movieDate'];
            

            echo "<a href='detailsAndBooking.php?moviename=$movieName' class='card'>
                        <div class='img'><img src='images/$movieImg'></div>
                    </a>";
          }
        }
        else{
          echo "Updating soon.....";
        }

        echo "</div>";

        $query2 = "SELECT * FROM movieSeatPattern WHERE isRegistrationsOpened=0";
        $response2 = mysqli_query($connection,$query2);
        echo "<h4 class='heading'>Upcoming</h4>";

        echo "<div class='movies_container'>";

        if(mysqli_num_rows($response2) > 0){
          while($movie = mysqli_fetch_assoc($response2)){
            $movieName = $movie['movieName'];
            $movieImg = $movie['moviePoster'];
            $date = $movie['movieDate'];
            

            echo "<div class='card'>
                        <div class='img'><img src='images/$movieImg'></div>
                    </div>";
          }
        }
        else{
          echo "Updating soon.....";
        }

        echo "</div>";
        
    ?>

</div>

<script>
  $('.carousel').carousel({
    interval: false
  })
</script>

<?php 

include "./includes/footer.php";

?>