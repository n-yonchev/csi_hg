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
{*
<br>
всяка нова парола не трябва да съвпада с никоя от предишните
<br>
всяка използвана парола важи 2 месеца
*}
		</div>
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('#passinst').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
