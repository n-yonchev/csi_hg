<?php

# проверяваме как е извършен upload на поле с име $file_field_name от форма 
# връща стринг с текста на грешката, или празен, ако няма грешка 
function checkupload($file_field_name){
		# параметрите на upload-натия файл 
		$finame= $_FILES[$file_field_name]["name"];
		$fisize= $_FILES[$file_field_name]["size"];
		$fitype= $_FILES[$file_field_name]["type"];
		$fitemp= $_FILES[$file_field_name]["tmp_name"];
		$fierro= $_FILES[$file_field_name]["error"];
		if ($fierro==0){
			# няма грешки при uploada 
			$texter= "";
		}else{
			# има грешка при uploada 
//			$texter= "upload error $fierro";
			$texter= "грешка $fierro";
			# възможни грешки в дължината на файла : 
			# ако дължината на файла превишава допустимата 
			#   $fierror=1 
			#         = UPLOAD_ERR_INI_SIZE The uploaded file exceeds the upload_max_filesize directive in php.ini. 
			#   $fierror=2
			#         = UPLOAD_ERR_FORM_SIZE The uploaded file exceeds the MAX_FILE_SIZE directive 
			#           that was specified in the HTML form. 
			if ($fierro==1 or $fierro==2){
//				$texter .= " file is too long";
				$texter .= "<br>файла е много дълъг";
			}else{
			}
		}
return $texter;
}


?>