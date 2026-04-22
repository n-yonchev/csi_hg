<style>
.finahistno {ldelim}font:bold 7pt verdana;background-color:red;color:white;padding:1px 8px 1px 8px;cursor:pointer;{rdelim}
</style>
<style>
.stat1 {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:thistle;{rdelim}
.stat2aaa {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:magenta;{rdelim}
.stat2ok {ldelim}font:bold 7pt verdana;color:white;{rdelim}
.he4 {ldelim}cursor:help;font:bold 7pt verdana;padding:1px 6px; background-color:silver;{rdelim}
.ro4 {ldelim}cursor:help;font:normal 7pt verdana;border-bottom: 1px solid silver;{rdelim}
</style>
{*----
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
----*}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
постъпления
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#tpaymlink').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
</div>
{***
			{if $FLAGNOCHANGE}
***}
			{if $FLAGNOCHANGE and ! ($FINALOGGED or $FLAGCASHONLY)}
			{else}
<div class='d_table_button' style="float:right">
<a href="caseeditzone.php{$GRDIST}" class="nyroModal" target="_blank"><img src="images/grdist.gif" title="групово разпределяне"></a>
&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
			{/if}
		</tr>
	</thead>
		<tr class='header'>
<td align=center>
<a href="#" onclick="fuprinfinaall();return false;"><img src="images/print.gif" title="отпечати всички"></a>
{*
<img src="images/print.gif" title="отпечати всички" style="cursor:pointer" onclick="fup2('{$elem.prntcode}/');">
*}
	<td class='sep'>&nbsp;</td>
<td> сума </td>
	<td class='sep'>&nbsp;</td>
<td> тип </td>
	<td class='sep'>&nbsp;</td>
<td> длъжник </td>
	<td class='sep'>&nbsp;</td>
<td> още </td>
	<td class='sep'>&nbsp;</td>
<td> исто<br>рия </td>
{*----
				{if $FLAGNOCHANGE}
----*}
				{*---- финансиста да може да корегира постъпленията от тази зона в делото ----*}
{*
				{if $FLAGNOCHANGE and !$FINALOGGED}
				{else}
*}
	<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
{*
				{/if}
*}
	<td class='sep'>&nbsp;</td>
<td> нераз<br>пред </td>
	<td class='sep'>&nbsp;</td>
{*---- 24.01.2024 бутон за принтиране на готовите преводи ----*}
<td align=center> <img src="images/print.gif" title="отпечати всички"> </td>
	<td class='sep'>&nbsp;</td>
<td> при<br>ключ </td>
	<td class='sep'>&nbsp;</td>
{*---- 07.01.2011 групово приключване - източник:_fina.tpl ----*}
<td align=center> 
<img id="grimg" src="images/clos.gif" title="приключи маркираните" style="display:none;cursor:pointer;" onclick="graction();">
	<td class='sep'>&nbsp;</td>
<td> дата погасяв </td>
	<td class='sep'>&nbsp;</td>
<td colspan=2> разпределение </td>
		</tr>
	<tbody>
		{foreach from=$LIST item=elem key=ekey}
						{assign var="myid" value=$elem.id}
{*----
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
----*}
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td align=center>
						{if $elem.idtype==1}
							{math equation="a+b" a=$myid b=132 assign="myprnt"}
<a href="#" onclick="fuprinfina('finaprnt.php?para='+'{$myprnt}/');return false;"><img src="images/print.gif" title="отпечати постъплението"></a>
						{else}
						{/if}
	<td class='sep'>&nbsp;</td>	
<td align=right> {$elem.inco|tomoney2}</td>
	<td class='sep'>&nbsp;</td>	
				{assign var="arindx" value=$elem.idtype}
<td> {$ARTYPE.$arindx} 
				{if $arindx==1}
/{$elem.idfinabank}-{$elem.bankname}
				{else}
				{/if}
</td>
	<td class='sep'>&nbsp;</td>	
<td> 
				{if empty($elem.debtname)}
<font color="red">неопределен</font>
				{else}
					{if in_array($elem.iddebtor,$ARDEBT)}
{$elem.debtname} 
					{else}
<span class="no">
{$elem.debtname} 
</span>
					{/if}
				{/if}
														{*---- ГЛОБАЛЕН ФЛАГ - наблюдател ----*}
														{if $smarty.session.VIEWFLAG_FINANOEDIT}
														{else}
				{if $elem.isclosed and $DEBTCOUN>1}
<span class="dechan" rel="cazofinadebt.ajax.php{$elem.linkdebt}" title="смени длъжника" style="cursor:help"> 
<img src="images/filt.gif"> </span>
				{else}
				{/if}
														{/if}
</td>

{*---- допълнителна информация ----*}
	<td class='sep'>&nbsp;</td>	
<td align=center><img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация" style="cursor:help">
{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
{include file="cazofinainfo.tpl"}
</span>
{*---- край на доп.информация ----*}
</td>

{*---- история ----*}
	<td class='sep'>&nbsp;</td>	
			{if $elem.histcoun==0}
<td>&nbsp;</td>
			{else}
<td align=center>
														{*---- ГЛОБАЛЕН ФЛАГ - наблюдател ----*}
														{if $smarty.session.VIEWFLAG_FINANOEDIT}
														{else}
<a href="caseeditzone.php{$elem.hist}" class="nyroModal" target="_blank">
<span class="finahist" title="виж историята">{$elem.histcoun}</span>
</a>
														{/if}
</td>
			{/if}

				{*---- финансиста да може да корегира постъпленията от тази зона в делото ----*}
{*------
				{if $FLAGNOCHANGE and !$FINALOGGED}
				{else}
		<td class='sep'>&nbsp;</td>
<td align=left>
<nobr>
	{if $elem.isclosed==1 and $elem.idtype<>7}
<img src="images/info.gif" class="info" rel="caseeditzone.php{$elem.info}" title="информация за приключено постъпление" style="cursor:help">
	{else}
<a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
	{/if}
					{if $elem.idtype==2}
<a href="caseeditzone.php{$elem.prin}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати ПКО"></a>
					{else}
&nbsp;
					{/if}
</nobr>
</td>
				{/if}
------*}
				
{*-----------------
							{assign var=fledit value=false}
							{assign var=flprin value=false}
							{assign var=flinfo value=false}
				{if $elem.idtype==2}
							{assign var=fledit value=true}
							{assign var=flprin value=true}
				{else}
					{if $FLAGNOCHANGE and !$FINALOGGED}
					{else}
						{if $elem.isclosed==1 and $elem.idtype<>7}
							{assign var=flinfo value=true}
						{else}
							{assign var=fledit value=true}
						{/if}
					{/if}
				{/if}
-----------------*}

				{*---- зареждаме флагове за иконите ----*}
							{assign var=fledit value=false}
							{assign var=flprin value=false}
							{assign var=flinfo value=false}
														{*---- ГЛОБАЛЕН ФЛАГ - наблюдател ----*}
{*
{foreach from=$smarty.session item=itse key=kese}
	sess={$kese}={$itse}
	<br>
{/foreach}
*}
														{if $smarty.session.VIEWFLAG_FINANOEDIT}
														{else}
				{if $elem.isclosed==1}
					{*---- вече приключено ----*}
							{assign var=flinfo value=true}
				{else}
					{*---- неприключено ----*}
					{if $elem.idtype==2}
						{*---- прих.касов ордер ----*}
							{assign var=fledit value=true}
							{assign var=flprin value=true}
					{else}
						{*---- останалите типове ----*}
						{if $FLAGNOCHANGE and !$FINALOGGED}
							{*---- няма права за корекция ----*}
						{else}
							{*---- има права за корекция ----*}
							{assign var=fledit value=true}
						{/if}
					{/if}
										{*---- 14.03.2013 КРЪПКА забраняваме корекциите на готови за превод ----*}
										{if $elem.istran==2}
							{assign var=fledit value=false}
										{else}
										{/if}
					
				{/if}
														{/if}

				{*---- клетката с икони - според състоянието на флаговете ----*}
		<td class='sep'>&nbsp;</td>
<td align=left>
<nobr>
				{if $fledit}
<a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
				{else}
				{/if}
				{if $flprin}
{***
<a href="caseeditzone.php{$elem.prin}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати ПКО"></a>
<a href="#" onclick="fuprin('caseeditzone.php{$elem.prin}');"><img src="images/print.gif" title="отпечати ПКО"></a>
***}
<a href="#" onclick="fuprin('{$elem.prin}');return false;"><img src="images/print.gif" title="отпечати ПКО"></a>
				{else}
				{/if}
				{if $flinfo}
<img src="images/info.gif" class="info" rel="caseeditzone.php{$elem.info}" title="информация за приключено постъпление" style="cursor:help">
				{else}
				{/if}
</nobr>
</td>

{*---- неразпределения остатък, източник : _fina.tpl ----*}
	<td class='sep'>&nbsp;</td>
<td align=right> 
	{if $elem.rest==0}
-
	{else}
{$elem.rest|tomoney:2}
	{/if}
</td>

{*---- 24.01.2024 бутон за принтиране на готовите преводи ----*}
	<td class='sep'>&nbsp;</td>
<td>
	{if $elem.isclosed==1 && $elem.istran==1}
		<table>
		{foreach from=$EXLIST[$myid] item=elclai key=idclai}
				<tr>
					<td>
						{if $elclai.idstat == 0}
							<img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('{$elclai.printid}/');">
						{/if}
					</td>
				</tr>
		{/foreach}
		</table>
	{/if} 
</td>

{*--------------------------- икони за приключване ---------------------------*}
	<td class='sep'>&nbsp;</td>
<td align=center>
								{assign var=isoldway value=false}
{include file="cazofinaendd.tpl" INCASE=true isoldway=false}

{*---- 07.01.2011 групово приключване - източник:_fina.tpl ----*}
{*****
	<td class='sep'>&nbsp;</td>
<td align=center>
																{if $FLAGBANKMASS}
																{else}
												{if $FINALOGGED}
<input type=checkbox id="cbfina{$elem.id}" rela="cbfina" onclick="setgrimg();">
												{else}
												{/if}
																{/if}
*****}

{*---- дата за погасяването ----*}
	<td class='sep'>&nbsp;</td>
<td align=left>
{*----
	{if $elem.idcase<>0 and $elem.rest==0}
		{if $elem.isclosed==1}
----*}
			{if empty($elem.datebala)}
				{assign var=daco value="въведи дата"}
				{assign var=dast value="finahistno"}
			{else}
				{assign var=daco value=$elem.datebala|date_format:"%d.%m.%Y"}
				{assign var=dast value="finahist"}
			{/if}
														{*---- ГЛОБАЛЕН ФЛАГ - наблюдател ----*}
														{if $smarty.session.VIEWFLAG_FINANOEDIT}
{$daco}
														{else}
		{if $elem.isclosed==1}
<a href="caseeditzone.php{$elem.date}" class="nyroModal" target="_blank">
<nobr>
<span class="{$dast}" title="корегирай датата"> {$daco}
</span>
</nobr>
</a>
		{else}
&nbsp;
		{/if}
														{/if}
{*----
		{else}
&nbsp;
		{/if}
	{else}
&nbsp;
	{/if}
----*}
</td>

{*---- 26.10.2012 разгърнато разпределение ----*}
	<td class='sep'>&nbsp;</td>
<td bgcolor=#dddddd style="border-bottom: 1px solid black;">
{include file="cazofinadist.tpl"}
{*---- 17.07.2013 разпределение за датата на погасяване ----*}
				{if $elem.coundate>1}
<td rowspan={$elem.coundate} bgcolor=#eeeedd style="border-bottom: 1px solid black;border-left: 1px solid black;">
{include file="cazofinadate.tpl"}
				{else}
				{/if}
		
		</tr>
		{/foreach}	

{*------------------- сумите по длъжници ----------------------*}
											{assign var=first value=true}
		{foreach from=$ARSUDEBT item=elem key=ekey}
					<tr>
<td align=right class="recapitulation"> {$elem.suma|tomoney2}
<td class='sep'>&nbsp;</td>
<td align=left class="recapitulation" colspan=5> общо от 
				{if empty($elem.name)}
<font color="red">неопределен</font>
				{else}
{$elem.name}
				{/if}
<td class='sep'>&nbsp;</td>
											{if $first}
												{assign var=first value=false}
<td align=center class="recapitulation" rowspan={$ARSUDEBTLEN} colspan=5> 
<font size=+1><b>{$SUTOTA|tomoney2}</b></font>
<br> общо внесени
<td class='sep'>&nbsp;</td>
<td class="recapitulation" rowspan={$ARSUDEBTLEN} colspan=9> 
			<table align=center cellspacing=0 cellpadding=0 style="font:normal 7pt verdana;">
			{foreach from=$CLAILIST item=clainame key=idclai}
			<tr>
<td align=right> {$ARSUDIRE[$idclai]|tomoney2}
<td align=left> за {$clainame}
			{/foreach}
			{foreach from=$ARDIREINDX item=diretx key=direindx}
			<tr>
<td align=right> {$ARSUDIRE[$direindx]|tomoney2}
<td align=left> {$diretx}
			{/foreach}
			</table>
											{else}
											{/if}
		{/foreach}	

	</tbody>

{*---- 07.03.2018 фактури за т.26 ----*}
									{if empty($ARACTI)}
									{else}
{*---- таблицата с фактури е вътре в главната ----*}
					<tr>
<td colspan=100>
{include file="_listtabl.tpl"}
					<table class="list" align=left>
					<tr>
<td class="title" colspan=200> фактури за т.26
					<tr>
<td class="mark"> сума
<td class="mark"> фактура
<td class="mark"> получател
<td class="mark"> 
<td class="mark"> сметка
<td class="mark"> 
{foreach from=$ARACTI item=elem key=idelem}
					<tr>
<td align=right> {$elem.txtota|tomoney2}
							{*---- източник cazop9.tpl ----*}
					{if empty($elem.idbillelem)}
<td align=center> 
<img src="images/adda.gif" title="формирай фактура/сметка" style="cursor:pointer;" onclick="crinvo('{$idelem}',1);">
<td> &nbsp;
<td> &nbsp;
<td> &nbsp;
<td> &nbsp;
					{else}
<td align=right>
							{if $elem.idbillorig==0}
<span style="font:normal 7pt verdana;background-color:gold">изтрита<br>фактура</span>
							{else}
						{if $elem.seriinvo==0}
проф.{$elem.seriprof}/{$elem.invodate}
						{else}
{$elem.seriinvo}/{$elem.invodate}
						{/if}
							{/if}
<td> {$elem.billname}
<td> 
<a href="#" onclick="fuprinfina('caseeditzone.php{$elem.prininvo}'); return false;"> 
<img src="images/print.gif" title="отпечати фактурата">
</a>
<td align=right> {$elem.seribill}
<td>
<a href="#" onclick="fuprinfina('caseeditzone.php{$elem.prinbill}'); return false;"> 
<img src="images/printmult.gif" title="отпечати сметка {$elem.seribill}">
</a>
					{/if}
{/foreach}
					</table>
									{/if}
{*---- таблицата с фактури е вътре в главната ----*}
</table>
{*---- ------------------------------------------------------ ----*}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('a.nyroModal').nyroModal({ldelim}width:520, height:400{rdelim});
	$('.ttip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
	$('.stat2aaa').cluetip({ldelim} width: 600, local:true, cursor:'pointer' {rdelim});
$('.info').cluetip({ldelim} width: 360, cursor:'help' {rdelim});
$('.dechan').cluetip({ldelim}
//	cluetipClass: 'rounded', 
	arrows: true, 
	width: 200,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	{rdelim});
{rdelim});
{*---- 24.01.2024 принтиране на изходяща приключена транзакция - източник:_fina.tpl ----*}
function fup2(p1){ldelim}
	fuprin("/../tranprnt.php?para="+p1);
{rdelim}
{*---- 07.01.2011 групово приключване - източник:_fina.tpl ----*}
function graction(){ldelim}
	var lico= cbcoun();
	if (lico==""){ldelim}
	{rdelim}else{ldelim}
//alert(lico);
		$.nyroModalManual({ldelim}
			url: 'cazofinaclosgr.ajax.php?para='+lico.substr(1)
			,forceType: 'iframe'
			{rdelim});	
	{rdelim}
{rdelim}
function setgrimg(){ldelim}
	var lico= cbcoun();
	if (lico==""){ldelim}
		$("#grimg").hide();
	{rdelim}else{ldelim}
		$("#grimg").show();
	{rdelim}
{rdelim}
function cbcoun(){ldelim}
	var list= $("input[@rela='cbfina']");
	var lico= "";
//	var lico= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += "/"+list[i].id.substr(6);
//			lico += 1;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
//alert(lico);
return lico;
{rdelim}

function proc4(p1){ldelim}
		jQuery.ajax({ldelim}
			url: "cazofinaigno.ajax.php?f="+p1
			,success: succ2
			{rdelim});
{rdelim}
function succ2(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
$('#tpaymlink').click();
$('#tactulink').click();
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

{*---- формиране фактура за т.26 източник : txel.tpl function cbcreainvo ----*}
function crinvo(pref,flag){ldelim}
		jQuery.ajax({ldelim}
			url: "txelinvo.ajax.php?p1="+pref+"&p2="+flag
			,success: function(data){ldelim}
//alert(data);
					if (data=="ok"){ldelim}
$.nyroModalManual({ldelim}forceType:'iframe', url:'caseeditzone.php{$CREAINVOLINK}'{rdelim});
					{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
					{rdelim}
			{rdelim}
		{rdelim});
{rdelim}
</script>

<iframe id="idprinfina" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprinfina(p1){ldelim}
	document.getElementById("idprinfina").focus();
	document.getElementById("idprinfina").src= p1;
{rdelim}
function fuprinfinaall(){ldelim}
		jQuery.ajax({ldelim}
			url: "cazofinapall.ajax.php?c={$IDCASE}"
			,success: function(data){ldelim}fuprinfina("finaprnt.php?para="+data);{rdelim}
		{rdelim});
{rdelim}
</script>
