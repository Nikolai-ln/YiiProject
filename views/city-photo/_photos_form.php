<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ferrari</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Ferrari</h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="https://www.hushhush.com/wp-content/uploads/2019/01/2004-ferrari-enzo.jpg" alt="Enzo" style="width:100%;">
        <div class="carousel-caption">
          <h3>Enzo</h3>
          <p></p>
        </div>
      </div>

      <div class="item">
        <img src="https://internationalbanker.com/wp-content/uploads/2019/07/Ferrari-F8-Tributo_1.jpg" alt="F8" style="width:100%;">
        <div class="carousel-caption">
          <h3>F8</h3>
          <p></p>
        </div>
      </div>
    
      <div class="item">
        <img src="https://d1i1eo6qmdfmdv.cloudfront.net/upload/site/pages/drive-ferrari/Ferrari_430F1_LV_Track_Top_1800x700-compressor.jpg" alt="F430" style="width:100%;">
        <div class="carousel-caption">
          <h3>F430</h3>
          <p></p>
        </div>
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</body>
</html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Title</title>
		<meta name="language" content="en" />

		<meta name="description" content="" />

		<meta name="keywords" content="" />
		<style type="text/css">
			ol li {list-style: none; margin-bottom: 15px;}
			ol li img {display: block;}
		</style>
	</head>
	<body>

	<?php

	// open this directory
	$myDirectory = opendir("Uploads/");

	// get each entry
	while($entryName = readdir($myDirectory)) {
		$dirArray[] = $entryName;
	}

	// close directory
	closedir($myDirectory);

	//	count elements in array
	$indexCount	= count($dirArray);

	?>

	<ol>

		<?php
		// loop through the array of files and print them all in a list
		for($index=0; $index < $indexCount; $index++) {
			$extension = substr($dirArray[$index], -3);
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG'){ // list only jpgs and pngs
				echo '<li><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" />';
			}
		}
		?>

	</ol>


</body>
</html>