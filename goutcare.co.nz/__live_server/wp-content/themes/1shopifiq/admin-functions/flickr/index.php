<?php 

//include the core file
require_once('phpFlickr.php');

// include the config file
require_once('config.php');

// Fire up the phpFlickr class
$f = new phpFlickr($key);

// phpFlickr needs a cache folder
// in this case we have a writable folder on the root of our site, with permissions set to 777
$f->enableCache("fs", "cache");

//returns an array
$result = $f->people_findByUsername($username);

// grab our unique user id from the $result array
$nsid = $result["id"];

$photos_url = $f->urls_getUserPhotos($nsid);
// Get the user's public photos and show 21 per page
//$page at the end specifies which page to start on, that's the page number ($page) that we got at the start
$photos = $f->people_getPublicPhotos($nsid, NULL, NULL, 9, $page);

// Some bits for paging
$pages = $photos[photos][pages]; // returns total number of pages
$total = $photos[photos][total]; // returns how many photos there are in total
?>

<div id="thumbs">
<?php
	foreach ($photos['photos']['photo'] as $photo) {
            
            $owner = $photo1["owner"]["username"];

         echo "<a class=\"flickr-image\" target=\"_blank\" href=\"".$photos_url.$photo[id]."\" title=\"View $photo[title]\">";
	 // this next line uses buildPhotoURL to construct the location of our image 
	   echo "<img alt=\"$photo[title]\" ".
            "src=\"" . $f->buildPhotoURL($photo, "Square") . "\" width=\"47\" height=\"47\" />";
        echo "</a>\n";

} // end loop

?>
</div><!-- end thumbs -->
