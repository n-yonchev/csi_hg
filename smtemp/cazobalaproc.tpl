				<table cellspacing=0 cellpadding=0">
				<tr>
{*----
<td class="tdbalahead" align=right width=40> %
----*}
<td class="tdbalahead" align=right {if $ACTUDEBT}{else}width=40{/if}> %
	{foreach from=$CLAILIST item=clainame key=claiid}
				<tr>
<td class="tdbala" align=right>
					{assign var=cont value=$elem.$VARI.$claiid}
					{if $cont<0 or $cont==="???"}
<span class="red7bg"> <b>{$cont}</b> </span>
					{elseif $cont==0}
&nbsp;
					{else}
{$cont}
					{/if}
	{/foreach}
				</table>
				