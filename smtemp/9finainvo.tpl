<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<style>
{*
td {ldelim}font: normal 8pt verdana;{rdelim}
*}
.head {ldelim}font: bold 7pt verdana; background-color:#bbbbbb;{rdelim}
.cell {ldelim}font: bold 7pt verdana; background-color:#dddddd;{rdelim}
.c1link {ldelim}font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
.zero {ldelim}font: normal 8pt verdana; background-color:#ff9999; padding: 2px 8px;{rdelim}
{*
.mark {ldelim}font: normal 8pt verdana; background-color:lightgreen; padding: 2px 8px;{rdelim}
*}
.mark {ldelim}font: normal 8pt verdana; background-color:red;color:white; padding: 2px 8px;{rdelim}
.p1 {ldelim}font: normal 8pt verdana;{rdelim}
.p1:hover {ldelim}color:red;border-bottom: 1px solid red;{rdelim}
.suma {ldelim}background-color:#d5e2f2;color:red;{rdelim}
.dateinvo {ldelim}font:normal 7pt verdana;border:0px solid black; color:black;{rdelim}
</style>
<script>
var linklist= new Array();
</script>
<style>
.h2 {ldelim}font: normal 8pt verdana; background-color:#bbbbbb;{rdelim}
.r2 {ldelim}font: normal 8pt verdana; border-bottom:1px solid black;{rdelim}
</style>

						{if $ISYEARLIST}
<div class='tabs_line' >
	<table class='tabs' cellspacing='0' cellpadding='0' border='0' >
	<tr>
	{foreach from=$YEARLIST item=elem key=ekey}
		<td class='tabs_sep'>&nbsp;</td> 
		{if $YEAR==$ekey}
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span>{$ekey}</span></td>
			<td class='tabs_right_selected'></td>
		{else}	
			<td onclick='document.location.href="{$elem}"' class='tabs_left'></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_middle'><span>{$ekey}</span></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_right'></td>
		{/if}
	{/foreach}
	</tr>
	</table>
</div>
						{else}
						{/if}

				{if isset($CLAILIST)}
					<table align=center>
					<tr>
					<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> взискатели {$TEXTHEAD}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$CLAICREA}" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
						<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
				{foreach from=$CLAILIST item=elem}
						<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
<td class="r2"> 
<a href="{$elem.claimodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				{/foreach}
						</table>
					<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> длъжници {$TEXTHEAD}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$DEBTCREA}" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='добави'}><a>
						<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
<td class="h2"> &nbsp;
				{foreach from=$DEBTLIST item=elem}
						<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
<td class="r2"> 
<a href="{$elem.debtmodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				{/foreach}
						</table>
					</table>
				{else}
				{/if}

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='40'>
<div style="float:left;">
списък на фактурите {$TEXTHEAD}
&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="images/word.gif" title="изведи целия списък" style="cursor:pointer"
				onclick="fuprin('{$WORDLINK}'); return false;">
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$CREALINK}" class='nyroModal' target='_blank'>
<img src="images/adda.gif" title='запази номера'}><a>
{*
&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="$CREATE" CLASS='nyroModal' TARGET='_blank' TITLE='запази'}
	<span style="font:normal 8pt verdana; color:black;">
	празни сметки и фактури
	</span>
*}
															{if isset($YEMO)}
															{else}
<br>
<div class="dateinvo" style="float:left;padding-left:70px;">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
	&nbsp;&nbsp;&nbsp;
	въведи дело/год
	<input type=text name="seyeinvo" id="seyeinvo" size=14  class="dateinvo" onkeyup="autosubm2(event,this);"> +enter
	<span id="err2" style="color:red"></span>
	&nbsp;&nbsp;&nbsp;
<br>
	въведи получател
	<input type=text name="nameinvo" id="nameinvo" size=14  class="dateinvo" onkeyup="autosubm3(event,this);"> +enter
	<span id="err3" style="color:red"></span>
	избери тип
	{include file="_select.tpl" FROM=$ARTYPESELE ID="idinvotype" C1="input7" C2="inputer" ONCH="autosubm4(event,this);"} +enter
</div>
															{/if}
</div>
						{if $ISADDCASE}
