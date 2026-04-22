{include file="_ajax.header.tpl"}
{assign var=menu value='&nbsp;&nbsp;&nbsp;&nbsp;</span><span id="s1" onclick="togg(1);"> осн.данни 
</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="s2" onclick="togg(2);"> редове </span><span>'}
{if $EDIT <= 0}
{*
	{assign var="_title" value='въведи нова сметка '|cat:$MXBILL|cat:' и нова фактура '|cat:$MXINVO|cat:$menu}
*}
	{assign var="_title" value='въведи нова сметка и/или нова фактура '|cat:$menu}
{else}
{*
	{assign var="_title" value='корегирай сметка '|cat:$ROBILL.serial|cat:' и фактура '|cat:$ROBILL.seriinvo|cat:$menu}
*}
	{assign var="_title" value='корегирай фактура/сметка '|cat:$menu}
{/if}
{include file='_window.header.tpl' TITLE=$_title WIDTH=600}
{include file="_erform.tpl"}
<style>
input, textarea, select {ldelim}border: 1px solid silver{rdelim}
.link {ldelim}border-bottom: 1px solid black;cursor:pointer;padding:0px 4px;{rdelim}
.curr {ldelim}border-bottom: 1px solid black;cursor:pointer;padding:0px 4px;background-color:moccasin;{rdelim}
.zone {ldelim}float:left;border:1px solid black;padding:6px;cursor:pointer{rdelim}
.zonecurr {ldelim}background-color:moccasin;{rdelim}
</style>




{*---- общи данни за сметката ----*}
											<div id="d1" style="display:none">
			<table>
{*---- основна зона - номера ----*}
														{if $EDIT <= 0}
											<input type="hidden" name="vari" id="vari"> 
								{if isset($LISTER.vari)}
			<tr>
			<td valign=top colspan=3 class="former">
{$LISTER.vari}
								{else}
								{/if}
			<tr>
			<td valign=top colspan=3 id="isprof">
{*+++++
<div id="zone1" class="zone" onclick="togzon(1);">
<u style="color:red">НОВИ НОМЕРА</u>
<br>
ще бъдат назначени следващите поредни номера
<br>
евентуално сметка <b>{$MXBILL}</b> фактура <b>{$MXINVO}</b>
с дата <b>{$DATE1}</b>
</div>
					{if isset($RESEINVO)}
<div style="float:left">&nbsp;</div>
<div id="zone2" class="zone" onclick="togzon(2);">
<u style="color:red">ЗАПАЗЕНИ НОМЕРА</u>
<br>
ще бъдат назначени поредните запазени номера
<br>
евентуално сметка <b>{$RESEBILL}</b> фактура <b>{$RESEINVO}</b>
с дата <b>{$DATE2}</b>
</div>
					{else}
					{/if}
+++++*}
избери вариант 
{foreach from=$ARCREA item=txcrea key=increa}
&nbsp;&nbsp;
<input type="radio" name="typecrea" value='{$increa}' label="{$txcrea}">
{/foreach}
			{if isset($LISTER.typecrea)}
&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red>{$LISTER.typecrea}</font>
			{else}
			{/if}
{*+++++++++++++++++++++++++++++++*}
			</td>
														{else}
														{/if}
			<tr>
{*---- лява зона ----*}
			<td valign=top>
избери задължено лице 
{include file="_select.tpl" FROM=$ARNAME ID="codename" C1="input" C2="inputer" ONCH="chosen(this);"}
<br>
или попълни данните за друго задължено лице
{*----
		<table>
					<tr>
<td> име
<td> 
<input type="text" name="name" id="name" size=80 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
					<tr>
<td> ЕГН
<td>
<input type="text" name="egn" id="egn" size=20 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}> 
					<tr>
<td> ЕИК
<td>
<input type="text" name="eik" id="eik" size=20 {include file="_erelem.tpl" ID="eik" C1="input" C2="inputer"}> 
					<tr>
<td colspan=2 id="addr"> 
<span id="addrcoun" style="color:red;"></span>
адрес
<br>
<textarea name="address" id="address" rows=3 cols=70></textarea>
					<tr>
<td colspan=2> 
МОЛ за фактурата
<br>
<input type="text" name="toperson" id="toperson" size=60 {include file="_erelem.tpl" ID="toperson" C1="input" C2="inputer"}> 
		</table>
----*}
<br> име
<br> 
<input type="text" name="name" id="name" size=80 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 
<br> 
ЕГН
<input type="text" name="egn" id="egn" size=20 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}> 
&nbsp;&nbsp;&nbsp;&nbsp;
ЕИК
<input type="text" name="eik" id="eik" size=20 {include file="_erelem.tpl" ID="eik" C1="input" C2="inputer"}> 
<br>
<span id="addrcoun" style="color:red;"></span>
адрес
<br>
<textarea name="address" id="address" rows=3 cols=70></textarea>
<br>
МОЛ за фактурата
<br>
<input type="text" name="toperson" id="toperson" size=60 {include file="_erelem.tpl" ID="toperson" C1="input" C2="inputer"}> 

