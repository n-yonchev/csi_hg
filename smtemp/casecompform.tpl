<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
	<td class='d_table_title' colspan='200'>брой дела с непълни основни данни</td>
	</tr>
</thead>

<tr class='header'>
	<td>име</td>
	<td class='sep'>&nbsp;</td>
	<td>общо</td>
	<td class='sep'>&nbsp;</td>
{*----
	<td>дела</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
----*}
{foreach from=$LISTYEAR item=year}
	<td align=center> {$year} </td>
	<td class='sep'>&nbsp;</td>
{/foreach}
</tr>

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
{*----
		<td align=center {if $elem.councase==0}{else}bgcolor="#dddddd"{/if}> <b>{$elem.councase}</b> </td>
		<td class='sep'>&nbsp;</td>
----*}
	{assign var=cuuser value=$elem.id}
		<td align=center> <b>{$ARCOUN.$cuuser.tota}</b> </td>
		<td class='sep'>&nbsp;</td>
{foreach from=$LISTYEAR item=year}
	{assign var=councase value=$ARCOUN.$cuuser.$year}
		<td align=center 
{*----
{if $councase==0}{else}bgcolor="#dddddd" style="cursor:pointer" onclick="document.location.href='{$elem.$year.view}';" title="виж делата"{/if}>
----*}
{if $councase==0 or $elem.id==0}
{else}
bgcolor="#dddddd" style="cursor:pointer" onclick="document.location.href='{$elem.$year.view}';" title="виж делата"
{/if}>
		<b>{$councase}</b> </td>
		<td class='sep'>&nbsp;</td>
{/foreach}
{*----
<td align=center>
	{if $elem.councase==0}
	{else}
<a href="{$elem.view}"><img src="images/view.png" title="виж делата"></a>
	{/if}
</td>
----*}
	</tr>
	{/foreach}
		<tr>
		<td> <b>ОБЩО ДЕЛА</b> </td>
		<td class='sep'>&nbsp;</td>
{*----
		<td align=center> <b>{$TOCOUN}</b> </td>
----*}
		<td align=center> <b>{$ARTOTA.tota}</b> </td>
		<td class='sep'>&nbsp;</td>
{foreach from=$LISTYEAR item=year}
	{assign var=councase value=$ARTOTA.$year}
		<td align=center> <b>{$councase}</b> </td>
		<td class='sep'>&nbsp;</td>
{/foreach}
	
{*----
{include file="_pagina.tr.tpl"}
----*}
</table>



