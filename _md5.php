<form method='post' action=''>
<input type='text' name='para'>
<input type='submit' value='go'>
</form>

<?php

print md5($_POST["para"]);

?>