{*---- разделител ----*}
			<td valign=top width=60> &nbsp;
{*---- дясна зона ----*}
			<td valign=top>
<input type="checkbox" name="isvat" id="isvat" label="ДДС">
<br>
дата 
<br>
<input type="text" name="date" id="date" size=14 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
тип фактура 
<br>
									{if $MODIBILL==0}
{include file="_select.tpl" FROM=$ARINVOTYPESELE ID="idinvotype" C1="input" C2="inputer" ONCH="fuprof(this);"}
									{else}
										{if $smarty.post.idinvotype==1}
<b>проформа</b>
<input type="hidden" name="idinvotype" id="idinvotype"> 
										{else}
{include file="_select.tpl" FROM=$ARINVO2SELE ID="idinvotype" C1="input" C2="inputer" ONCH="fuprof(this);"}
										{/if}
									{/if}
		<span id="profno" style="display:none">
				{if $SERIPROFEXIS}
съществуващ номер
				{else}
нов номер
				{/if}
<br>
<input type="text" name="seriprof" id="seriprof" size=14 {include file="_erelem.tpl" ID="seriprof" C1="input" C2="inputer"}> 
		</span>
									{if count($LISTELEM)==0}
<br>
избери шаблон
<br>
{include file="_select.tpl" FROM=$ARTEMP ID="idtemp" C1="input" C2="inputer"}
									{else}
									{/if}
{*---- ----------------------------------------------*}
<br>
<br>
<input type="checkbox" name="isdebtor" id="isdebtor" label="във фактурата да се извежда длъжника" {include file="_erelem.tpl" ID="isdebtor" C1="input" C2="inputer"}> 
<br>
<br>
IBAN на ЧСИ като съставител на фактура/сметка
<br>
{include file="_select.tpl" FROM=$ARSELENAME ID="iban" C1="iban" C2="inputer"}
{*---- ----------------------------------------------*}
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br>
основните данни
			</table>
											</div>

											<div id="d2" style="display:none">
											{if count($LISTELEM)==0}
											{else}

{*---- общи данни за сметката/фактурата ----*}
				<table align=center>
				<tr>
<td> общо 
<td align=right> <b>{$ARSUMA.stot|tomo3}</b>
<td width=30>
<td> платена сума &nbsp;&nbsp; 
<td> <input type="text" name="paid" id="paid" {include file="_erelem.tpl" ID="paid" C1="input7" C2="inputer"}> 
<td>
<td> <font color=red>{$PAIDER}</font>
				<tr>
<td> ддс
<td align=right> <b>{$ARSUMA.svat|tomo3}</b>
<td width=30>
<td> метод на плащане
<td> {include file="_select.tpl" FROM=$ARMETHNAME ID="paidmethod" C1="input7" C2="inputer" ONCH="chuscash();"}
<td width=30>
<td>
{include file='_but2.tpl' TYPE='submit' TITLE='запиши' NAME='subm4' ID='subm4'}
				<tr>
<td> всичко 
<td align=right> <b>{$ARSUMA.suma|tomo3}</b>
<td width=30>
<td rela="uscash"> платено на
<td rela="uscash"> {include file="_select.tpl" FROM=$USERLISTNAME ID="cashiduser" C1="input7" C2="inputer"}
<td>
<td> <font color=red>{$CASHER}</font>
				</table>

{*---- данни за редовете от сметката ----*}
		<table class="d_table" cellspacing='0' cellpadding='0'>
		<tr class='header'>
<td> № </td>
		<td class='sep'>&nbsp;</td>
<td> действие </td>
		<td class='sep'>&nbsp;</td>
<td> осн. </td>
		<td class='sep'>&nbsp;</td>
<td> мат.<br>инт </td>
		<td class='sep'>&nbsp;</td>
<td> проп.<br>такса </td>
		<td class='sep'>&nbsp;</td>
<td> обик.<br>такса </td>
		<td class='sep'>&nbsp;</td>
<td> доп.<br>разнос </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>вземи</td>
		<td class='sep'>&nbsp;</td>
<td>спусни<br>преди</td>
		</tr>
		<tbody>
						
						{counter start=0 print=false}
	{foreach from=$LISTELEM item=elem key=ekey}		
		<tr onmouseover='this.style.backgroundColor="silver";' onmouseout='this.style.backgroundColor="";'>	
<td align=right> {counter} </td>
		<td class='sep'>&nbsp;</td>
{*
<td> {$elem.action|truncate:70:"...":false}</td>
*}
<td> {$elem.action}</td>
		<td class='sep'>&nbsp;</td>			
<td> {$elem.ground}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.interest|tomo3}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$elem.taxprop|tomo3}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$elem.taxregu|tomo3}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$elem.taxaddi|tomo3}</td>
		<td class='sep'>&nbsp;</td>
