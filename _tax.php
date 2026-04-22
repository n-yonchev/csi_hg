<?php
					include "common.php";

$suma= $_POST["suma"];
//var_dump($suma);
print "<br>suma=[$suma]";
$taxa= calctax($suma);
print "<br>taxa=[$taxa]";

	print "
<form method=post>
<input type=text name=suma>
<input type=submit>
</form>
	";

?>
