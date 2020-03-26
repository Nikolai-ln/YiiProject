<!DOCTYPE html>
<html lang="en">
<head>
  <title>Photos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Photos</h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

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

		<?php
		$i=1;
		$string="---";
		// loop through the array of files and print them all in a list
		for($index=0; $index < $indexCount; $index++) {
			$extension = substr($dirArray[$index], -3);
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG') // list only jpgs and pngs
			{
				if(strpos($dirArray[$index], $string) == true) // list images containing $string in their names
				{
					if($i==1)
					{
						echo '<div class="item active"><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" /><div class="carousel-caption"><h3>'.$dirArray[$index].'</h3></div></div>';
						$i++;
					}
					else
						echo '<div class="item"><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" /><div class="carousel-caption"><h3>'.$dirArray[$index].'</h3></div></div>';
				}
			}
		}
		?>
		<!-- Indicators -->
		<ol class="carousel-indicators">
		<?php
		$i = 1;
		$counter = 0; // number of images that we will show
		for($index=0; $index < $indexCount; $index++) {
			$extension = substr($dirArray[$index], -3);
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG') // list only jpgs and pngs
			{
				if(strpos($dirArray[$index], $string) == true) // list images containing $string in their names
				{
					if($i==1)
					{
						echo '<li data-target="#myCarousel" data-slide-to="'.$counter.'" class="active"></li>';
						$counter++;
						$i++;
					}
					else
					{
						echo '<li data-target="#myCarousel" data-slide-to="'.$counter.'"></li>';
						$counter++;
					}
				}
			}
		}
		?>
		</ol>

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