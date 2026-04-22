{include file="_ajax.header.tpl" ONLOAD="chancrea();"}
{include file="_window.header.tpl" TITLE="регистриране на сметка"}
{include file="_erform.tpl"}

<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния номер - <nobr>евентуално <b>{$NEXTNUMB}</b></nobr>
	<div id="seriente" style="display: block;">
или въведи желания номер
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}>
	</div>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
			var retax= {$smarty.post.regitax} +0;
			var retext= "{$TEMPTEXT}";
			var tempmark= "{$TEMPMARK}";
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
