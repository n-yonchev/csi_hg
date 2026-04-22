{*----
	източник : cazo6regi.ajax.tpl
----*}

		{if $EDIT==0}
			{assign var=txti value="данни за нов изходящ документ"}
		{else}
			{assign var=txti value="корекция на данни за изх.документ "|cat:$DOCUNOME}
		{/if}
{include file="_ajax.header.tpl" ONLOAD="chancrea();"}
{include file="_window.header.tpl" TITLE=$txti}
{include file="_erform.tpl"}

		{if $EDIT==0}
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер - евентуално <b>{$NEXTNUMB}</b>
	<div id="seriente" style="display: block;">
или въведи желания изходящ номер
<input type="text" name="serinome" id="serinome" size=8 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}>
	</div>
		{else}
		{/if}
					{if $FROMCASE}
<input type=hidden name="caseseri" id="caseseri">
<input type=hidden name="caseyear" id="caseyear">
<br>
дело <b>{$smarty.post.caseseri}/{$smarty.post.caseyear}</b>
					{else}
<br>
дело номер 
<input type="text" name="caseseri" id="caseseri" size=10 {include file="_erelem.tpl" ID="caseseri" C1="input" C2="inputer"}>
година 
{include file="_select.tpl" FROM=$ARYEARNAME ID="caseyear" C1="input" C2="inputer"}
		{if $CBCREACASE}
създай делото
<input type="checkbox" name="flagcrea" id="flagcrea">
		{else}
		{/if}
					{/if}

<br>
описание
<br>
<input type="text" name="descrip" id="descrip" size=60 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=60 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}>
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
