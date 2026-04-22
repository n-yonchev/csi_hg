<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък дела за година {$YEAR}</td>
	</tr>
</thead>
					{if count($LIST)==0}
<tr>
<td>
няма дела
					{else}
<tr class='header'>
<td> дело </td>
	<td class='sep'>&nbsp;</td>
<td> създадено </td>
	<td class='sep'>&nbsp;</td>
<td> идва от </td>
	<td class='sep'>&nbsp;</td>
<td> описание </td>
	<td class='sep'>&nbsp;</td>
<td> деловодител </td>
	<td class='sep'>&nbsp;</td>
<td> статус </td>
	<td class='sep'>&nbsp;</td>
<td> взискатели </td>
	<td class='sep'>&nbsp;</td>
<td> длъжници </td>
	<td class='sep'>&nbsp;</td>
<td> виж </td>
{include file="_archive.head.tpl"}
</tr>

{foreach from=$LIST item=elem key=ekey}
{*----
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
----*}
	<tr onmouseover='this.style.backgroundColor="#eeeeff";' onmouseout='this.style.backgroundColor="";' >
<td > {$elem.serial}/{$elem.year} </td>
	<td class='sep'>&nbsp;</td>
<td > {$elem.created|date_format:"%d.%m.%Y"} </td>
	<td class='sep'>&nbsp;</td>
			{assign var=myindx value=$elem.idcofrom}
<td > <nobr>{$ARFROM.$myindx}</nobr> </td>
	<td class='sep'>&nbsp;</td>
<td > {$elem.text} </td>
	<td class='sep'>&nbsp;</td>
<td > <nobr>{$elem.username}</nobr> </td>
	<td class='sep'>&nbsp;</td>
		{assign var='indxstat' value=$elem.idstat}
<td> {$ARSTAT.$indxstat} &nbsp;
	<td class='sep'>&nbsp;</td>
<td>
			{assign var='idcase' value=$elem.id}
					{foreach from=$LISTCLAI[$idcase] item=memb}
{if $memb.idtype==1}юл{elseif $memb.idtype==2}фл{else}др{/if} {$memb.name}
<br>
					{/foreach}
	<td class='sep'>&nbsp;</td>
<td>
					{foreach from=$LISTDEBT[$idcase] item=memb}
{if $memb.idtype==1}юл{elseif $memb.idtype==2}фл{else}др{/if} {$memb.name}
<br>
					{/foreach}
	<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}"> <img src="images/view.png" title="подробно">
</a></td>
{include file="_archive.tpl" ID=$elem.id}
	</tr>
	{/foreach}

{include file="_pagina.tr.tpl"}
</table>
					{/if}

{include file="_archive.inc.tpl"}
