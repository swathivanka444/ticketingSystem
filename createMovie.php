<?php 

include "./includes/header.php";
include "./includes/connect.php";
include "./includes/adminGetBack.php";

?>

<?php 

if(isset($_POST['create'])){
    $moviename =  $_POST['moviename'];
    $moviecode =  $_POST['moviecode'];
    $date = $_POST['moviedate'];
    $desc = $_POST['moviedescription'];
    $cost = $_POST['cost'];
    $movieimg = $_FILES['movieImg']['name'];
    $movietrailer = $_POST['trailer'];

    $slot1 = $_POST['slot1'];
    $rows1 = $_POST['rows1'];
    $seats1 = $_POST['seats1'];

    $slot2 = $_POST['slot2'];
    $rows2 = $_POST['rows2'];
    $seats2 = $_POST['seats2'];

    $slot3 = $_POST['slot3'];
    $rows3 = $_POST['rows3'];
    $seats3 = $_POST['seats3'];

    $slot4 = $_POST['slot4'];
    $rows4 = $_POST['rows4'];
    $seats4 = $_POST['seats4'];

    $regStatus = $_POST['reg'];

    $pattern1 = $pattern2 = $pattern3 = $pattern4 = NULL;


    function generate($rows,$seats){
        $pattern = '';
        for($i=1;$i<=$rows;$i++){
            $sub = str_repeat("0", $seats);
            if($i!=$rows){
                $pattern = $pattern.$sub."_";
            }
            else{
                $pattern = $pattern.$sub;
            }
        }
        return $pattern;
    }


    if($slot1){
        $pattern1 = $slot1.'#';
        $pattern1 = $pattern1.generate($rows1,$seats1);
    }
    if($slot2){
        $pattern2 = $slot2.'#';
        $pattern2 = $pattern2.generate($rows2,$seats2);
    }
    if($slot3){
        $pattern3 = $slot3.'#';
        $pattern3 = $pattern3.generate($rows3,$seats3);
    }
    if($slot4){
        $pattern4 = $slot4.'#';
        $pattern4 = $pattern4.generate($rows4,$seats4);
    }

    $upload = 'images/';
    move_uploaded_file($_FILES['movieImg']['tmp_name'],$upload.basename($_FILES['movieImg']['name']));

    mysqli_query($connection,"INSERT INTO movieSeatPattern(movieName,movieCode,movieDate,movieDescription,ticketCost,moviePoster,movieTrailer,slot1,slot2,slot3,slot4,isRegistrationsOpened) VALUES('$moviename','$moviecode','$date','$desc','$cost','$movieimg','$movietrailer','$pattern1','$pattern2','$pattern3','$pattern4','$regStatus')");

    echo "Movie added successfully";
    header("refresh: 2; url = admin.php");

}

?>

<div class='container'>

    <h3>Add details of the movie</h3>
    <br>

    <form action="#" method="post" enctype="multipart/form-data">
        <input type="text" placeholder='moviename*' class='form-control' name='moviename' required>
        <br><br>
        <input type="text" placeholder='moviecode*' class='form-control' name='moviecode' required>
        <br><br>
        <input type="text" placeholder='Ex:29-06-2022*' class='form-control' name='moviedate' required>
        <br><br>
        <textarea name="moviedescription" cols="30" class='form-control' rows="10" placeholder='Description*' required></textarea>
        <br><br>
        <input type="text" placeholder='ticket cost*' class='form-control' name='cost' required>
        <br><br>
        <input type='file' name='movieImg' required>
        <br><br>
        <input type="text" name='trailer' class='form-control' placeholder='Movie trailer youtube link*' required>
        <br><br>
        <label for="slot1">Slot1 Details*</label>
        <input type='text' class='form-control' placeholder='Ex: 11:00AM' name='slot1' required>
        <input type="text" class='form-control' name='rows1' value='15' required>
        <input type="text" class='form-control' name='seats1' value='20' required>
        <br><br>
        <label for="slot2">Slot2 Details</label>
        <input type='text' class='form-control' placeholder='Ex: 3:00PM' name='slot2'>
        <input type="number" class='form-control' name='rows2' value='15'>
        <input type='number' class='form-control' name='seats2' value='20'>
        <br><br>
        <label for="slot3">Slot3 Details</label>
        <input type='text' class='form-control' placeholder='Ex: 6:00PM' name='slot3'>
        <input type="number" class='form-control' name='rows3' value='15'>
        <input type="number" class='form-control' name='seats3' value='20'>
        <br><br>
        <label for="slot4">Slot4 Details</label>
        <input type='text' class='form-control' placeholder='Ex: 9:00PM' name='slot4'>
        <input type="number" class='form-control' name='rows4' value='15'>
        <input type="number" class='form-control' name='seats4' value='20'>
        <br><br>
        <label for="reg">Registration open: </label>
        <input type="radio" value="1" name='reg' class='form-check-input'>
        <br>
        <label for="reg">Registration close: </label>
        <input type="radio" value="0" name='reg' checked class='form-check-input'>
        <br><br>
        <button type='submit' name='create' class='btn btn-info'>Create movie</button>
    </form>

</div>

<br><br>

<?php 

include "./includes/footer.php";

?>

