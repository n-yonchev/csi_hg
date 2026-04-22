<?php
/*
# download на файл 
# $file - физическото име във файловата система 
# $name - името за download 
function download($file,$name){
		# без този ред не става във FireFox 
		header('Content-Type: application/force-download');
	header('Cache-Control: public');
	//header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename='.$name);
	header('Accept-Ranges: bytes');
	header("Content-Transfer-Encoding: binary");
	readfile($file);
}
*/

# download на файл 
# $contfile - физическото име във файловата система 
# $name - името за download 
function download($contfile,$name){
		# без този ред не става във FireFox 
		header('Content-Type: application/force-download');
	header('Cache-Control: public');
	//header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename='.$name);
	header('Accept-Ranges: bytes');
	header("Content-Transfer-Encoding: binary");
//	readfile($file);
print $contfile;
}

?>
