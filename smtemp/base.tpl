<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100> основни данни за ЧСИ
	</thead>
	<tbody>
<tr>
<td colspan=3 align=center>
{include file="_erform.tpl"}

									<tr><td valign=top style="border-right: 1px solid silver;">
								<table>
								<tr><td>
									<table>

				{assign var="bor0" value="style='border:0px'"}
				{assign var="spac" value="&nbsp;&nbsp;&nbsp;&nbsp;"}
<tr>
	<td style='border:0px' align=right> наименование
	<td style='border:0px'> {$spac}
		<input type="text" name="text" id="text" size=60 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> номер
<td {$bor0}> {$spac}
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}> 

<tr>
	<td style='border:0px' align=right> булстат
	<td style='border:0px'> {$spac}
		<input type="text" name="bulstat" id="bulstat" size=20 {include file="_erelem.tpl" ID="bulstat" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> район на действие
<td {$bor0}> {$spac}
<input type="text" name="region" id="region" size=60 {include file="_erelem.tpl" ID="region" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> пълно име
<td {$bor0}> {$spac}
<input type="text" name="fullname" id="fullname" size=60 {include file="_erelem.tpl" ID="fullname" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> късо име
<td {$bor0}> {$spac}
<input type="text" name="shortname" id="shortname" size=60 {include file="_erelem.tpl" ID="shortname" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> адрес
<td {$bor0}> {$spac}
<input type="text" name="address" id="address" size=60 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> ИССИ apikey
<td {$bor0}> {$spac}
<input type="text" name="issiapikey" id="issiapikey" size=60 {include file="_erelem.tpl" ID="issiapikey" C1="input" C2="inputer"}>

	<tr>
<td {$bor0} align=right> ел партида - AppKey
<td {$bor0}> {$spac}
<input type="text" name="epep_app_key" id="epep_app_key" size=60 {include file="_erelem.tpl" ID="epep_app_key" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> ел партида - AppSecret
<td {$bor0}> {$spac}
<input type="text" name="epep_app_secret" id="epep_app_secret" size=60 {include file="_erelem.tpl" ID="epep_app_secret" C1="input" C2="inputer"}>  
									</table>

{*----
	<tr>
<td {$bor0} align=right> IBAN
<td {$bor0}> {$spac}
<input type="text" name="iban" id="iban" size=60 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> BIC
<td {$bor0}> {$spac}
<input type="text" name="bic" id="bic" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=right> банка
<td {$bor0}> {$spac}
<input type="text" name="bank" id="bank" size=60 {include file="_erelem.tpl" ID="bank" C1="input" C2="inputer"}> 
----*}

	<tr>
<td {$bor0}> банкови сметки
{include file='_but2.tpl' TYPE='submit' TITLE='добави' NAME='plusac' ID='plusac'}

				{foreach from=$ACLIST item="acelem" key="ackey"}
	<tr><td colspan=3 style="padding: 8px; border: none">
	<table class="" style="border-left: 6px solid #dfe8f6;" align=center>
	<tr>
<td align=right> описание
<td>
<input type="text" name="listac[{$ackey}][desc]" id="desc_{$ackey}" size=40 {include file="_erelem.tpl" ID="desc_"|cat:$ackey C1="input" C2="inputer"}> 
	<tr>
<td align=right> IBAN
<td>
<input type="text" name="listac[{$ackey}][iban]" id="iban_{$ackey}" size=40 {include file="_erelem.tpl" ID="iban_"|cat:$ackey C1="input" C2="inputer"}> 
	<tr>
<td align=right>
BIC
<td>
<input type="text" name="listac[{$ackey}][bic]" id="bic_{$ackey}" size=20 {include file="_erelem.tpl" ID="bic_"|cat:$ackey C1="input" C2="inputer"}> 
	<tr>
<td align=right>
банка
<td>
<input type="text" name="listac[{$ackey}][bank]" id="bank_{$ackey}" size=40 {include file="_erelem.tpl" ID="bank_"|cat:$ackey C1="input" C2="inputer"}> 
	</table>
				{/foreach}
{*-------------------------------*}
{*---- 17.01.2011 - избрана сметка за изх.документи = accosele = [desc] за тази сметка ----*}
				{if isset($smarty.post.accosele)}
<tr><td>
банк.сметка за автоматичен избор при генериране на изх.документи
{include file="_select.tpl" FROM=$ARACCONAME ID="accosele" C1="input" C2="inputer"}
				{else}
				{/if}

{*----
				<tr><td colspan=4>
				<table>
	<tr>
<td {$bor0} align=left> нач.номер входящ документ
<td {$bor0}> {$spac}
<input type="text" name="begidocu" id="begidocu" size=10 {include file="_erelem.tpl" ID="begidocu" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> нач.номер изпълнит.дело
<td {$bor0}> {$spac}
<input type="text" name="begicase" id="begicase" size=10 {include file="_erelem.tpl" ID="begicase" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> нач.номер изходящ документ
<td {$bor0}> {$spac}
<input type="text" name="begidocuout" id="begidocuout" size=10 {include file="_erelem.tpl" ID="begidocuout" C1="input" C2="inputer"}> 
				</table>
----*}
				<tr><td colspan=4>
				<table>
	<tr>
<td {$bor0} align=left colspan=8 bgcolor=silver> за сметките по чл.79 ЗЧСИ и за фактурите
{***
	<tr>
<td {$bor0} colspan=2 align=right>
начален номер
<td {$bor0} colspan=2 align=left>
<input type="text" name="bill[number]" id="bill_number" size=6 {include file="_erelem.tpl" ID="bill_number" C1="input" C2="inputer"}> 
***}
	<tr>
<td {$bor0} colspan=2 align=right>
адрес на ЧСИ
<td {$bor0} colspan=2 align=left>
<input type="text" name="bill[address]" id="bill_address" size=60 {include file="_erelem.tpl" ID="bill_address" C1="input" C2="inputer"}> 
	<tr>
<td {$bor0} colspan=4 align=left>
банк.сметка за такси и разноски
	<tr>
<td {$bor0} colspan=2 align=right>
IBAN
<td>
<input type="text" name="bill[iban]" id="bill_iban" size=40 {include file="_erelem.tpl" ID="bill_iban" C1="input" C2="inputer"}> 
	<tr>
<td {$bor0} colspan=2 align=right>
BIC
<td>
<input type="text" name="bill[bic]" id="bill_bic" size=20 {include file="_erelem.tpl" ID="bill_bic" C1="input" C2="inputer"}> 
	<tr>
<td {$bor0} colspan=2 align=right>
банка
<td>
<input type="text" name="bill[bank]" id="bill_bank" size=40 {include file="_erelem.tpl" ID="bill_bank" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
само за фактурите
{***
	<tr>
<td {$bor0} colspan=2 align=right>
начален номер
<td {$bor0} colspan=2 align=left>
<input type="text" name="invobase" id="invobase" size=10 {include file="_erelem.tpl" ID="invobase" C1="input" C2="inputer"}> 
***}
	<tr>
<td {$bor0} colspan=2 align=right>
МОЛ 
<td {$bor0} colspan=2 align=left>
<input type="text" name="invopers" id="invopers" size=60 {include file="_erelem.tpl" ID="invopers" C1="input" C2="inputer"}> 
				</table>

									</table>
									<td valign=top>
									<table>
{**}
	<tr>
<td {$bor0} align=left> нач.номер входящ документ
<td {$bor0}> {$spac}
<input type="text" name="begidocu" id="begidocu" size=10 {include file="_erelem.tpl" ID="begidocu" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> нач.номер изпълнит.дело
<td {$bor0}> {$spac}
<input type="text" name="begicase" id="begicase" size=10 {include file="_erelem.tpl" ID="begicase" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> нач.номер изходящ документ
<td {$bor0}> {$spac}
<input type="text" name="begidocuout" id="begidocuout" size=10 {include file="_erelem.tpl" ID="begidocuout" C1="input" C2="inputer"}> 
{**}
	<tr>
<td {$bor0} colspan=4 align=left>
след вземане на дело директно <br>да се въвеждат основните данни на делото
<input type="checkbox" name="isdirect" id="isdirect" {include file="_erelem.tpl" ID="isdirect" C1="input" C2="inputer"}> 
{*----
	<tr>
<td {$bor0} colspan=4> {$spac}
от коя банка са XML файловете с банковите извлечения
{include file="_select.tpl" FROM=$ARXMLNAME ID="xmlsuffix" C1="input" C2="inputer"}
----*}
{*---- брой дела за миналите години ----*}
			{foreach from=$LISTYEAR item=cuyear}
									<tr>
<td align=right valign=top> брой дела за {$cuyear} год.
<td>
			{assign var=nameyear value="coun"|cat:$cuyear}
<input type="text" name="{$nameyear}" id="{$nameyear}" size=20 {include file="_erelem.tpl" ID=$nameyear C1="input" C2="inputer"}
onkeyup="document.getElementById('link{$cuyear}').style.display='none';"> 
&nbsp;
<a id="link{$cuyear}" href="#" onclick="checkyear('{$cuyear}');">
<img src="images/check.gif" title="проверка">
</a>
<div id="span{$cuyear}" style="background:lightblue;"></div>
			{/foreach}

{*---- флагове за ограничена корекция ----*}
	<tr>
<td {$bor0} colspan=4 align=left>
ограничена корекция на входящите документи
<input type="checkbox" name="isdoculimi" id="isdoculimi" {include file="_erelem.tpl" ID="isdoculimi" C1="input" C2="inputer"}> 
	<tr>
<td {$bor0} colspan=4 align=left>
ограничена корекция на изходящите документи
<input type="checkbox" name="isdocuoutlimi" id="isdocuoutlimi" {include file="_erelem.tpl" ID="isdocuoutlimi" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> буква за редактиране на Word шаблони
<td {$bor0}> {$spac}
<input type="text" name="letteredit" id="letteredit" size=1 {include file="_erelem.tpl" ID="letteredit" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> буква за редактиране на Word изходящи документи
<td {$bor0}> {$spac}
<input type="text" name="letterdocu" id="letterdocu" size=1 {include file="_erelem.tpl" ID="letterdocu" C1="input" C2="inputer"}> 
{*
	<tr>
<td {$bor0} colspan=4 align=left>
изходящи документи до много адресати <br>да се изходяват с отделен номер за всеки адресат
<input type="checkbox" name="isseparate" id="isseparate" {include file="_erelem.tpl" ID="isseparate" C1="input" C2="inputer"}> 
*}
	<tr>
<td {$bor0} align=left> интервал за стари постъпления (дни)
<td {$bor0}> {$spac}
<input type="text" name="finainterval" id="finainterval" size=4 {include file="_erelem.tpl" ID="finainterval" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
изпълнит.дела нямат постоянни деловодители
<input type="checkbox" name="isnopermuser" id="isnopermuser" {include file="_erelem.tpl" ID="isnopermuser" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
забранено ръчното въвеждане на банкови постъпления 
<input type="checkbox" name="isnomanual" id="isnomanual" {include file="_erelem.tpl" ID="isnomanual" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
от кои банки ще постъпват файлове с банкови постъпления 
{foreach from=$ARBANKNAME item=bank key=code}
	<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" name="banklist[]" value="{$code}" label="{$bank}">
{/foreach}

	<tr>
<td {$bor0} colspan=4 align=left>
при изходяване на документ автоматично да се добавя таксата <br>като предмет на изпълнение
<input type="checkbox" name="isregitax" id="isregitax" {include file="_erelem.tpl" ID="isregitax" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> банкова такса за превод на разпределена сума (€)
<td {$bor0}> {$spac}
<input type="text" name="banktax" id="banktax" size=10 {include file="_erelem.tpl" ID="banktax" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
в дневника на изв.действия да се формира отделен номер за всяко дело 
<input type="checkbox" name="isjoursepa" id="isjoursepa" {include file="_erelem.tpl" ID="isjoursepa" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} colspan=4 align=left>
в данните за регистъра да участват взискателите
<input type="checkbox" name="isregiclai" id="isregiclai" {include file="_erelem.tpl" ID="isregiclai" C1="input" C2="inputer"}> 

	<tr>
<td {$bor0} align=left> минимална работна заплата
<td {$bor0}> {$spac}
<input type="text" name="minsal" id="minsal" {include file="_erelem.tpl" ID="minsal" C1="input" C2="inputer"}> 
{*
	<tr>
<td {$bor0} align=left> нулев номер за фактурите
<td {$bor0}> {$spac}
<input type="text" name="invobase" id="invobase" size=10 {include file="_erelem.tpl" ID="invobase" C1="input" C2="inputer"}> 
*}
									</table>
	<tr>
	<td colspan=100 align=center  style='border:0px'>
<br/>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
</table>

</form>

<script>
function checkyear(p1,p2){ldelim}
			if (p2){ldelim}
	$("#span"+p1).load("baseyear.ajax.php?year="+p1+"&coun="+$("#coun"+p1).attr("value")+"&crea=yes");
			{rdelim}else{ldelim}
	$("#span"+p1).load("baseyear.ajax.php?year="+p1+"&coun="+$("#coun"+p1).attr("value"));
			{rdelim}
{rdelim}
</script>
