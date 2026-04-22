{include file="_ajax.header.tpl" ONLOAD="chancrea();"}
{include file="_window.header.tpl" TITLE="добавяне празно дело"}
{include file="_erform.tpl"}

<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния номер за текущата година - евентуално <b>{$NEXTNUMB}</b>
	<div id="seriente" style="display: block;">
или въведи желания номер/година
<br>
<input type="text" name="seriyear" id="seriyear" size=10 {include file="_erelem.tpl" ID="seriyear" C1="input" C2="inputer"}>
	</div>
<br><br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
//chancrea();
function chancrea(){ldelim}
	if (obje.checked){ldelim}
		obente.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obente.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
