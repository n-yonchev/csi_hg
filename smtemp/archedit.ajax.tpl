{include file="_ajax.header.tpl"}
{if $EDIT==0}
{*
	{assign var='_title' value='въведи данни за архива за '|cat:$COUNT|cat:" бр. дела"}
*}
	{assign var='_title' value='архивирай изпълнително дело '}
{else}
	{assign var='_title' value='корегирай архивните данните за изп.дело '|cat:$ROCONT.caseseri|cat:"/"|cat:$ROCONT.caseyear}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

{*
										{if $EDIT==0 and $COUNT==0}
няма избрани дела
										{else}
номер
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}> 
дата
<input type="text" name="date" id="date" size=20 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
връзка №
<br>
<input type="text" name="packet" id="packet" size=20 {include file="_erelem.tpl" ID="packet" C1="input" C2="inputer"}> 
<br>
протокол
<br>
<input type="text" name="protocol" id="protocol" size=60 {include file="_erelem.tpl" ID="protocol" C1="input" C2="inputer"}> 
<br>
запазени документи
<br>
<input type="text" name="documents" id="documents" size=60 {include file="_erelem.tpl" ID="documents" C1="input" C2="inputer"}> 
<br>
том
<input type="text" name="volume" id="volume" size=10 {include file="_erelem.tpl" ID="volume" C1="input" C2="inputer"}> 
година
<input type="text" name="year" id="year" size=10 {include file="_erelem.tpl" ID="year" C1="input" C2="inputer"}> 
<br>
забележка
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}> 

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
						{if $EDIT==0}
						{else}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='изтрий данните' NAME='delete' ID='delete'}
						{/if}
										{/if}
*}

{*
избери година на архива
{include file="_select.tpl" FROM=$ARYEARNAME ID="year" C1="input" C2="inputer" ONCH="chansele();"}
<br>
*}
{*----
изп.дело
<input type="text" name="seriyear" id="seriyear" size=20 {include file="_erelem.tpl" ID="seriyear" C1="input" C2="inputer"}>
<br>
----*}
<input type="hidden" name="year" id="year" value="{$YEAR}">
						{if $EDIT==0}
изп.дело/год
<input type="text" name="seriyear" id="seriyear" size=20 {include file="_erelem.tpl" ID="seriyear" C1="input" C2="inputer"}>
<br>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния архивен номер - евентуално <b><span id="yearnext"></span></b>
	<div id="seriente" style="display: block;">
<nobr>
или въведи желания архивен номер за {$YEAR} год.
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}>
</nobr>
	</div>
						{else}
архивен номер за {$YEAR} год.
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}>
						{/if}
<br>
дата на архивиране
<input type="text" name="date" id="date" size=10 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}>
&nbsp;
връзка номер
<input type="text" name="packet" id="packet" size=10 {include file="_erelem.tpl" ID="packet" C1="input" C2="inputer"}>
<br>
<nobr>
протокол №
<input type="text" name="protocol" id="protocol" size=10 {include file="_erelem.tpl" ID="protocol" C1="input" C2="inputer"}>
&nbsp;
от дата
<input type="text" name="protdate" id="protdate" size=10 {include file="_erelem.tpl" ID="protdate" C1="input" C2="inputer"}>
</nobr>
<br>
запазени документи - номер, дата, описание
<br>
<textarea rows=8 cols=80 name="doculist" id="doculist" {include file="_erelem.tpl" ID="doculist" C1="input" C2="inputer"}></textarea>
<br>
том година и номер
<br>
<input type="text" name="volume" id="volume" size=20 {include file="_erelem.tpl" ID="volume" C1="input" C2="inputer"}> 
<br>
забележка
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}> 

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
						{if $EDIT==0}
						{else}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{*
{include file='_but2.tpl' TYPE='submit' TITLE='деархивирай дело '|cat:$ROCONT.caseseri|cat:"/"|cat:$ROCONT.caseyear NAME='delete' ID='delete'}
*}
<a href="#" onclick="toggle(); return false;" style="font: normal 8pt verdana; border-bottom: 1px solid black;"> 
деархивирай дело {$ROCONT.caseseri|cat:"/"|cat:$ROCONT.caseyear} </a>
<div id="dearch" style="display:none;">
<br>
ВНИМАНИЕ.
В резултат на деархивирането :
<br>
Всички ТЕЗИ архивни данни за делото ще бъдат ИЗТРИТИ.
<br>
Архивния номер <b>{$smarty.post.serial}/{$YEAR}</b> ще остане СВОБОДЕН.
<br>
Изп.дело <b>{$ROCONT.caseseri}/{$ROCONT.caseyear}</b> ще попадне ИЗВЪН АРХИВА.
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='потвърди' NAME='delete' ID='delete'}
&nbsp;&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='откажи' NAME='cancel' ID='cancel'}
</div>
						{/if}

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
chansele();
chancrea();
function chansele(){ldelim}
	$("#yearnext").load("casearchnext.ajax.php?year="+$("#year").attr("value"));
{rdelim}
function chancrea(){ldelim}
	if (obje.checked){ldelim}
		obente.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obente.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
function toggle(){ldelim}
//	$("#dearch:visible").hide();
	$("#dearch:hidden").show();
		resizeNyroModalIframe();
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
