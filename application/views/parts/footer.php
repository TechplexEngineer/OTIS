<?php

$bfig = $this->config->item('bfig');
//echo "This system was designed, built and is maintained by Blake ";
//echo '<br>';
echo  $bfig['sysabrev'] . " (" .$bfig['sysname']. ") designed, built and maintained by Blake &copy; ".$bfig['year']. " ";
echo anchor('http://techwizworld.net','Techplex Labs', array('target'=>'_blank'));
//echo "<br> Page Rendered in {elapsed_time} sec, Using {memory_usage} of memory";
?>