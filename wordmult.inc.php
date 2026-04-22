<?php
# 02.07.2010 
# функции за xml/word документ - много документи от един шаблон, разделени с PageBreak 

/*
# PageBreak 
$pagemult= '<w:p wsp:rsidR="001F7AE6" wsp:rsidRPr="00E05106" wsp:rsidRDefault="001F7AE6"><w:pPr><w:rPr><w:lang w:val="EN-US"/></w:rPr></w:pPr><w:r><w:rPr><w:lang w:val="EN-US"/></w:rPr><w:br w:type="page"/></w:r></w:p>';

function get_doc_content($cont) {
	preg_match('/<w:body>(.*)<\/w:body>/si', $cont, $matches);
return $matches[1];
}

function replace_doc_content($cont, $newcontent) {
return preg_replace('/<w:body>(.*)<\/w:body>/si', $newcontent, $cont);
}

function getfooter($cont) {
//	preg_match('/<w:ftr.*>(.*)<\/w:ftr>/si', $cont, $matches);
	preg_match('/<w:ftr(.*)>(.*)<\/w:ftr>/siU', $cont, $matches);
return $matches[1];
}

function putfooter($cont, $newcontent) {
//return preg_replace('/<w:ftr.*>(.*)<\/w:ftr>/si', $newcontent, $cont);
return preg_replace('/<w:ftr[^>]*>(.*)<\/w:ftr>/Usi', $newcontent, $cont);
}
*/

# PageBreak 
//$pagemult= '<w:br w:type="page"/>';
//$pagemult= '<w:r><w:br w:type="page"/></w:r>';
$pagemult= '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';

function get_doc_content($cont) {
	preg_match('/<w:body>(.*)<\/w:body>/si', $cont, $matches);
return $matches[1];
}

function replace_doc_content($cont, $newcontent) {
	$newcontent= "<w:body>".$newcontent."</w:body>";
return preg_replace('/<w:body>(.*)<\/w:body>/si', $newcontent, $cont);
}

function getfooter($cont) {
//	preg_match('/<w:ftr.*>(.*)<\/w:ftr>/si', $cont, $matches);
	//preg_match('/<w:ftr(.*)>(.*)<\/w:ftr>/siU', $cont, $matches);
	preg_match('/<w:sectPr(.*)<\/w:sectPr>/siU', $cont, $matches);
return $matches[1];
}

function putfooter($cont, $newcontent) {
//return preg_replace('/<w:ftr.*>(.*)<\/w:ftr>/si', $newcontent, $cont);
//return preg_replace('/<w:ftr[^>]*>(.*)<\/w:ftr>/Usi', $newcontent, $cont);
return preg_replace('/<w:sectPr(.*)<\/w:sectPr>/Usi', $newcontent, $cont);
}

# 02.07.2010 от Ангел 
/*
function get_doc_content($fname) {
	$file = file_get_contents($fname);
	preg_match('/<w:body>(.*)<\/w:body>/si', $file, $matches);
	return $matches[1];
}

function replace_doc_content($fname, $content) {
	$file = file_get_contents($fname);
	return preg_replace('/<w:body>(.*)<\/w:body>/si', $content, $file);
}
	$filename = 'doc1.xml';
	$content = get_doc_content($filename);


	$new_content = str_replace("(-[BANKA]-)", "DSK", $content);
	$new_content .= '<w:p wsp:rsidR="001F7AE6" wsp:rsidRPr="00E05106" wsp:rsidRDefault="001F7AE6"><w:pPr><w:rPr><w:lang w:val="EN-US"/></w:rPr></w:pPr><w:r><w:rPr><w:lang w:val="EN-US"/></w:rPr><w:br w:type="page"/></w:r></w:p>';	
	
	$new_content .= str_replace("(-[BANKA]-)", "POSHTENSKA BANKA", $content);
	
	$new_content .= '<w:p wsp:rsidR="001F7AE6" wsp:rsidRPr="00E05106" wsp:rsidRDefault="001F7AE6"><w:pPr><w:rPr><w:lang w:val="EN-US"/></w:rPr></w:pPr><w:r><w:rPr><w:lang w:val="EN-US"/></w:rPr><w:br w:type="page"/></w:r></w:p>';	

	$new_content .= str_replace("(-[BANKA]-)", "ALPHA BANKA", $content);
	$write_content = replace_doc_content($filename, $new_content);
	$fp = fopen('doc_real.doc', 'w');
	fwrite($fp, $write_content);
	fclose($fp);
*/

?>
