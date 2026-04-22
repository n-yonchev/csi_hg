<?php
									include_once "common.php";

$prnt= $_GET["prnt"];

$cont= $DB->selectCell("select content from docuout where id=?d" ,$prnt);
									# WORD format 
									$cont .= HeaderingWord("myfile.doc");
									print $cont;

function HeaderingWord($filename) {
# application/msword
      header("Content-type: application/vnd.ms-word");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
}

?>
