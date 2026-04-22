<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="{$CSSPATH}{$VISUNAME}" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="nyromodal/styles/nyroModal.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/tools.js"></script><script type="text/javascript" src="js/eff.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="nyromodal/jquery.nyroModal-1.3.1.js"></script>
<script type="text/javascript" src="js/resize.iframe.js"></script> 
{*
		{if isset($HEADJS)}
			{foreach from=$HEADJS item=jselem}
<script type="text/javascript" src="js/{$jselem}"></script>
			{/foreach}
		{else}
		{/if}
	{if isset($HEADCODE)}
{$HEADCODE}
	{else}
	{/if}
{$EXITCODE}
*}
</head>
<body onload="{$ONLOAD};" style='height:100%;'>
{*
<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
*}
<form>

			<table class='window_table' style="width:600px;height:300px;" id='nyroWindow' cellspacing='0' cellpadding='0'>
			<tr>
<td>
<div style="float:left"> обръщение към сървъра </div>
<div style="float:right" onclick="parent.location.reload();"> X </div>
			<tr>
<td>
<div style='border: 1px solid #a3bae9;margin: 2px;'>
<div class='window_border' id='divscroll'>
<div id='divnotscroll'>

{include file="certifv2.inc.tpl"}

<script>
{*
nyremo= function(){ldelim}parent.location.reload();{rdelim}
*}
</script>
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
