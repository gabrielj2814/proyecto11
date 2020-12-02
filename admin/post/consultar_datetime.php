<?php
	$datetime_now = new DateTime();
	$datetime_now = $datetime_now->format('Y-m-d H:i:s');
	$data = explode(" ", $datetime_now);
	echo $data[0]."&nbsp;&nbsp;&nbsp;".$data[1];
?>
