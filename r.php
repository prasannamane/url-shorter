<?php


include 'db/connect.php';                      // include database connection
$short_url = filter_input(INPUT_GET, 'l');     //getting url to do shorter to redirect

//Selecting main url
$sql = "SELECT `url_name` FROM `short` WHERE short_url='$short_url'";
        $result = mysqli_query($conn, $sql); 
		
		if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     header('Location: '. $row["url_name"]);   // Url redirect
    }
		}

?>



