{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи ново постъпление'}
{else}
	{assign var='_title' value='корегирай постъпление'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

				{*---- за отключването след exit ----*}
				<font color=red><span id="{$NYREMO.idzone}"></span></font>
				
				<table>
				<tr>
<td>
тип
<br>
		{if $smarty.post.idtype==1 and $ISNOMANUAL}
				{*---- 21.06.2010 - САМО АКО постъплението е банково и е забранено ръчното им въвеждане ----*}
<b>{$ARTYPE[$smarty.post.idtype]}</b>
<input type="hidden" name="idtype" id="idtype">
		{else}
				{*---- ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления ----*}
				{*---- при корекция само извеждаме типа ----*}
{include file="_select.tpl" FROM=$ARTYPENAME ID="idtype" C1="input" C2="inputer" ONCH="typechan();"}
		{/if}

				{*---- 21.10.2010 - доп.поле dateinco = дата на постъпление ----*}
				<td width=10>
<td>
дата на постъпление
<br>
<input type="text" name="dateinco" id="dateinco" size=14 {include file="_erelem.tpl" ID="dateinco" C1="input" C2="inputer"}>

				<tr>
				<td colspan=5>
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
<input type="text" name="serinome" id="serinome" class="input" size=12 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}> 
		{/if}
				<tr>
				<td align=right>
	дата
				<td width=10>
				<td>
<input type="text" name="cashdate" id="cashdate" class="input" size=12 {include file="_erelem.tpl" ID="cashdate" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	вносител
				<td width=10>
				<td>
<input type="text" name="cashname" id="cashname" class="input" size=40 {include file="_erelem.tpl" ID="cashname" C1="input" C2="inputer"}> 
				</table>
</div>
{*------------------ край на контейнера -------------------*}

{*------------------ контейнер за тип=9 директно на взискателя -------------------*}
<div id="t9" class="inputcont" style="display: none; padding: 6px">
			{if isset($CLAIONE)}
				{foreach from=$CLAIONE item=clainame key=claikey}
взискател <b>{$clainame}</b>
<input type="hidden" name="idclaimer" id="idclaimer" value="{$claikey}">
				{/foreach}
			{else}
избери взискател
<br>
{include file="_select.tpl" FROM=$CLAISELENAME ID="idclaimer" C1="input" C2="inputer" ONCH="typechan();"}
			{/if}
</div>
{*------------------ край на контейнера -------------------*}

		<tr>
		<td valign=top>
сума
<br>
				{*---- ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления ----*}
				{*---- за типа банк.постъпление - сумата не може да се променя ----*}
					{* 
					21.10.2010 Бургас - не може да се корегират банк.постъпления 
					доп.уточнение - да може само ако има запис в табл. finasource 
				{if $smarty.post.idtype==1}
					*}
				{if $ISSOURCE}
					{assign var=incoch value="nochange(this,'"|cat:$smarty.post.inco|cat:"');"}
					{assign var=incobl value="this.value='"|cat:$smarty.post.inco|cat:"';"}
{*
<b>{$smarty.post.inco}</b>
<input type="hidden" name="inco" id="inco">
*}
				{else}
				{/if}
<input type="text" name="inco" id="inco" size=12 {include file="_erelem.tpl" ID="inco" C1="input" C2="inputer"}
onfocus="{$incoch}" onkeydown="{$incoch}" onblur="{$incobl}"> 
{*----
{if count($CLAILIST)==1}onkeyup="kres();"{else}{/if}
----*}
{*---- 03.11.2009 - от името на кой длъжник е постъплението  ----*}
						{if $ISSETCASE}
		<td>
		<td valign=top>
от името на кой длъжник
<br>
{include file="_select.tpl" FROM=$ARDEBTNAME ID="iddebtor" C1="input" C2="inputer" ONCH="putcashname(true);"}
						{else}
						{/if}
		</table>
	
описание {if isset($LISTER.descrip)}<font color=red>{$LISTER.descrip}</font>{/if}
<br>
<textarea class="input" name="descrip" id="descrip" rows=4 cols=50></textarea>
		{if $CALLFROMCASE}
			{assign var=postcase value=$smarty.post.idcase}
<input type="hidden" name="idcase" id="idcase" value="{$postcase}"> 
			{if empty($postcase)}
			{else}
<br>
дело <b>{$postcase}</b>
<br>
			{/if}
		{else}
<br>
дело
<br>
<input type="text" name="idcase" id="idcase" size=12 {include file="_erelem.tpl" ID="idcase" C1="input" C2="inputer"}> 
{*---- 03.11.2009 - от името на кой длъжник е постъплението  ----*}
{*----
<br>
от името на кой длъжник
<br>
{include file="_select.tpl" FROM=$ARDEBTNAME ID="iddebtor" C1="input" C2="inputer"}
----*}
		{/if}
				{if empty($smarty.post.idcase) or isset($LISTER.idcase)}
<br>
				{else}
		<fieldset class="filtgr" id="zonedist">
		<legend align=right> разпределение на постъплението </legend>
{*----
за ЧСИ
<br>
<input type="text" name="separa" id="separa" size=20 {include file="_erelem.tpl" ID="separa" C1="input" C2="inputer"}
{if count($CLAILIST)==1}onkeyup="kres();"{else}{/if}
> 
----*}
		<div style="float:left;width:49%">
за ЧСИ неолихв.суми
<br>
{*
<input type="text" name="separa" id="separa" size=20 {include file="_erelem.tpl" ID="separa" C1="input" C2="inputer"}
onkeyup="jourdata();"
> 
*}
<input type="text" name="separa" id="separa" size=12 {include file="_erelem.tpl" ID="separa" C1="input" C2="inputer"}
onkeyup="jourdata();" {include file="finaeditc2.tpl" FINAME="separa"}
> 
		</div>
		<div style="float:left;width:49%">
за ЧСИ т.26
<br>
<input type="text" name="separa2" id="separa2" size=12 {include file="_erelem.tpl" ID="separa2" C1="input" C2="inputer"}
onkeyup="jourdata();" {include file="finaeditc2.tpl" FINAME="separa2"}
> 
		</div>
{*----------------*}
	{*---- сумите по взискатели ----*}
	{if count($CLAILIST)==0}
<br>
няма взискатели
	{else}
		{foreach from=$CLAILIST item=clainame key=idclai}
			{assign var=claipostname value=$CLAIPREF|cat:$idclai}
			{assign var=claiposttaxname value=$CLAITAXPREF|cat:$idclai}
<br>
за взискател {$clainame}
<br>
{*
<input type="text" name="{$claipostname}" id="{$claipostname}" size=12 {include file="_erelem.tpl" ID=$claipostname C1="input" C2="inputer"}
{if count($CLAILIST)==1}id="claiam"{else}{/if} {include file="finaeditc2.tpl" FINAME=$claipostname}
{if $ISBANKTAX}onkeyup="moditax('{$claipostname}');creasum(); return true;"{else}{/if}
> 
*}
<input type="text" name="{$claipostname}" id="{$claipostname}" size=12 {include file="_erelem.tpl" ID=$claipostname C1="input" C2="inputer"}
{include file="finaeditc2.tpl" FINAME=$claipostname}
{if $ISBANKTAX}onkeyup="moditax('{$claipostname}');creasum(); return true;"{else}{/if}
> 
{*
{if count($CLAILIST)==1}
<script>
var claiamname= "{$claipostname}";
</script>
{else}
{/if} 
*}
					{if $ISBANKTAX}
&nbsp;&nbsp;&nbsp;&nbsp;
<span class="inp7bold">банк.такса</span>
<input type="text" name="{$claiposttaxname}" id="{$claiposttaxname}" size=4 {include file="_erelem.tpl" ID=$claiposttaxname C1="inp7bold" C2="inputer"}
{if $ISBANKTAX}onkeyup="creasum(); return true;"{else}{/if}
>
					{else}
					{/if}
		{/foreach}
	{/if}
	{*---- сума за връщане ----*}
<br>
{*
		<div style="float:left;width:49%">&nbsp;</div>
		<div style="float:left;width:49%">
*}
за връщане
<br>
<input type="text" name="back" id="back" size=12 {include file="_erelem.tpl" ID="back" C1="input" C2="inputer"}
onkeyup="jourdata();" {include file="finaeditc2.tpl" FINAME="back"}
{if $ISBANKTAX}onkeyup="moditax('back');creasum(); return true;"{else}{/if}
> 
					{if $ISBANKTAX}
&nbsp;&nbsp;&nbsp;&nbsp;
<span class="inp7bold">банк.такса</span>
<input type="text" name="backtax" id="backtax" size=4 {include file="_erelem.tpl" ID="backtax" C1="inp7bold" C2="inputer"}
{if $ISBANKTAX}onkeyup="creasum(); return true;"{else}{/if}
>
					{else}
					{/if}
{*
		</div>
*}
	{*---- общо разпределено ----*}
	{if isset($DISTTOTA)}
<br>
{*
<center>
*}
общо разпределена сума <b>{$DISTTOTA|tomoney:2}</b>
{*
</center>
*}
	{else}
	{/if}
					{if $ISBANKTAX}
<br>
{*
<center id="sumatota" style="font: bold 8pt verdana; padding: 2px; background-color:khaki;"></center> 
*}
<div align=right id="sumatota"></div> 
					{else}
					{/if}
		</fieldset>
{*---- текстове за автоматично попълване на дневника изв.действия ----*}
{*
		<fieldset class="filtgr" id="zonejour" style="display:none">
		<legend align=right> за дневника на изв.действия </legend>
начислени такси по точка 
<input type="text" name="jourtext1" id="jourtext1" size=10 {include file="_erelem.tpl" ID="jourtext1" C1="input" C2="inputer"}>
от ТТР към ЗЧСИ
<br>
задължено лице
<input type="text" name="jourtext2" id="jourtext2" size=40 {include file="_erelem.tpl" ID="jourtext2" C1="input" C2="inputer"}>
		</fieldset>
*}
				{/if}

{*---- 28.01.2010 заради динамично преизчисляване на погасяването ----*}
дата за погасяване
<br>
<input type="text" name="datebala" id="datebala" size=14 {include file="_erelem.tpl" ID="datebala" C1="input" C2="inputer"}
	
{*---- 13.05.2010 причина за нарушаване на интервала от админа ----*}
			{if $ISREASON or $ISRE2}
<br>
<br>
причина за нарушаване на {if $EDIT==0 or $ISRE2}{$FINAINTE}{else}{$DATAREAS.finainterval}{/if}-дневен интервал 
	{if $EDIT==0}
	{else}
<br>
въведена от {$ADMINAME} на {$DATAREAS.time|date_format:'%d.%m.%Y %H:%M:%S'}
	{/if}
{if isset($LISTER.reason)}<br><font color=red>{$LISTER.reason}</font>{/if}
<br>
				{if $ADMINLOGGED}
<textarea class="input" name="reason" id="reason" rows=4 cols=50></textarea>
				{else}
<b>{$ADMITEXT}</b>
				{/if}
			{else}
			{/if}

{*---- бутоните ----*}
<br>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				{*---- ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления ----*}
				{*---- премахваме бутона за директно изтриване, понеже не минава през проверка ----*}
{*----
			{if $CALLFROMCASE}
			{else}
{include file='_button.tpl' ONCLICK="document.location.href='$DELELINK';return false;" TITLE='изтрий това постъпление' NAME='deleget' ID='deleget'}
			{/if}
----*}
	{if isset($SUBMIT2)}
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши с несъвпадение' NAME='submit2' ID='submit2'}
	{else}
	{/if}
<br>

{*---- динамично зареждане на банк.такси и общата сума ----*}
					{if $ISBANKTAX}
<script type="text/javascript">
var arfiel= new Array();
{foreach from=$ARFIEL item=artaxname key=arname}
arfiel["{$arname}"]= "{$artaxname}";
{/foreach}
var artota= new Array();
artota.push("separa");
artota.push("separa2");
{foreach from=$ARFIEL item=artaxname key=arname}
artota.push("{$arname}");
artota.push("{$artaxname}");
{/foreach}
function moditax(name){ldelim}
	var cuva= $("#"+name).attr("value");
	var tana= arfiel[name];
	var resu;
{*
//flag= cuva=="";
//alert(flag);
//cont= parseFloat(cuva)+0==0;
//alert(cont);
//alert('['+cuva+']'+'/'+isNaN(cuva));
//alert(name+'/'+tana+'/'+parseFloat(cuva));
	if (cuva==""){ldelim}
//alert("EMPTY");
		resu= "empty";
	{rdelim}else if (parseFloat(cuva)==0){ldelim}
//alert("EMPTY2");
*}
	if (cuva=="" || parseFloat(cuva)==0){ldelim}
		resu= "";
	{rdelim}else{ldelim}
		if ($("#"+tana).attr("value")==""){ldelim}
			resu= "{$BANKTAX}";
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	$("#"+tana).attr("value",resu);
{rdelim}
function creasum(name){ldelim}
				var suma= 0;
	var arin, cuva;
	for (arin in artota){ldelim}
		cuva= $("#"+artota[arin]).attr("value");
				suma += parseInt(100*cuva);
//alert(arin+'/'+artota[arin]+'/'+cuva+'/'+suma);
	{rdelim}
//	sumacont= parseFloat(parseFloat(0.01*suma).toFixed(2));
	sumacont= parseFloat(0.01*suma).toFixed(2);
	if (sumacont==0){ldelim}
		sumacont= "няма ";
	{rdelim}else{ldelim}
	{rdelim}
	$("#sumatota").html(sumacont+" разпределени");
{rdelim}
var arna;
for (arna in arfiel){ldelim}
	moditax(arna);
{rdelim}
creasum();
</script>
					{else}
					{/if}

{*
{if count($CLAILIST)==1}
<script>
function kres(){ldelim}
	var obinco= document.getElementById("inco");
	var obsepa= document.getElementById("separa");
//	var obclai= document.getElementById("claiam");
	var obclai= document.getElementById(claiamname);
//	var resu= parseFloat(obinco.value)-parseFloat(obsepa.value);
		var vainco= (obinco.value=="") ? 0 : parseFloat(obinco.value);
		var vasepa= (obsepa.value=="") ? 0 : parseFloat(obsepa.value);
	var resu= vainco - vasepa;
		resu= 100*resu;
		resu= Math.round(resu);
		resu= resu/100;
alert(resu);
	obclai.value= resu;
{rdelim}
</script>
{else}
{/if}
*}

{*---- скрипт за скриване/показване според типа ----*}
<script type="text/javascript">
function typechan(){ldelim}
	var obtype= document.getElementById("idtype");
	var obcont= document.getElementById("t2");
	var obdebt= document.getElementById("t9");
	var obdist= document.getElementById("zonedist");
			if (obtype.value==2){ldelim}
				obcont.style.display= "block";
				obdebt.style.display= "none";
						if (obdist){ldelim}
				obdist.style.display= "block";
						{rdelim}else{ldelim}
						{rdelim}
				resizeNyroModalIframe();
			{rdelim}else if (obtype.value==9){ldelim}
				obcont.style.display= "none";
				obdebt.style.display= "block";
						if (obdist){ldelim}
				obdist.style.display= "none";
						{rdelim}else{ldelim}
						{rdelim}
				resizeNyroModalIframe();
			{rdelim}else{ldelim}
				obcont.style.display= "none";
				obdebt.style.display= "none";
						if (obdist){ldelim}
				obdist.style.display= "block";
						{rdelim}else{ldelim}
						{rdelim}
				resizeNyroModalIframe();
			{rdelim}
jourdata();
{rdelim}
typechan();
jourdata();
putcashname(false);

var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
chancrea();
function chancrea(){ldelim}
	if (obje.checked){ldelim}
		obente.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obente.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
function jourdata(){ldelim}
			{if $ISBANKTAX}
	creasum();
			{else}
			{/if}
{rdelim}
function putcashname(flagdire){ldelim}
//	$('#cashname').attr('value',obde.get(0).options[obde.get(0).selectedIndex].text);
	var obde= $("#iddebtor");
	var cana= $('#cashname').attr('value');
					var myflag= false;
	if (flagdire){ldelim}
					myflag= true;
	{rdelim}else{ldelim}
		if (cana==""){ldelim}
					myflag= true;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (myflag){ldelim}
		$('#cashname').attr('value',obde.get(0).options[obde.get(0).selectedIndex].text);
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
</script>

				{*---- ВНИМАНИЕ. 17.02.2010 - ограничаваме корекциите на банкови постъпления ----*}
				{*---- за типа банк.постъпление - сумата не може да се променя ----*}
<script type="text/javascript">
function nochange(obje,valu){ldelim}
//	alert('съдържанието '+valu+' не може да се променя');
//	obje.value= valu;
	obje.blur();
return false;
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