<td> 
<nobr>
{*
<a href="caseeditzone.php{$elem.deleelem}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
*}
<a href="#" onclick="dele('{$elem.deleelem}'); return false;"><img src="images/free.gif" title="изтрий"></a>
</nobr>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
<input type="radio" name="getme" value="{$elem.id}"> {* {$elem.id} *}
		<td class='sep'>&nbsp;</td>
<td align=center>
<input type="radio" name="putme" value="{$elem.id}" onclick="$('#submmove').click();"> {* {$elem.id} *}
		</tr>
	{/foreach}
</tbody>
		</table>
<input style="display:none;" type="submit" name="submmove" id="submmove">
											{/if}
{*
									{if $MODIBILL==0}
									{else}
*}
{*---- добавяне на нов ред ----*}
<br>
добави ред от тип
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="codetype" C1="input" C2="inputer" ONCH="rowadd(this.value,'no');"}
<br>
<div id="typeform"></div>
{*
									{/if}
*}
											</div>

<script>
var ardata= new Array();
			{foreach from=$ARNAMEDATA item=elem key=code}
ardata["{$code}"]= "{$elem}";
			{/foreach}
function chosen(obje){ldelim}
	var mycode= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	var mydata= ardata[mycode];
//alert(mydata);
	var myar= mydata.split("^");
	$("#egn").attr("value",myar[0]);
	$("#eik").attr("value",myar[1]);
	$("#name").attr("value",myar[2]);
	$("#address").attr("value",myar[3]);
			lipara= {ldelim}para:mycode{rdelim};
			jQuery.ajax({ldelim}
				url: "cazobilladdr.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			{rdelim})
{rdelim}
function fusucc(data){ldelim}
//alert("data="+data);
	var arresu= data.split("^");
	var code= arresu[0];
	var retu= arresu[1];
	if (code=="0"){ldelim}
//		$("#addr").html(retu);
		if (retu==""){ldelim}
$("#addrcoun").html("");
		{rdelim}else{ldelim}
$("#addrcoun").html("има "+retu+" адреса. нужен е само един.<br>");
		{rdelim}
	{rdelim}else{ldelim}
alert(retu);
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
function dele(link){ldelim}
	if(confirm('потвърди изтриването на реда')) window.location.href=link;
{rdelim}
function rowadd(pval,post){ldelim}
	$("#typeform").html("<img src='ajaxload.gif'>");
	$("#typeform").load(encodeURI("cazobilladd.ajax.php?code="+pval+"&post="+post),{ldelim}{rdelim},function() {ldelim}
		resizeNyroModalIframe();
	{rdelim});
{rdelim}
				{if $FLAGER}
rowadd($("#codetype").attr("value"),"yes");
				{else}
				{/if}

function togg(pid){ldelim}
//alert(pid);
	if (pid==1){ldelim}
			$("#s1").addClass("curr").removeClass("link");
			$("#s2").addClass("link").removeClass("curr");
		$("#d1").show();
		$("#d2").hide();
		$(".wclose_normal").bind("click",function(){ldelim}
			nyremo();
		{rdelim});
	{rdelim}else{ldelim}
			$("#s1").addClass("link").removeClass("curr");
			$("#s2").addClass("curr").removeClass("link");
		$("#d1").hide();
		$("#d2").show();
		$(".wclose_normal").bind("click",function(){ldelim}
			$("#subm4").click();
		{rdelim});
	{rdelim}
resizeNyroModalIframe();
{rdelim}

function togzon(pid){ldelim}
//alert(pid);
	if (pid==1){ldelim}
			$("#zone1").addClass("zonecurr");
			$("#zone2").removeClass("zonecurr");
		$("#date").attr("value",'{$DATE1}');
		$("#vari").attr("value",1);
	{rdelim}else{ldelim}
			$("#zone2").addClass("zonecurr");
			$("#zone1").removeClass("zonecurr");
		$("#date").attr("value",'{$DATE2}');
		$("#vari").attr("value",2);
	{rdelim}
{rdelim}

function fuprof(obje){ldelim}
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	if (valu==1){ldelim}
//alert(valu);
		$("#profno").show();
		$("#isprof").hide();
	{rdelim}else{ldelim}
		$("#profno").hide();
		$("#isprof").show();
	{rdelim}
{rdelim}

{***
function nyremo(){ldelim}
////////alert("NYYYYYYYY");
{rdelim}
***}
$(document).ready(function() {ldelim}
{***
	$(".wclose_normal").bind("click",function(){ldelim}
////////parent.document.location.reload();
$("#subm4").click();
	{rdelim});
***}
				{if isset($TOGGPARA)}
	togg({$TOGGPARA});
				{else}
	togg(1);
				{/if}
											{if $EDIT <= 0}
	togzon(1);
											{else}
											{/if}
	fuprof($("#idinvotype"));
{rdelim})

chuscash();
function chuscash(){ldelim}
	var obje= $("#paidmethod");
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
//alert(valu);
	if (valu=="c"){ldelim}
		$("[@rela=uscash]").show();
	{rdelim}else{ldelim}
		$("[@rela=uscash]").hide();
	{rdelim}
{rdelim}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
