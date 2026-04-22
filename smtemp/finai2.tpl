{*
<style>
td {ldelim}font:normal 8pt verdana; background-color:#dddddd; border-bottom:1px solid black;{rdelim}
.filtcu {ldelim}font:normal 8pt verdana; border-bottom:1px solid black; background-color:#cccccc; padding: 1px 6px 1px 6px;{rdelim}
.filtno {ldelim}font:normal 8pt verdana; border-bottom:1px solid black;{rdelim}
.trowlast {ldelim}font:normal 8pt verdana; background-color:#dddddd; border-bottom:1px solid black;{rdelim}
</style>
*}
<style>
.trow {ldelim}font:normal 8pt verdana; background-color:#dddddd;{rdelim}
.cell {ldelim}font:normal 8pt verdana;{rdelim}
.link {ldelim}font:normal 8pt verdana; background-color:wheat; cursor:pointer;{rdelim}
</style>
				<table class="d_table" cellspacing='0' cellpadding='0' align=center>
				<thead>
				<tr>
<td class='d_table_title' colspan='200'> суми от фактури по години и месеци
{*
<br>
{foreach from=$ARMENU item=elem key=ekey}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$LINKFILT.$ekey}" class="{if $ekey==$FILTMODE}filtcu{else}filtno{/if}"> {$elem} </a>
{/foreach}
<br>
<br>
	</tr>
*}
				</thead>
				<tr class='header'>
<td> година
				<td class='sep'>&nbsp;</td>
<td> &nbsp;
{foreach from=$LISTMONT item=mont}
				<td class='sep'>&nbsp;</td>
<td align=center width=40> {$mont} 
{/foreach}
				<td class='sep'>&nbsp;</td>
<td align=center> общо
				<td class='sep'>&nbsp;</td>
<td align=center> неизхо<br>дени
				<td class='sep'>&nbsp;</td>
<td align=center> всичко

{foreach from=$LISTYEAR item=year}
				<tr>
<td class="trow" rowspan=4> {$year}
				<td class='sep' rowspan=4>&nbsp;</td>
<td class="trow"> сума
{include file="finai2year.tpl" CONT=$DATA[$year] FIEL="suma"}
				<tr>
<td class="trow"> втч ддс
{include file="finai2year.tpl" CONT=$DATA[$year] FIEL="svat"}
				<tr>
<td class="trow"> бр.факт
{include file="finai2year.tpl" CONT=$DATA[$year] FIEL="coun"}
				<tr>
<td colspan=40> <hr>
{/foreach}

{*
{foreach from=$LIST item=elem key=ekey}
			{if $elem.id==0}
		<tr>
		<td>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> <font color="red"> СВОБОДНИ </font></td>
			{else}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> {$elem.name}</td>
			{/if}
		<td class='sep'>&nbsp;</td>
	{assign var=cuuser value=$elem.id}
		<td align=center> <b>{$ARCOUN.$cuuser.tota}</b> </td>
		<td class='sep'>&nbsp;</td>
{foreach from=$LISTYEAR item=year}
	{assign var=councase value=$ARCOUN.$cuuser.$year}
		<td align=center 
{if $councase==0}{else}bgcolor="#dddddd" style="cursor:pointer" onclick="document.location.href='{$elem.$year.view}';" title="виж делата"{/if}>
		<b>{$councase}</b> </td>
		<td class='sep'>&nbsp;</td>
{/foreach}
	</tr>
	{/foreach}
		<tr>
		<td> <b>ОБЩО ДЕЛА</b> </td>
		<td class='sep'>&nbsp;</td>
		<td align=center> <b>{$ARTOTA.tota}</b> </td>
		<td class='sep'>&nbsp;</td>
{foreach from=$LISTYEAR item=year}
	{assign var=councase value=$ARTOTA.$year}
		<td align=center> <b>{$councase}</b> </td>
		<td class='sep'>&nbsp;</td>
{/foreach}
*}	
				</table>



