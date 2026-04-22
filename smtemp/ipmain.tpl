<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> CSI IP CONTROL </title>
<link rel="stylesheet" href="css/ip.css" type="text/css" media="screen" />
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
&nbsp;&nbsp;&nbsp;&nbsp;
ip login control 
		{if $TURN.acti==0}
<span class="off"> OFF </span>
<a href="{$TURN.on}"> turn on </a>
		{else}
<span class="on"> ON </span>
<a href="{$TURN.off}"> turn off </a>
		{/if}
			<tr>
			<td>
<br>
{$CONTENT}
			</table>
			