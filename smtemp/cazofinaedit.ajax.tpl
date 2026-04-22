{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи Ново Постъпление'}
{else}
	{assign var='_title' value='корегирай Постъпление'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

тип
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="idtype" C1="input" C2="inputer" ONCH="typechan();"}

{*------------------ контейнер за тип=2 в брой -------------------*}
<div id="t2" class="inputcont" style="display: none; padding: 6px">
				<table align=center>
				<tr>
				<td align=left colspan=6>
	за приходния касов ордер
		{if $EDIT==0}
				<tr>
				<td align=left colspan=6>
<nobr>
<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер за {$CURRYEAR}г. - евентуално <b>{$NEXTNUMB}</b>
</nobr>
	<div id="seriente" style="display: block;">
<nobr>
<input type="text" name="serinome" id="serinome" size=8 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}>
или въведи тук желания изходящ номер за {$CURRYEAR}г.
</nobr>
	</div>
		{else}
				<tr>
				<td align=right>
	изх.номер/{$CURRYEAR}г.
				<td width=10>
				<td>
<input type="text" name="serinome" id="serinome" class="input" size=20 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}> 
		{/if}
{*----
				<tr>
				<td align=right>
	номер/година
				<td width=10>
				<td>
		{if $EDIT==0}
<input type="text" name="cashserial" id="cashserial" class="input" size=20 {include file="_erelem.tpl" ID="cashserial" C1="input" C2="inputer"}> 
		{else}
<b>{$DATA.cashserial}/{$DATA.cashyear}</b>
		{/if}
----*}
				<tr>
				<td align=right>
	дата
				<td width=10>
				<td>
<input type="text" name="cashdate" id="cashdate" class="input" size=20 {include file="_erelem.tpl" ID="cashdate" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	вносител
				<td width=10>
				<td>
<input type="text" name="cashname" id="cashname" class="input" size=40 {include file="_erelem.tpl" ID="cashname" C1="input" C2="inputer"}> 
				</table>
{*------------------ край на контейнера -------------------*}
</div>

<br>
сума
<br>
<input type="text" name="inco" id="inco" size=20 {include file="_erelem.tpl" ID="inco" C1="input" C2="inputer"}> 
<br>
		{if isset($LISTER.descrip)}
			<font color="red">
		{else}
		{/if}
описание
		{if isset($LISTER.descrip)}
			</font>
		{else}
		{/if}
<br>
<textarea class="input" name="descrip" id="descrip" rows=4 cols=40 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}></textarea>
{*----
<br>
дело
<br>
<input type="text" name="idcase" id="idcase" size=20 {include file="_erelem.tpl" ID="idcase" C1="input" C2="inputer"}> 
----*}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{*----
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' ONCLICK="document.location.href='$DELELINK';return false;" TITLE='изтрий това постъпление' NAME='deleget' ID='deleget'}
----*}
<br>

{*---- скрипт за скриване/показване според типа ----*}
<script type="text/javascript">
function typechan(){ldelim}
	var obtype= document.getElementById("idtype");
	var obcont= document.getElementById("t2");
			if (obtype.value==2){ldelim}
				obcont.style.display= "block";
				resizeNyroModalIframe();
			{rdelim}else{ldelim}
				obcont.style.display= "none";
				resizeNyroModalIframe();
			{rdelim}
{rdelim}
typechan();

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