<div style="float:right;">
{include file='_button.tpl' HREF="$ADDNEWBILL" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
	<span style="font:normal 7pt verdana; color:black;">
	<br> сметка и фактура
	<br> за делото
	</span>
</div>
						{else}
<div style="float:right;">
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
	<span style="font:normal 7pt verdana; color:black;">
	<br> фактура без сметка
	<br> и несвързана с дело
	</span>
</div>
						{/if}
		</thead>
		<tr class='header'>
<td> #факт
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fupringrou(); return false;"> 
<img src="images/print.gif" title="отпечати маркираните фактури">
</a>
		<td class='sep'>&nbsp;</td>	
<td> дата
		<td class='sep'>&nbsp;</td>	
<td> сума
		<td class='sep'>&nbsp;</td>	
<td> втч<br>ДДС
		<td class='sep'>&nbsp;</td>	
<td> получател
		<td class='sep'>&nbsp;</td>	
<td> платено
		<td class='sep'>&nbsp;</td>	
<td> метод
		<td class='sep'>&nbsp;</td>	
<td> тип
		<td class='sep'>&nbsp;</td>	
<td> #про<br>форма
		<td class='sep'>&nbsp;</td>	
<td> длъж
		<td class='sep'>&nbsp;</td>	
<td> IBAN
		<td class='sep'>&nbsp;</td>	
<td> #смет
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fupringroubill(); return false;"> 
<img src="images/print.gif" title="отпечати маркираните сметки">
</a>
		<td class='sep'>&nbsp;</td>	
<td> дело
		<td class='sep'>&nbsp;</td>	
<td> деловодител
		<td class='sep'>&nbsp;</td>	
<td> взи<br>скат
		<td class='sep'>&nbsp;</td>	
<td> &nbsp;
{*
		<td class='sep'>&nbsp;</td>	
<td> реда
*}

<tbody>
{foreach from=$LIST item=elem key=ekey}
								{assign var="myinvo" value=$elem.id}
{*
										{if $myinvo==0}
										{if !$ISADDCASE}
*}
										{if isset($elem.diff)}
											{if $ISNODIFF}
											{else}
		<tr>
<td colspan=40> <font color=red> {$elem.diff} незаети номера </font>
											{/if}
										{elseif isset($elem.diffyear)}
											{if $ISNODIFF}
											{else}
		<tr>
<td colspan=40> <font color=red> {$elem.diffyear} номера заети с дати от друга година </font>
											{/if}
										{elseif isset($elem.diffdate)}
											{if $ISNODIFF}
											{else}
		<tr>
<td colspan=40> <font color=red> {$elem.diffdate} номера заети с дати извън периода </font>
											{/if}
										{else}
		{*
		<tr id="row{$myinvo}" onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
		*}
		<tr>
{***
<td align=right>
					{if empty($elem.seriinvo)}
&nbsp;
					{else}
{$elem.seriinvo}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="корегирай"></a>

					{/if}
***}
{*****
<td class="c1link" align=right title="корегирай номер фактура"> 
<a href="{$elem.seriinvoedit}" class="nyroModal" target="_blank">{$elem.seriinvo}</a>
*****}
<td class="c1link" align="right" onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.seriinvoedit}'{rdelim});"
title="корегирай номер фактура" > {$elem.seriinvo}
		<td class='sep'>&nbsp;</td>	
<td> 
<nobr>
<a href="#" onclick="fuprin('{$elem.prin}'); return false;"> 
<img src="images/print.gif" title="отпечати фактура">
</a>
<input type=checkbox id="{$elem.prntcode}">
</nobr>

{*
[{$ekey}][{$myinvo}]
*}
		<td class='sep'>&nbsp;</td>	
