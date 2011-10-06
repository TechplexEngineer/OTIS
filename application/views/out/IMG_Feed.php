<?php

//////// CODE by Pikori Web Designs - pikori.org   ///////////
//////// Please do not remove this title,          ///////////
//////// feel free to modify or copy this software ///////////
$feedURL = "http://picasaweb.google.com/data/feed/base/user/Techplex.Engineer?alt=rss&kind=album";


$photoNodeNum = 4;
$galleryTitle = 'Breakaway Pictures';
$year = '2011';
?>



<?php

/////////////// DO NOT EDIT ANYTHING BELOW THIS LINE //////////////////

$album = $_GET['album'];
if ($album != "") {

    //&hl=en_US
    //GENERATE PICTURES
    $feedURL = "http://" . $album . "&kind=photo";
    $feedURL = str_replace("entry", "feed", $feedURL);

    $sxml = simplexml_load_file($feedURL);
    $column = 0;
    $pix_count = count($sxml->channel->item);

    //print '<h2>'.$sxml->channel->title.'</h2>';
    print '<table cellspacing="0" cellpadding="0" style="font-size:10pt" width="100%"><tr>';
    for ($i = 0; $i < $pix_count; $i++) {

	print '<td align="center">';
	$entry = $sxml->channel->item[$i];
	$picture_url = $entry->enclosure['url'];
	$time = $entry->pubDate;
	$time_ln = strlen($time) - 14;
	$time = substr($time, 0, $time_ln);
	$description = $entry->description;
	$tn_beg = strpos($description, "src=");
	$tn_end = strpos($description, "alt=");
	$tn_length = $tn_end - $tn_beg;
	$tn = substr($description, $tn_beg, $tn_length);
	$tn_small = str_replace("s288", "s128", $tn);

	$picture_url = $tn;
	$picture_beg = strpos($picture_url, "http:");
	$picture_len = strlen($picture_url) - 7;
	$picture_url = substr($tn, $picture_beg, $picture_len);
	$picture_url = str_replace("s288", "s640", $picture_url);
	print '<a rel="lightbox[group]" href="' . $picture_url . '">';
	print '<img ' . $tn_small . ' style="border:1px solid #02293a" alt="' . $tn_small . '"/><br>';
	print '</a></td> ';

	if ($column == 4) {
	    print '</tr><tr>';
	    $column = 0;
	}
	else
	    $column++;
    }
    print '</table>';
    print '<br><center><a href="media">Return to album</a></center>';
} else {

    //GENERATE ALBUMS
    $sxml = simplexml_load_file($feedURL);
    $column = 0;
    $album_count = count($sxml->channel->item);

    //print '<h2>'.$galleryTitle.'</h2>';
    print '<table cellspacing="0" cellpadding="0" style="font-size:10pt" width="100%"><tr>';
    for ($i = 0; $i < $album_count; $i++) {

	$entry = $sxml->channel->item[$i];

	$time = $entry->pubDate;
	$time_ln = strlen($time) - 14;
	$time = substr($time, 0, $time_ln);

	$description = $entry->description;
	$tn_beg = strpos($description, "src=");
	$tn_end = strpos($description, "alt=");
	$tn_length = $tn_end - $tn_beg;
	$tn = substr($description, $tn_beg, $tn_length);

	$albumrss = $entry->guid;
	$albumrsscount = strlen($albumrss) - 7;
	$albumrss = substr($albumrss, 7, $albumrsscount);

	$search = strstr($time, $year);
	if ($search != FALSE || $year == '') {
	    print '<td valign="top">';
	    print '<a href="/node/' . $photoNodeNum . '?album=' . $albumrss . '">';
	    print '<center><img ' . $tn . ' style="border:3px double #cccccc" alt="' . $tn . '"/><br>';
	    print $entry->title . '<br>' . $time . '</center>';
	    print '</a><br></td> ';

	    if ($column == 3) {
		print '</tr><tr>';
		$column = 0;
	    } else {
		$column++;
	    }
	}
    }
    print '</table>';
}
?>
