<?php /* Smarty version 2.6.9, created on 2020-03-10 13:32:47
         compiled from _passinstview.tpl */ ?>
<div id="passinst" style="float: right; font: bold 7pt verdana" rel="#passin" title="указание за паролата" style="cursor:help"> 
указание
</div>
		<div id="passin" style="display: none;">
паролата трябва да съдържа :
<ul>
<li>минимум 6 символа</li>
<li>поне 1 главна буква</li>
<li>поне 1 малка буква</li>
<li>поне 1 цифра</li>
</ul>
паролата не трябва да съвпада с входното име
		</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#passinst').cluetip({ width: 240, local:true, cursor:'pointer' });
});
</script>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />