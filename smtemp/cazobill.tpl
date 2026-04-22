<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>
<style>
.diff {ldelim}color:red;{rdelim}
.p1 {ldelim}font: normal 8pt verdana;{rdelim}
.p1:hover {ldelim}color:red;border-bottom: 1px solid red;{rdelim}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

		<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
		<thead>
		<tr>
<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
		{*---- рефреш на зоната след десен клик, източник _caseedit.js ----*}
<div style="float:left" oncontextmenu="$('#tbilllink').click();return false;">
фактури и сметки
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
		</tr>
	
		</thead>
		<tr class='header'>
<td> фактура
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<td class='sep'>&nbsp;</td>
<td> сметка </td>
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td align=right> сума </td>
		<td class='sep'>&nbsp;</td>
<td> втч ддс </td>
		<td class='sep'>&nbsp;</td>
<td> задълж.лице </td>
{*
		<td class='sep'>&nbsp;</td>
<td> фактура
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
*}
		<td class='sep'>&nbsp;</td>
<td> тип
		<td class='sep'>&nbsp;</td>
<td> проф
		<tbody>
	{foreach from=$LIST item=elem}		
								{assign var="mybill" value=$elem.id}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
{*+++
<td align=right> {$elem.seriinvo}
+++*}
<td align=right bgcolor=#dddddd> 
						{if $elem.seriinvo<=0}
- &nbsp;
						{else}
{$elem.seriinvo}
						{/if}
{***
			{if empty($elem.serial)}
&nbsp;
			{elseif empty($elem.invoseri)}
				{if 0}
				{else}
<a href="caseeditzone.php{$elem.invobill}" class="nyroModal" target="_blank"><img src="images/correct.gif" title="създай фактура"></a>
				{/if}
			{else}
***}
{*
<a href="caseeditzone.php{$elem.invobillprin}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати фактурата"></a>
<img src="images/print.gif" title="отпечати фактурата" onclick="fuprin('{$elem.invobillprin}');" style="cursor:pointer">
*}
		<td class='sep'>&nbsp;</td>
<td>
{*
<a href="caseeditzone.php{$elem.prininvo}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати фактурата"></a>
*}
						{if $elem.seriinvo<=0}
&nbsp;
						{else}
<a href="#" onclick="fuprin('{$elem.prininvo}'); return false;"> 
<img src="images/print.gif" title="отпечати фактурата">
</a> 
						{/if}
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor=#dddddd> 
						{if $elem.serial<=0}
- &nbsp;
						{else}
{$elem.serial}
						{/if}
		<td class='sep'>&nbsp;</td>
<td> 
{*
<a href="caseeditzone.php{$elem.prinbill}" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати сметката"></a>
*}
						{if $elem.serial<=0}
&nbsp;
						{else}
<a href="#" onclick="fuprin('{$elem.prinbill}'); return false;"> 
<img src="images/print.gif" title="отпечати сметката">
</a> 
						{/if}
		<td class='sep'>&nbsp;</td>
<td> {$elem.date|date_format:"%d.%m.%Y"}</td>
		<td class='sep'>&nbsp;</td>
<td align=right bgcolor=#dddddd> {$LISTSUMA[$elem.id].suma|tomo3}</td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$LISTSUMA[$elem.id].svat|tomo3}
		<td class='sep'>&nbsp;</td>			
<td> {$elem.name}</td>
{*--------*}
{*
<img class="prin" rel="#prin{$mybill}" src="images/print.gif" title="отпечати">
<span id="prin{$mybill}" style="display: none">
{foreach from=$ARINVOTYPE item=intext key=inkey}
			{assign var=inprin value="prin"|cat:$inkey}
<a class="p1" href="#" onclick="fuprin('{$elem[$inprin]}'); return false;"> {$intext} </a>
<br>
{/foreach}
</span>			
*}
{***
			{/if}
***}
		<td class='sep'>&nbsp;</td>
<td> {$ARINVOTYPE[$elem.idinvotype]}
		<td class='sep'>&nbsp;</td>
<td> {$elem.seriprof}
	{/foreach}

{*---- суми посл.ред ----*}
		<tr class='header'>
<td colspan=9> общо
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARTOTA[1]|tomo3}
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARTOTA[2]|tomo3}
		<td class='sep'>&nbsp;</td>
<td colspan=9> &nbsp;
</tbody>
</table>
{*
<script>
$(document).ready(function() {ldelim}
	$('.prin').cluetip({ldelim} 
	width:150,local:true,cursor:'pointer',  sticky:true,mouseOutClose:true,  closePosition:"title",closeText:"x", arrows:true
	{rdelim});
{rdelim});
</script>
*}

{*-------- РКО --------*}
			{if empty($ARRAZH)}
			{else}
		<table class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> РКО
		</thead>
		<tr class='header'>
<td align=right> сума
		<td class='sep'>&nbsp;</td>
<td> номер
		<td class='sep'>&nbsp;</td>
<td> дата
		<td class='sep'>&nbsp;</td>
<td> изплатена на
		<td class='sep'>&nbsp;</td>
<td> &nbsp;
		<tbody>
	{foreach from=$ARRAZH item=elem}
		<tr>
<td align=right> {$elem.amount|tomoney2}
		<td class='sep'>&nbsp;</td>
<td> {$elem.cashserial}/{$elem.cashyear}
		<td class='sep'>&nbsp;</td>
<td> {$elem.cashdate|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td> {$elem.cashname}
		<td class='sep'>&nbsp;</td>
<td> 
<a href="#" onclick="fuprin('{$elem.prinrazh}'); return false;"> 
<img src="images/print.gif" title="отпечати РКО">
</a> 

	{/foreach}
		</tbody>
		</table>
			{/if}