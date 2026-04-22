<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body style="background-color:moccasin;font:normal 10pt verdana;"
{if isset($LINK)}onload="document.location.href='{$LINK}';"{else}{/if}>
			{if isset($TEXT)}
{$TEXT}
			{else}
			{/if}

			{if $FINI}
<script>
parent.fuprin("$LINK");
parent.prinfini();
</script>
			{else}
			{/if}

</body>
</html>
