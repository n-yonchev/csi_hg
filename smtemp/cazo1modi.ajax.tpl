{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
"}
{include file="_ajax.header.tpl" HEADCODE=$myheadcode}
<style>
optgroup option {ldelim}padding-left:20px;{rdelim}
</style>

{if $EDIT <= 0}
	{assign var="_title" value='ВЪВЕДИ НОВО ДЕЛО'}
{else}
	{assign var="_title" value='корегирай основни данни за дело '|cat:$SERIYEAR}
{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

					<table>
					<tr>
					<td>
дата на образуване
<br>
<input type="text" name="created" id="created" size=20 {include file="_erelem.tpl" ID="created" C1="input" C2="inputer"}> 
					<td width=10>
					<td>
{*---- представител autocomplete ----*}
представител (въведи текст)
<br>
<input type="text" name="agent" id="agent" size=40 onkeyup="contrest(event,this,'{$AGNAME}');" 
{include file="_erelem.tpl" ID="agent" C1="input" C2="inputer"}> 
					</table>
описание
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 

			<table>
			<tr>
<td> идва от
<td> състав
			<tr>
<td>
<nobr>
<span id="selecofrom"></span>
{*----
{include file="_select.tpl" FROM=$ARFROMNAME ID="idcofrom" C1="input" C2="inputer"}
{include file="_select2.tpl" ID="idcofrom" C1="input" C2="inputer"}
<select name="idcofrom" id="idcofrom">
{$ARFROMCODE}
</select>
{include file="_select.tpl" FROM=$ARFROMCODE ID="idcofrom" C1="input" C2="inputer"}
----*}
{include file="_select.tpl" FROM=$ARFROMNAME ID="idcofrom" C1="input" C2="inputer"}
{*--------*}
{*----
	<a href="index.php{$ADDCOFROM}" class="nyroModal" target="_blank" title="добави [идва от]">
	<img src="images/addcof.gif"> </a>
----*}
</nobr>
<td>
<input type="text" name="cogrou" id="cogrou" size=10 {include file="_erelem.tpl" ID="cogrou" C1="input" C2="inputer"}> 
			</table>

{*
изпълнителен титул
<br>
{include file="_select.tpl" FROM=$ARTITUNAME ID="idtitu" C1="input" C2="inputer"}
*}
			<table>
			<tr>
<td> изпълнителен титул
<td> надбавка ОЛП
			<tr>
<td>
{include file="_select.tpl" FROM=$ARTITUNAME ID="idtitu" C1="input" C2="inputer"}
<td>
{include file="_select.tpl" FROM=$AREXINNAME ID="extraint" C1="input" C2="inputer"}
			</table>

{*------------------ контейнер за изп.лист -------------------*}
<div id="subtit1" class="inputcont" style="display: none; padding: 6px">
	дата на изп.лист
<br>
<input type="text" name="dateexec" id="dateexec" size=10 {include file="_erelem.tpl" ID="dateexec" C1="input" C2="inputer"}> 
<br>
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на заповедта
<br>
<input type="text" name="nomecomm" id="nomecomm" size=10 {include file="_erelem.tpl" ID="nomecomm" C1="input" C2="inputer"}> 
				<td width=10>
				<td>
	дата на заповедта
<br>
<input type="text" name="datecomm" id="datecomm" size=10 {include file="_erelem.tpl" ID="datecomm" C1="input" C2="inputer"}> 
				</table>
	подтитул
<br>
{include file="_select.tpl" FROM=$ARSUBTNAME ID="idsubtit" C1="input" C2="inputer"}
</div>
{*-------------------------------------*}

{*------------------ контейнер за обезпечит.заповед -------------------*}
<div id="subtit2" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на заповедта
<br>
<input type="text" name="obezpe_nome" id="obezpe_nome" size=10 {include file="_erelem.tpl" ID="obezpe_nome" C1="input" C2="inputer"}> 
				<td width=10>
				<td>
	дата на заповедта
<br>
<input type="text" name="obezpe_date" id="obezpe_date" size=10 {include file="_erelem.tpl" ID="obezpe_date" C1="input" C2="inputer"}> 
				</table>
</div>
{*-------------------------------------*}

{*------------------ контейнер за наказат.постановление -------------------*}
<div id="subtit5" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на постановл.
<br>
<input type="text" name="nakaza_nome" id="nakaza_nome" size=10 {include file="_erelem.tpl" ID="nakaza_nome" C1="input" C2="inputer"}> 
				<td width=10>
				<td>
	дата на постановл.
<br>
<input type="text" name="nakaza_date" id="nakaza_date" size=10 {include file="_erelem.tpl" ID="nakaza_date" C1="input" C2="inputer"}> 
				</table>
	издател
<br>
<input type="text" name="nakaza_izda" id="nakaza_izda" size=30 {include file="_erelem.tpl" ID="nakaza_izda" C1="input" C2="inputer"}> 
</div>
{*-------------------------------------*}

{*------------------ 22.02.2011 контейнер за акт -------------------*}
<div id="subtit6" class="inputcont" style="display: none; padding: 6px">
				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
	номер на акта
<br>
<input type="text" name="akt_nome" id="akt_nome" size=10 {include file="_erelem.tpl" ID="akt_nome" C1="input" C2="inputer"}> 
				<td width=10>
				<td>
	дата на акта
<br>
<input type="text" name="akt_date" id="akt_date" size=10 {include file="_erelem.tpl" ID="akt_date" C1="input" C2="inputer"}> 
				</table>
</div>
{*-------------------------------------*}

			<table cellspacing=0 cellpadding=0>
			<tr>
<td> вид
<td> номер
<td> година
			<tr>
<td>
{include file="_select.tpl" FROM=$ARSORTNAME ID="idsort" C1="input" C2="inputer"}
<td>
<input type="text" name="conome" id="conome" size=10 {include file="_erelem.tpl" ID="conome" C1="input" C2="inputer"}> 
<td>
<input type="text" name="coyear" id="coyear" size=10 {include file="_erelem.tpl" ID="coyear" C1="input" C2="inputer"}> 
			</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
ред за отчета
<br>
{include file="_select.tpl" FROM=$ARREPONAME ID="idrepo" C1="input" C2="inputer"}
{*
				<td width=10>
				<td>
текущ статус на делото
<br>
{include file="_select.tpl" FROM=$ARCASESTATNAME ID="idstat" C1="input" C2="inputer"}
*}
				</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
текущ статус на делото
<br>
{include file="_select.tpl" FROM=$ARCASESTATNAME ID="idstat" C1="input" C2="inputer"}
				<td width=10>
				<td>
дата на статуса
<br>
<input type="text" name="timestat" id="timestat" size=20 {include file="_erelem.tpl" ID="timestat" C1="input" C2="inputer"}> 
				</table>

				<table cellspacing=0 cellpadding=0>
				<tr>
				<td>
характер на изпълнението
<br>
{include file="_select.tpl" FROM=$ARCHARNAME ID="idchar" C1="input" C2="inputer"}
				<td width=10>
				<td>
схема на погасяване
<br>
{include file="_select.tpl" FROM=$ARPAYOFF ID="idpayoff" C1="input" C2="inputer"}
				</table>

{*---- за регистъра на завед.дела ----*}
вид и размер на вземането
<br>
<input type="text" name="claimdescrip" id="claimdescrip" size=60 {include file="_erelem.tpl" ID="claimdescrip" C1="input" C2="inputer"}> 
<br>
произход на вземането
<br>
{include file="_select.tpl" FROM=$ARCLAIORIG ID="idclaimorig" C1="input" C2="inputer"}

<br>&nbsp;
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за ЦРД-2014 </legend>
избери тип на вземането
<br>
{include file="_select.tpl" FROM=$AR4TYPENAME ID="idtypereg4" C1="input" C2="inputer"}
<br>
избери вид на вземането
<br>
{include file="_select.tpl" FROM=$AR4VARINAME ID="idvarireg4" C1="input" C2="inputer"}
<br>
избери произход на вземането
<br>
{include file="_select.tpl" FROM=$AR4ORIGNAME ID="idorigreg4" C1="input" C2="inputer"}
		</fieldset>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{* <input type="submit" class="submit" name="submit" id="submit" value="запиши"> *}

{*---- скрипт за скриване/показване според типа --------------------------------*}
<script type="text/javascript">
//	$('#agent').autocomplete("agentauto.ajax.php",{ldelim}matchContains:false, cacheLength:20, extraParams:{ldelim}idmark:{$IDMARK}{rdelim}{rdelim});
	$('#agent').autocomplete("agentauto.ajax.php",{ldelim}matchContains:false, cacheLength:20, scrollHeight:400
	,formatItem: function(data, i, total) {ldelim}
			{if isset($IDMARK)}
				if (data[1]=={$IDMARK}){ldelim}
	return "<font color=red>"+data[0]+"</font>";
				{rdelim}else{ldelim}
	return data[0];
				{rdelim}
			{else}
	return data[0];
			{/if}
		{rdelim}
	{rdelim});
function contrest(event,obje,cont){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==27){ldelim}
		obje.value= cont;
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}

var obtype= document.getElementById("idtitu");
var obsubt1= document.getElementById("subtit1");
var obsubt2= document.getElementById("subtit2");
var obsubt5= document.getElementById("subtit5");
var obsubt6= document.getElementById("subtit6");
obtype.onchange= typechan;
typechan();
//parent.$.nyroModalSettings({ldelim}height:260, width:350{rdelim});

function typechan(){ldelim}
	obsubt1.style.display= "none";
	obsubt2.style.display= "none";
	obsubt5.style.display= "none";
	obsubt6.style.display= "none";
	if (obtype.value==1){ldelim}
		obsubt1.style.display= "block";
	{rdelim}else if (obtype.value==2){ldelim}
		obsubt2.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else if (obtype.value==5){ldelim}
		obsubt5.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else if (obtype.value==6){ldelim}
		obsubt6.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
//getcof({$POSTCOFROM});
function getcof(p1){ldelim}
	$("#idcofrom").load(encodeURI("cazo1cofrom.ajax.php?sele="+p1),{ldelim}{rdelim},function() {ldelim}
		resizeNyroModalIframe();
		//setTimeout("resizeNyroModalIframe();",1000);
	
	{rdelim});
{rdelim}
</script>
{include file='_window.footer.tpl'}

{include file="_ajax.footer.tpl"}
