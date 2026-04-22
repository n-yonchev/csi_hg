<?php
# проба за криптиране/декриптиране 

				include_once "common.php";

$list[]= "mode=wzisk";
$list[]= "mode=wzisk&page=45";
$list[]= "mode=wzisk&page=45&sort=name";
$list[]= "mode=wzisk&page=45&sort=name&type=7";

foreach($list as $elem){
print "<br><br>"."[$elem]";
	$crelem= mycrypt("put",$elem);
print "<br>[$crelem]";
	$deelem= mycrypt("get",$crelem);
print "<br>[$deelem]";
}

?>