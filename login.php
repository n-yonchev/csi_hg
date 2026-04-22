<?php

									include_once "common.php";

/*
$metacont= <<<e1
<script type="text/javascript">
	$(function() {
		$('#lin1').click();
		return false;
	});
</script>
e1;

# извеждаме 
$smarty->assign("METACONT", $metacont);
//print smdisp("main.tpl","iconv");
smdisp("login.tpl");
*/

# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", "_login.js");

# извеждаме 
$smarty->assign("METACONT", $metacont);
print smdisp("login.tpl","iconv");

?>



