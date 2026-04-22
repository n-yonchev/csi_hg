{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="извеждане на удостоверение за вписване в регистъра на длъжниците" WIDTH="800"}
{include file="_erform.tpl"}
<span style="border-bottom: 1px solid black; cursor:pointer;" onclick="fuprin('{$LINKPRIN}');"> отпечати </span>
<br>
<span style="font: normal 7pt verdana">
ЗАБЕЛЕЖКА. 
евентуалните ръчни корекции във файла удостоверение.doc ще бъдат отпечатани,
<br>
но не може да бъдат запомнени
</span>
<br>
<br>
{$CONT}

{*
<iframe id="idprin" width=500 height=200 frameborder=1 style="display:block"></iframe>
*}
<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprin(p1){ldelim}
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
{rdelim}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
