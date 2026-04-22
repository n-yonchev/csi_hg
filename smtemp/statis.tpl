<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> CSI STATISTICS </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/ip.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="nyromodal/styles/nyroModal.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="nyromodal/jquery.nyroModal-1.3.1.js"></script> 
</head>
<body style="font: normal 10pt verdana">

			<table class="main" align=center>
			<tr>
			<td>
		{foreach from=$MAINMENU item=elem key=ekey}
<a class="{if $ekey==$MODE}curr{else}{/if}" href="{$elem.link}">
{$elem.text}
</a>
		{/foreach}
			<tr>
			<td>
<br>
{$CONTENT}
			</table>
			
</body>
</html>