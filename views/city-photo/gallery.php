<html>
<head>
</head>
<body>
<h3> Gallery </h3>
    <table align="center" cellspacing="1" cellpadding="5">
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
        $i = 0; //row counter
		$string="---";
		// loop through the array of files and print them all in a list
		for($index=0; $index < $indexCount; $index++) {
			$extension = substr($dirArray[$index], -3);
			if ($extension == 'jpg' || $extension == 'png' || $extension == 'JPG' || $extension == 'PNG') // list only jpgs and pngs
			{
				if(strpos($dirArray[$index], $string) == true) // list images containing $string in their names
				{
                    if($i == 0)
                    {
                        echo '<tr><td><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px"/></td>';
                        $i++;
                    }
                    else if($i == 1)
                    {
                        echo '<td><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px"/></td>';
                        $i++;
                    }
                    else if($i == 2)
                    {
                        echo '<td><img src="../Uploads/' . $dirArray[$index] . '" alt="Image" width="350px"/></td></tr>';
                        $i = 0;
                    }
                }
			}
		}
		?>
    </table>
</body>
</html>