<td> {$elem.date|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>	
					{if $elem.suma==0}
<td id="suma{$myinvo}" align=right class="zero"> нула
					{else}
<td id="suma{$myinvo}" align=right> {$elem.suma|tomo3}
					{/if}
		<td class='sep'>&nbsp;</td>	
{*
<td> {if $elem.isvat==0}&nbsp;-{else}да{/if}
*}
<td id="svat{$myinvo}" align=right> {$elem.svat|tomo3}
		<td class='sep'>&nbsp;</td>	
<td> {$elem.name}
		<td class='sep'>&nbsp;</td>	
<td align=right class="{if $elem.paid>$elem.suma}zero{elseif $elem.paid<$elem.suma}mark{else}{/if}"> {$elem.paid|tomo3}
		<td class='sep'>&nbsp;</td>	
<td> 
				{if $elem.paidmethod=="c"}
<font color=blue>{$ARMETH[$elem.paidmethod]} на 
{if empty($elem.cashname)}<span style="background-color:red;color:white;">????????</span>{else}{/if}
{$elem.cashname}</font>
				{else}
{$ARMETH[$elem.paidmethod]}
				{/if}
		<td class='sep'>&nbsp;</td>	
<td> {$ARINVOTYPE[$elem.idinvotype]}
						{*---- спец.за кред.известие----*}
						{if $elem.idinvotype==2}
<br>
към фактура 
				{if empty($elem.credmess)}
					{assign var=cmtext value="??????"}
					{assign var=cmclas value="mark"}
				{else}
					{assign var=cmtext value=$elem.credmess}
					{assign var=cmclas value="c1link"}
				{/if}
<br>
<span class="{$cmclas}" style="cursor:pointer;" title="корегирай фактурата" 
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editcredmess}'{rdelim});">
{$cmtext}</span>
						{else}
						{/if}
		<td class='sep'>&nbsp;</td>	
<td> 
<nobr>
{$elem.seriprof}
			{if $elem.seriprof==0 or $elem.idinvotype<>1}
			{else}
<a href="{$elem.proftonorm}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="трансформирай във фактура"></a>
			{/if}
</nobr>
		<td class='sep'>&nbsp;</td>	
<td align=center> {if $elem.isdebtor==0}&nbsp;{else}да{/if}
		<td class='sep'>&nbsp;</td>	
<td title="{$ARACCO[$elem.iban]}"> {$elem.iban}
					{if $elem.serial==0}
		<td class='sep'>&nbsp;</td>	
<td colspan=7> 
{*---- иконите за фактура извън дело ----*}
<nobr>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай фактурата"></a>
<a href="#" onclick="dele6('{$elem.id}'  ,'{if $elem.suma+0==0}0.00{else}{$elem.suma|tomo3}{/if}','{$elem.coun}'); return false;">
<img src="images/free.gif" title="изтрий фактурата"></a>
<span id="coun{$myinvo}" align=right class="c1link" onclick="toggle('{$myinvo}');"> {if $elem.coun==0}няма редове{else}{$elem.coun} реда{/if}
</span>
</nobr>
<script>
linklist['{$myinvo}']= "{$elem.view}";
</script>
					{else}
		<td class='sep'>&nbsp;</td>	
{*
<td> 
{$elem.seribill}/{$elem.date|date_format:"%d.%m.%Y"}
*}
{*****
<td class="c1link" align=right title="корегирай номер сметка"> 
<a href="{$elem.seribilledit}" class="nyroModal" target="_blank">{$elem.seribill}</a>
*****}
<td class="c1link" align="right" onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.seribilledit}'{rdelim});"
title="корегирай номер сметка" > {$elem.seribill}
		<td class='sep'>&nbsp;</td>	
<td> 
				{if $elem.name==""}
&nbsp;
				{else}
<nobr>
<a href="#" onclick="fuprin('{$elem.prinbill}'); return false;"> 
<img src="images/print.gif" title="отпечати сметка">
</a>
<input type=checkbox id="{$elem.prntcodebill}">
</nobr>
				{/if}
		<td class='sep'>&nbsp;</td>	
<td> 
				{if $elem.idcase==0}
&nbsp;
				{else}
{$elem.caseseri}/{$elem.caseyear}
				{/if}
		<td class='sep'>&nbsp;</td>	
<td> 
{$elem.username}
		<td class='sep'>&nbsp;</td>	
						{assign var="myid" value=$elem.id}
<td align=center class="ttip" rel="#clai{$myid}" title="взискатели" style="cursor:help;"> 
<span style="background-color:#dddddd;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="clai{$myid}" style="display: none">
{foreach from=$ARCLAI[$elem.idcase] item=clainame}
	{$clainame}<br>
{/foreach}
</span>
{***
<td> 
{foreach from=$ARCLAI[$elem.idcase] item=clainame}
	{$clainame}<br>
{/foreach}
***}
					{/if}

		<td class='sep'>&nbsp;</td>	
