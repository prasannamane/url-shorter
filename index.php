<?php
include 'db/connect.php';           // include database connection
$url = filter_input(INPUT_POST, 'url'); //getting url to do shorter
$short_url = "";                         // variable 1 to use store after short
$short_url2 = "";                        // variable 2 to use display after short
if(isset($url)){						// checking submit button
														// set the timezone first
    if(function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }
    
    $year = date("Y");                                       // taking year
    $month = date("m"); 							// taking month
    $day = date("d");							 // taking day
	
	// checking how many url insrted in this day 
    $sql = "SELECT count(number) as number FROM `short` WHERE `number` LIKE '$year$month$day%'";
	
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
         echo   $num = $row['number'];
           
       }
    }
      $number = $num + 1;
    $next = $year.$month.$day.$number;             // creating url number
	
	
	$id = $next;
	
	/* ------------------------------Make number shorter start----------------------*/
	$alphabet='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
    $base = strlen($alphabet);
	
    $short = '';
    while($id) {
        $id = ($id-($r=$id%$base))/$base;     
        $short = $alphabet{$r} . $short;
    };
	
	/* ------------------------------Make number shorter End----------------------*/
    $short_url = $short;

	
//Insert url in db
$sql = "INSERT INTO `short`(`url_name`, `number`, `short_url`) VALUES ('$url', '$next', '$short_url')";
        $result = mysqli_query($conn, $sql); 
		$short_url2 = "localhost/u/r?l=".$short_url;
		
}

?>




<!-- here html code for just submit url-->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    
    <link href="css/main.css" rel="stylesheet" />
  </head>
  <body>
    <div class="s01">
      <form action="" method="post"> 
        <fieldset>
          <legend>Make URL Shorter</legend>
        </fieldset>
        <div class="inner-form">
          <div class="input-field first-wrap">
            <input id="" type="text" name="url" placeholder="Enter Url Ex. https://demo.com" />
          </div>
          
          <div class="input-field third-wrap">
            <input class="btn-search" type="submit" value="Shorter">
          </div>
        </div>
		
		<div class="inner-form">
         
          <h3 style="color: white;">Copy shorter url: <?=$short_url2?> </h3>
        
        </div>
      </form>
    </div>
  </body>
</html>

