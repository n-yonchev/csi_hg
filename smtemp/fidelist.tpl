<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на длъжниците по филтър "{$SEEK}"</td>
	</tr>
{*----
	<tr>
		<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
		</td>
	</tr>
----*}
</thead>
					{if count($LIST)==0}
<tr>
<td>
няма длъжници
					{else}
<tr class='header'>
<td> име </td>
	<td class='sep'>&nbsp;</td>
<td> ЕГН </td>
	<td class='sep'>&nbsp;</td>
<td> булстат </td>
	<td class='sep'>&nbsp;</td>
<td> дело </td>
	<td class='sep'>&nbsp;</td>
<td> виж </td>
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
{include file="_archive.head.tpl"}
</tr>

{foreach from=$LIST item=elem key=ekey}
{*----
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
----*}
	<tr onmouseover='this.style.backgroundColor="#eeeeff";' onmouseout='this.style.backgroundColor="";' >
<td> <nobr>{$elem.name}</nobr> </td>
	<td class='sep'>&nbsp;</td>
				{if $elem.idtype==2}
<td> {$elem.egn} </td>
				{else}
	<td>&nbsp;</td>
				{/if}
	<td class='sep'>&nbsp;</td>
				{if $elem.idtype==1}
<td> {$elem.bulstat} </td>
				{else}
	<td>&nbsp;</td>
				{/if}

	<td class='sep'>&nbsp;</td>
<td> {$elem.caseseri}/{$elem.caseyear} </td>
	<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}"> <img src="images/view.png" title="подробно">
</a></td>
	<td class='sep'>&nbsp;</td>
			{assign var=myindx value=$elem.casefrom}
<td> {$elem.casedate|date_format:"%d.%m.%Y"} </td>
	<td class='sep'>&nbsp;</td>
<td> <nobr>{$ARFROM.$myindx}</nobr> </td>
	<td class='sep'>&nbsp;</td>
<td> {$elem.casetext}/{$elem.caseyear} </td>
	<td class='sep'>&nbsp;</td>
<td> <nobr>{$elem.username}</nobr> </td>
	<td class='sep'>&nbsp;</td>
		{assign var='indxstat' value=$elem.idstat}
<td> {$ARSTAT.$indxstat} &nbsp;
	<td class='sep'>&nbsp;</td>
<td>
			{assign var='idcase' value=$elem.idcase}
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
{include file="_archive.tpl" ID=$elem.id}
	</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>
					{/if}

{include file="_archive.inc.tpl"}