<td> 
{*---- иконите за сметка/фактура по дело ----*}
					{if $elem.serial==0 or $elem.name==""}
					{else}
<nobr>
<a href="{$elem.modibill}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай фактурата/сметката"></a>
<a href="#" onclick="dele6('{$elem.id}'  ,'{if $elem.suma+0==0}0.00{else}{$elem.suma|tomo3}{/if}','{$elem.coun}'); return false;">
<img src="images/free.gif" title="изтрий фактурата/сметката"></a>
</nobr>
					{/if}
{*---- допълнителен ред ----*}
		<tr id='tr{$myinvo}' style="display:none">
<td id='td{$myinvo}' colspan=40 align=left bgcolor="">
</td>
										{*--- {if $myinvo==0} ---*}
										{/if}
		</tr>
{/foreach}

{*---- общо за годината ----*}
		<tr class="suma">
{*
<td colspan=5> общо за периода
*}
<td colspan=5> общо за целия списък
		<td class='sep'>&nbsp;</td>	
<td align=right> {$ARSUYEAR.suma|tomo3}
		<td class='sep'>&nbsp;</td>	
<td align=right> {$ARSUYEAR.svat|tomo3}
		<td class='sep'>&nbsp;</td>	
<td colspan=30> &nbsp;

{include file="_pagina.tr.tpl"}
		</table>

<script type="text/javascript">
{*
$(document).ready(function() {ldelim}
	$('.prin').cluetip({ldelim} 
width:150,local:true,cursor:'pointer',  sticky:true,mouseOutClose:true,  closePosition:"title",closeText:"x", arrows:true
	{rdelim});
	$('.pringrou').cluetip({ldelim} 
width:150,local:true,cursor:'pointer',  sticky:true,mouseOutClose:true,  closePosition:"title",closeText:"x", arrows:true
	{rdelim});
{rdelim});
*}
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 260, local:true, cursor:'pointer' {rdelim});
{rdelim});
function toggle(pid){ldelim}
//alert(pid);
	var trobje= document.getElementById("tr"+pid);
	var tdobje= document.getElementById("td"+pid);
	var curdis= (trobje.style.display=="");
	if (curdis){ldelim}
		trobje.style.display= "none";
		$(tdobje).html("");
	{rdelim}else{ldelim}
		trobje.style.display= "";
		refresh(pid);
	{rdelim}
{rdelim}
function refresh(pid){ldelim}
	var tdobje= document.getElementById("td"+pid);
	var mylink= linklist[pid];
	$(tdobje).html("<img src='ajaxload.gif'>");
	$(tdobje).load(mylink);
{rdelim}
function refrow(pid){ldelim}
	jQuery.ajax({ldelim}
		url: "finainvorefr.ajax.php?p="+pid
		,success: succ4
		{rdelim});
{rdelim}
function succ4(data){ldelim}
//alert(data);
	var arre= data.split("^");
	var pid= arre[0];
	var suma= arre[1];
	var svat= arre[2];
	var coun= arre[3];
	var objesuma= document.getElementById("suma"+pid);
	var objesvat= document.getElementById("svat"+pid);
	var objecoun= document.getElementById("coun"+pid);
	if (suma==""){ldelim}
		objesuma.className= "zero";
		objesuma.innerHTML= "нула";
	{rdelim}else{ldelim}
		objesuma.className= "";
		objesuma.innerHTML= suma;
	{rdelim}
	if (svat==""){ldelim}
		objesvat.innerHTML= "";
	{rdelim}else{ldelim}
		objesvat.innerHTML= svat;
	{rdelim}
	if (coun==""){ldelim}
		objecoun.innerHTML= "няма редове";
	{rdelim}else{ldelim}
		objecoun.innerHTML= coun+" реда";
	{rdelim}
{rdelim}
</script>


<script>
function dele6(pid  ,psum,pcou){ldelim}
	var text= 'потвърди изтриването на фактура/сметка'
	+String.fromCharCode(10)+'на стойност '+psum+' лв';
		if (pcou+0==0){ldelim}
		{rdelim}else{ldelim}
	text += String.fromCharCode(10)+'заедно с нейните '+pcou+' реда';
		{rdelim}
		if (confirm(text)){ldelim}
