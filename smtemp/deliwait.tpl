				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
<div style="float:left">Списък на ЧАКАЩИТЕ документи - {if $ISINTE}вътрешни{else}външни{/if}
{*
			{if $ISFILT}
 - по филтър
			{else}
			{/if}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
*}
</div>
				<tr class='head2'>
<td> създаден
{*
<td> от
*}
					{if $ISINTE}
<td> изходящ
<td> тип
<td> дело
<td> деловодител
<td> &nbsp;
					{else}
<td> входящ
<td> &nbsp;
<td> източник
<td> доп
					{/if}
<td> <input id="call" type=checkbox onclick="checkall()";>
<td> адресат
<td> адрес
					{if $ISINTE}
<td> метод
					{else}
					{/if}
<td class="head3"> призовкар
{*
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
<td class="head3"> &nbsp;
*}
<td> &nbsp;
									{assign var=headdate value=""}
{foreach from=$LIST item=elem key=ekey}
									{assign var=currdate value=$elem.created|date_format:"%d.%m.%Y"}
									{if $currdate==$headdate}
									{else}
										{assign var=headdate value=$elem.created|date_format:"%d.%m.%Y"}
				<tr>
<td class="fon8 rowdate" colspan=20> &nbsp;&nbsp;{$headdate}</b>
									{/if}
				<tr>
									{assign var=cosp value="rowspan="|cat:$elem.coun}
{*
				<tr onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
<td class="fon7" title="{$elem.deliuser}"> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}
<td class="fon7"> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}
*}
<td {$cosp} class="fon7 mark" title="{$elem.created|date_format:"%d.%m.%Y %H:%M:%S"} от {$elem.deliuser}"> {$elem.created|date_format:"%H:%M:%S"}
{*
<td class="fon7"> {$elem.deliuser}
*}
					{if $ISINTE}
<td {$cosp} class="spec" title="{$elem.iddout}" onclick="fuprin('{$elem.doutfilename}');"> {$elem.d2seri}/{$elem.d2year}
<td {$cosp} class="spec fon7"> {$elem.d2text}
			{if $elem.caseseri==0 and $elem.caseyear==0}
<td {$cosp}> &nbsp;
			{else}
{*
				{foreach from=$DATA[$ekey] item=elemdata key=ekeydata}
					{assign var=currtocase value=$elemdata.tocase}
				{/foreach}
<td class="case" {include file="_href.tpl" LINK=$currtocase} title="виж документите по делото"> {$elem.caseseri}/{$elem.caseyear}
*}
<td {$cosp} class="case" {include file="_href.tpl" LINK=$elem.tocase} title="виж документите по делото"> {$elem.caseseri}/{$elem.caseyear}
			{/if}
<td {$cosp} class="spec fon7"> {$elem.caseuser}
						{if $elem.coun<2}
<td {$cosp}> &nbsp;
						{else}
<td {$cosp}> <input type=checkbox id="cg{$ekey}" onclick="checkgroup({$ekey})";>
						{/if}
					{else}
<td {$cosp} class="spec"> {$elem.d1seri}/{$elem.d1year}
<td {$cosp} class="fon7 mark" rel="#cont{$ekey}" title="съдържание на вх.документ" rela="ttip" style="cursor:help;"> виж
{*---- съдържание на доп.информация ----*}
<span id="cont{$ekey}" style="display: none">
	<table>
	<tr>
<td> описание
<td> <b>{$elem.docutext}</b>
	<tr>
<td> подател
<td> <b>{$elem.docufrom}</b>
	<tr>
<td> бележки
<td> <b>{$elem.docunote}</b>
	</table>
</span>
					{/if}
							{assign var=first value=true}
			{foreach from=$DATA[$ekey] item=elemdata key=ekeydata}
							{if $first}
								{assign var=first value=false}
							{else}
								<tr>
							{/if}
									{assign var=contalert value="<font color=red>непопълнен</font>"}
									{assign var=nocontent value=false}
					{if $ISINTE}
					{else}
						{if empty($elemdata.sourname)}
									{assign var=nocontent value=true}
<td class="spec"> {$contalert}
<td class="spec"> &nbsp;
						{else}
<td class="spec"> {$elemdata.sourname}
<td class="spec"> {$elemdata.exinfo}
						{/if}
					{/if}
<td align=center>
									{if $nocontent}
&nbsp;
									{else}
<input class="cbox" type=checkbox name="cbdeli[]" id="{$ekeydata}" rela="{$ekey}" call=1>
									{/if}
<td> 
									{if $nocontent}
{$contalert}
									{else}
{$elemdata.adresat}&nbsp;
									{/if}
<td> {$elemdata.address}&nbsp;
					{if $ISINTE}
<td> {$ARPOSTTYPE[$elemdata.idposttype]}&nbsp;
					{else}
					{/if}
<td class=""> {$elemdata.pouser}&nbsp;
<td>
<nobr>
<a href="{$elemdata.deliwaitedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
									{if $nocontent}
									{else}
&nbsp;
			{if $elemdata.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elemdata.deliwaitdubl} title="дублирай документа"> 
			{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elemdata.deliwaitdele} title="изтрий дублирания документ"> 
			{/if}
									{/if}
</nobr>
{*
<input class="cbox" type=checkbox name="cbdeli[]" value="{$ekeydata}" id="{$ekeydata}" rela="{$ekey}">
				{if $ISCASE}
<td> <h2>{$elem.status}</h2>
[поща] [призов] [офис]
				{else}
				{/if}
*}
			{/foreach}
{/foreach}
{include file="_tab2pagi.tpl"}
				<tr>
<td colspan=20>
	<div style="float:right">
<button class="butt" onclick="$('#call').removeAttr('checked');fubegi('{$LINKCOPY}');"> прехвърли </button>
<br>
маркираните документи в нормалния списък
	</div>
	<div style="float:right">
&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
{*
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </button>
<br>
в маркираните документи
	</div>
*}
				</table>
{include file="deli.inc.tpl"}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$("[@rela='ttip']").cluetip({ldelim} width: 300, local:true, cursor:'help' {rdelim});
{rdelim});
function checkgroup(grid){ldelim}
	var istrue= $("#cg"+grid).attr("checked");
//alert(istrue);
	var grname= "input:checkbox[@rela='"+grid+"']";
	if (istrue){ldelim}
		$(grname).attr("checked","checked");
	{rdelim}else{ldelim}
		$(grname).removeAttr("checked");
	{rdelim}
{rdelim}
function checkall(grid){ldelim}
	var istrue= $("#call").attr("checked");
//alert(istrue);
	var grname= "input:checkbox[@call=1]";
	if (istrue){ldelim}
		$(grname).attr("checked","checked");
	{rdelim}else{ldelim}
		$(grname).removeAttr("checked");
	{rdelim}
{rdelim}
</script>
