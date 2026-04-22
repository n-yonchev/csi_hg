<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
		<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
		{*---- рефреш на зоната след десен клик, източник _caseedit.js ----*}
<div style="float:left" oncontextmenu="$('#tadvalink').click();return false;">
вноски по аванс.такси
</div>
			{if $FLAGNOCHANGE and !$FINALOGGED}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
{*
<a href="caseeditzone.php{$ADDNEWFILE}" class="nyroModal" target="_blank">
<img src="images/up.gif" title="качи самостоятелен файл">
</a>
<a href="caseeditzone.php{$DIREADD}" class="nyroModal" target="_blank">
<img src="images/adda.gif" title="добави директно">
</a>
*}
</div>
			{/if}
		</tr>
		</thead>
		<tr class='header'>
<td>сума</td>
		<td class='sep'>&nbsp;</td>
<td>дата</td>
		<td class='sep'>&nbsp;</td>	
<td>тип
		<td class='sep'>&nbsp;</td>	
<td>взискател</td>
		<td class='sep'>&nbsp;</td>	
<td>&nbsp;</td>
				{if $FLAGNOCHANGE and !$FINALOGGED}
				{else}
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
				{/if}
		</tr>
		<tbody>
		{foreach from=$LIST item=elem key=ekey}
		<tr  onmouseover='this.className="trhove";' onmouseout='this.className="";'>
{*
				{assign var="txtype" value=""}
				{assign var="txcode" value=""}
			{if $elem.idtype==1}
				{assign var="txtype" value="ю"}
				{assign var="txcode" value=$elem.bulstat}
			{elseif $elem.idtype==2}
				{assign var="txtype" value="ф"}
				{assign var="txcode" value=$elem.egn}
			{else}
			{/if}
*}
<td align="right"> {$elem.amount|tomoney2} </td>
		<td class='sep'>&nbsp;</td>
<td align="left"> {$elem.date|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
					{if $elem.iscash==1}
						{assign var=mytype value=1}
					{else}
						{assign var=mytype value=2}
					{/if}
<td align="left"> {$ARPATYPE[$mytype]}
		<td class='sep'>&nbsp;</td>
<td align="left"> {$elem.clainame}
		<td class='sep'>&nbsp;</td>
<td align="left"> 
				{if empty($elem.descrip)}
				{else}
<img src="images/view.png" title='{$elem.descrip}' style="cursor:help">
				{/if}
</td>
				{if $FLAGNOCHANGE and !$FINALOGGED}
				{else}
		<td class='sep'>&nbsp;</td>
<td align="left">
<nobr>
<a href="caseeditzone.php{$elem.editadva}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.deleadva}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
					{if $elem.iscash==1}
<a href="#" onclick="fuprin('{$elem.prinadva}');return false;"><img src="images/print.gif" title="отпечати ПКО"></a>
					{else}
					{/if}
</nobr>
</td>
				{/if}
		</tr>			
		{/foreach}
		</tbody>
</table>

		{*---- рекапитулация ----*}
		<table class="d_table" width=100%>
		<tr>
<td class="recapitulation"> общо по взискатели
<td class="recapitulation" align=right> дъл<br>жими
<td class="recapitulation" align=right> вне<br>сени
<td class="recapitulation" align=right> невне<br>сени
		{foreach from=$ARCLAI item=clainame key=claiid}
		<tr>
<td> {$clainame}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUM1[$claiid]}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUM2[$claiid]}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUM3[$claiid]}
		{/foreach}
		<tr class="recapitulation">
<td> общо
{*
<td align=right> {$ARSUMA[1]|tomoney2}
<td align=right> {$ARSUMA[2]|tomoney2}
<td align=right> {$ARSUMA[3]|tomoney2}
*}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUMA[1]}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUMA[2]}
<td align=right> {include file="cazobalastatelem.tpl" CONT=$ARSUMA[3]}
						{if $ARSUMA[3]<0}
		<tr class="red7bg">
<td colspan=10> 
ВНИМАНИЕ.
Внесените аванс.такси надвишават дължимите.
Добави още такси към предмета на изпълнение.
						{else}
						{/if}
		<tr class="recapitulation">
<td colspan=2> изработени по делото
<span class="info2" rel="#listinfo2" title="списък изработени документи" style="cursor:help"> 
<img src="images/view.png"> </span>
<td align=right> {include file="cazobalastatelem.tpl" CONT=$SU1}
		<tr class="recapitulation">
<td colspan=2> невнесени от изработените
<td align=right> {include file="cazobalastatelem.tpl" CONT=$SU2}
		</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<span id="listinfo2" style="display: none">
		<table class="caseperc">
<th> тип изх.документ
<th> броя
<th> такса
<th align=right> сума
{foreach from=$DATA2 item=elem key=ekey}
		<tr>
<td> {$elem.typetext}
<td align=right> {$elem.coun}
<td align=right> {$elem.regitax|tomoney2}
<td align=right> {$elem.suma|tomoney2}
{/foreach}
		</table>
</span>
<script type="text/javascript">
$(document).ready(function() {ldelim}
$('.info2').cluetip({ldelim}
//	cluetipClass: 'rounded', 
		local: true,
	arrows: true, 
	width: 400,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	{rdelim});
{rdelim});
</script>
