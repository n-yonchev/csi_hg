{include file="_tab2.tpl"}
<style>
body {ldelim}font: normal 8pt verdana; padding: 1px 8px 1px 8px;{rdelim}
.vari {ldelim}font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer;{rdelim}
.over {ldelim}background-color:silver !important;{rdelim}
.curr {ldelim}font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer; background-color:PaleTurquoise; padding: 1px 10px;{rdelim}
.butt {ldelim}font: normal 8pt verdana; background-color:PaleTurquoise; padding:6px 10px 6px 10px; cursor:pointer; border: 0px solid black;{rdelim}
.fon7 {ldelim}font: normal 7pt verdana !important;{rdelim}
.head3 {ldelim}font:normal 7pt verdana !important; color:black !important; background-color:khaki !important;{rdelim}
.row3 {ldelim}background-color:moccasin;{rdelim}
.blue7 {ldelim}font:bold 7pt verdana !important; color:blue !important;{rdelim}
{*
.cbox {ldelim}font:normal 8pt verdana; background-color:khaki !important;{rdelim}
*}
.case {ldelim}background-color:plum !important;cursor:pointer;{rdelim}
</style>
{*
				<form method="post">
*}
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
{*
<div style="float:left">Списък на изходящите документи - призовки
*}
<div style="float:left">Списък на документите-призовки
			{if $ISFILT}
 - по филтър
			{else}
			{/if}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
					{if $ISFILT}
						{assign var=excode value="style='color:red;border-bottom:1px solid red;'"}
					{else}
						{assign var=excode value=""}
					{/if}
<div style="float:right"> 
			{if $ISFILT}
<span class="vari" {$excode} {include file="_href.tpl" LINK=$LINKFILTNO}> без филтър </span>
&nbsp;&nbsp;
			{else}
			{/if}
<span class="vari ttip" {$excode} rel="#filtview" title="съдържание на филтъра"
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$LINKFILTEDIT}'{rdelim});"> филтър </span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
	{*---- съдържание на филтъра ----*}
	<span id="filtview" style="display: none">
				{if empty($ARVIEWFILT)}
няма въведен филтър
				{else}
	<table>
{foreach from=$ARVIEWFILT item=fico key=fina}
	<tr>
<td> {$ARELEM.$fina.text}
<td> <b>{$fico}</b>
{/foreach}
	</table>
<hr>
<font color=blue>клик за корекция</font>
				{/if}
	</span>

				<tr class='head2'>
{*
<td> документ
<td> изходен
*}
<td> изходящ
<td> входящ
<td> създаден
{*---- ----*}
<td> тип
<td> дело
<td> деловодител
<td> адресат
<td> адрес
<td class="head3"> призовкар
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> &nbsp;
<td class="head3"> &nbsp;
{foreach from=$LIST item=elem key=ekey}
				<tr onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
<td> {$elem.d2seri}/{$elem.d2year}
<td> 
{*
[{$elem.id}]
*}
<td class="fon7" title="{$elem.deliuser}"> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}
										{if $elem.isold==1}
<td colspan=12> СТАР ЗАПИС
										{else}
<td class="fon7"> {$elem.d2text}
{***
			{if $ARNOCOUN[$elem.idcasepost].coun==0}
<td> {$elem.caseseri}/{$elem.caseyear}
			{else}
<td class="case" title="по делото има {$ARNOCOUN[$elem.idcasepost].coun} необхванати изх.документи"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$ARNOCOUN[$elem.idcasepost].link}'{rdelim});"
> {$elem.caseseri}/{$elem.caseyear}
			{/if}
***}
			{if $elem.caseseri==0 and $elem.caseyear==0}
<td> &nbsp;
			{else}
<td> {$elem.caseseri}/{$elem.caseyear}
			{/if}
<td class="fon7"> {$elem.caseuser}
<td> {$elem.adresat}
<td> {$elem.address}
{*
<td class="row3"> {$elem.pouser}
<td class="row3 fon7"> {$elem.date1|date_format:"%d.%m.%Y"}
<td class="row3 fon7"> {$elem.date2|date_format:"%d.%m.%Y"}
<td class="row3 fon7"> {$elem.date3|date_format:"%d.%m.%Y"}
<td class="row3"> {$elem.postat}
<td class="row3" align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="{$elem.id}" id="{$elem.id}">
*}
<td class=""> {$elem.pouser}
<td class="fon7"> {$elem.date1|date_format:"%d.%m.%Y"}
<td class="fon7"> {$elem.date2|date_format:"%d.%m.%Y"}
<td class="fon7"> {$elem.date3|date_format:"%d.%m.%Y"}
<td class=""> {$elem.postat}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<td align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="{$elem.id}" id="{$elem.id}">
{*
{$elem.id}
*}
										{/if}
				{if $ISCASE}
<td> <h2>{$elem.status}</h2>
[поща] [призов] [офис]
				{else}
				{/if}
{/foreach}
{include file="_tab2pagi.tpl"}
				<tr>
<td colspan=20>
{*
<input type=submit class="butt" name="submedit" value="корегирай">
*}
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKEDIT}');"> корегирай полета </button>
<br>
в маркираните документи
	</div>
	<div style="float:right">
&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </button>
<br>
в маркираните документи
	</div>
				</table>
{*
				</form>
*}

<script>
var currlink;
function fubegi(p1){ldelim}
currlink= p1;
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
//alert(i);
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
//alert(i+'='+lico);
			coun ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
//return lico+"^"+coun;
	if (coun==0){ldelim}
	{rdelim}else{ldelim}
		jQuery.ajax({ldelim}
			url: "delidocucbox.ajax.php?list="+lico
			,success: succedit
			{rdelim});
	{rdelim}
{rdelim}
function succedit(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
//$('#tpaymlink').click();
//$('#tactulink').click();
$.nyroModalManual({ldelim}forceType:'iframe', url:currlink{rdelim});
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 420, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
