				<table cellspacing=0 cellpadding=0 bgcolor="{$BGCO}">
				<tr>
{*----
<td class="tdbalahead" width=160> взискател
----*}
<td class="tdbalahead" align=right width=40> глав
<td class="tdbalahead" align=right width=40> лихви
<td class="tdbalahead" align=right width=40> неол
{*----
<td class="tdbalahead" align=right width=40> такси
----*}
<td class="tdbalahead" align=right width=40> т.26
<td class="tdbalahead" align=right width=60 title="{$elem.tosuma|tomoney2}"> общо
	{foreach from=$CLAILIST item=clainame key=claiid}
				<tr>
{*----
<td class="tdbala"> {$clainame}
----*}
<td class="tdbala" align=right>
{include file="cazobalastatelem.tpl" CONT=$elem.$VARI.$claiid.capi}
{*----
<td class="tdbala" align=right> {$elem.$VARI.$claiid.perc}
----*}
<td class="tdbala" align=right>
				{assign var=elemperc value=$elem.$VARI.$claiid.perc}
{*+++
[тест={$elemperc}=[{$ekey}]=[{$VARI}][{$claiid}]=]
+++*}
				{if $VARI=="move" and !empty($elemperc) and $elem.$VARI.intelink}
					{assign var=vid1 value=$elem.para.$claiid[0]|date_format:"%d.%m.%Y"}
					{assign var=vid2 value=$elem.para.$claiid[1]|date_format:"%d.%m.%Y"}
					{assign var=visu value=$elem.para.$claiid[2]|tomoney2}
{*----
<span class="finahist" rel="cazobalaperc.ajax.php?para={$elem.para.$claiid}" title="олихвяване на сума {$elem.suma.$claiid}" style="cursor:help"> 
----*}
<span class="finahist" rel="cazobalaperc.ajax.php?para={$elem.para.$claiid[0]}^{$elem.para.$claiid[1]}^{$elem.para.$claiid[2]}" 
title="олихвяване на сума <b>{$visu}</b> за периода <b>{$vid1}&nbsp;-&nbsp;{$vid2}</b>" style="cursor:help"> 
{$elemperc|tomoney2} </span>
				{else}
{include file="cazobalastatelem.tpl" CONT=$elemperc}
				{/if}
{*----
<td class="tdbala" align=right> {$elem.$VARI.$claiid.pay|tomoney2}
----*}
<td class="tdbala" align=right>
{include file="cazobalastatelem.tpl" CONT=$elem.$VARI.$claiid.tax}
{*----
<td class="tdbala" align=right> {$elem.$VARI.$claiid.fee|tomoney2}
----*}
<td class="tdbala" align=right>
{include file="cazobalastatelem.tpl" CONT=$elem.$VARI.$claiid.fee}
<td class="tdbalasuma" align=right>
{include file="cazobalastatelem.tpl" CONT=$elem.$VARI.$claiid.total}
	{/foreach}

{include file="cazobalaexte.tpl"}

				</table>
				