jQuery.ajax({ldelim}
	url: "finainvodele.ajax.php?p="+pid
	,success: succ6
{rdelim});
		{rdelim}else{ldelim}
		{rdelim}
{rdelim}
function succ6(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
		document.location.href= '{$LINKREFR}';
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

function autosubminvo(event,obinpu){ldelim}
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
		if (obinpu.value==""){ldelim}
		{rdelim}else{ldelim}
			lipara= {ldelim}date:obinpu.value,modeel:"{$MODEEL}"{rdelim};
			jQuery.ajax({ldelim}
				url: "finainvodate.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			{rdelim})
		{rdelim}
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
function fusucc(data){ldelim}
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){ldelim}
		$("#error").text("");
document.location.href= arresu[1];
	{rdelim}else{ldelim}
		$("#error").text(arresu[1]);
	{rdelim}
{rdelim}

function autosubm2(event,obinpu){ldelim}
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
		if (obinpu.value==""){ldelim}
		{rdelim}else{ldelim}
			lipara= {ldelim}seye:obinpu.value,modeel:"{$MODEEL}"{rdelim};
			jQuery.ajax({ldelim}
				url: "finainvoseye.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc2
			{rdelim})
		{rdelim}
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
function fusucc2(data){ldelim}
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){ldelim}
		$("#err2").text("");
document.location.href= arresu[1];
	{rdelim}else{ldelim}
		$("#err2").text(arresu[1]);
	{rdelim}
{rdelim}

function autosubm3(event,obinpu){ldelim}
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
		if (obinpu.value==""){ldelim}
		{rdelim}else{ldelim}
			lipara= {ldelim}name:obinpu.value,modeel:"{$MODEEL}"{rdelim};
			jQuery.ajax({ldelim}
				url: "finainvoname.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc3
			{rdelim})
		{rdelim}
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
function fusucc3(data){ldelim}
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){ldelim}
		$("#err3").text("");
document.location.href= arresu[1];
	{rdelim}else{ldelim}
		$("#err3").text(arresu[1]);
	{rdelim}
{rdelim}

function autosubm4(event,obinpu){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//	if (code==13){ldelim}
//		if (obinpu.value==""){ldelim}
//		{rdelim}else{ldelim}
			lipara= {ldelim}type:obinpu.value,modeel:"{$MODEEL}"{rdelim};
			jQuery.ajax({ldelim}
				url: "finainvotype.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc4
			{rdelim})
//		{rdelim}
return false;
//	{rdelim}else{ldelim}
//return true;
//	{rdelim}
{rdelim}
function fusucc4(data){ldelim}
//alert("data="+data);
	var arresu= data.split("^");
	var code= arresu[0];
	if (code=="ok"){ldelim}
document.location.href= arresu[1];
	{rdelim}else{ldelim}
alert(data);
	{rdelim}
{rdelim}

{*---- група фактури  ----*}
var currid;
function fupringrou(){ldelim}
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
//			lico += list[i].id+"/";
			currid= list[i].id;
			if (currid.substr(0,4)!="bill"){ldelim}
				lico += currid+"/";
			{rdelim}else{ldelim}
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (lico==""){ldelim}
	{rdelim}else{ldelim}
//alert(type+'==='+lico);
//alert(lico);
		fuprin("finainvoprnt.ajax.php?para="+lico);
	{rdelim}
{rdelim}

{*---- група сметки ----*}
function fupringroubill(){ldelim}
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
//			lico += list[i].id+"/";
			currid= list[i].id;
			if (currid.substr(0,4)=="bill"){ldelim}
				lico += currid+"/";
			{rdelim}else{ldelim}
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (lico==""){ldelim}
	{rdelim}else{ldelim}
//alert(type+'==='+lico);
//alert(lico);
		fuprin("finab2prnt.ajax.php?para="+lico);
	{rdelim}
{rdelim}

$(document).ready(function() {ldelim}
	$(".wclose_normal").bind("click",function(){ldelim}
parent.$('#{$URLREFRESH}').click();
	{rdelim});
{rdelim})
</script>
