<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 32px;
  left: 0;
  top: 50px;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1000px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.cursor {
  cursor: pointer;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<body>
<h3 style="text-align:center">Gallery</h3>
<table>
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
        $i = 0;
        $row = 0;
		$string="---";
		// loop through the array of files and print them all in a list
		for($index=0; $index < $indexCount; $index++) {
			$extension = substr($dirArray[$index], -3);
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG') // list only jpgs and pngs
			{
				if(strpos($dirArray[$index], $string) == true) // list images containing $string in their names
				{
          if($row == 0)
          {
              echo '<tr><td><div class="hover-shadow cursor"><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px" onclick="openModal();" data-target="#myCarousel" data-slide-to="'.$i.'" class="active"/></div></td>';
              $i++;
              $row++;
          }
          else if($row == 1)
          {
              echo '<td><div class="hover-shadow cursor"><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px" onclick="openModal();" data-target="#myCarousel" data-slide-to="'.$i.'" class="active"/></div></td>';
              $i++;
              $row++;
          }
          else if($row == 2)
          {
              echo '<td><div class="hover-shadow cursor"><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px" onclick="openModal();" data-target="#myCarousel" data-slide-to="'.$i.'" class="active"/></div></td></tr>';
              $i++;
              $row = 0;
          }
        }
			}
		}
		?>
        </table>
        <div id="myModal" class="modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
              <div class="carousel-inner">
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
        </div>


<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
  //setTimeout(function(){document.getElementById("myModal").style.display = "block";}, 650); // to hide the slide between the photos
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}
</script>
    
</body>
</html>
