{*
	$ARDEFI 
*}
			{assign var=calc value=$ARDEFI.calc}
<b> метод : 
			{if 0}
			{elseif $calc=="inpu"}
директно въвеждане
			{elseif $calc=="fixi"}
фиксирана сума {$ARDEFI.perc} И
			{elseif $calc=="proc"}
{$ARDEFI.perc} % от мат.интерес 
	{if empty($ARDEFI.mini)}
	{else}
минимум= {$ARDEFI.mini} И
	{/if}
	{if empty($ARDEFI.maxi)}
	{else}
максимум= {$ARDEFI.maxi} И
	{/if}
			{else}
???????????
			{/if}
</b>

{***
<br>
действие &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="action"}
<br>
<textarea name="action" id="action" rows=4 cols=65 size=255 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
						<div style="float:left;padding-right:20px;">
основание &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="ground"}
<br>
<input type="text" name="ground" id="ground" {include file="_erelem.tpl" ID="ground" C1="input" C2="inputer"}> 
						</div>
						<div style="float:left;padding-right:20px;">
			{if $calc=="proc"}
мат.интерес &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="interest"}
<br>
<input type="text" name="interest" id="interest" {include file="_erelem.tpl" ID="interest" C1="input" C2="inputer"}> 
			{else}
сума &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="amount"}
<br>
<input type="text" name="amount" id="amount" {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 
			{/if}
						</div>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='добави реда' NAME='subm2' ID='subm2'}
***}

					<table>
					<tr>
<td valign=top> 
действие &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="action"}
	<br>
<textarea name="action" id="action" rows=4 cols=65 size=255 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
<td valign=top>
основание &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="ground"}
	<br>
<input type="text" name="ground" id="ground" {include file="_erelem.tpl" ID="ground" C1="input" C2="inputer"}> 
					<tr>
<td>
			{if $calc=="proc"}
мат.интерес &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="interest"}
<br>
<input type="text" name="interest" id="interest" {include file="_erelem.tpl" ID="interest" C1="input" C2="inputer"}> 
			{else}
сума &nbsp;&nbsp;{include file="_cazobiller.tpl" CODE="amount"}
<br>
<input type="text" name="amount" id="amount" {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}> 
			{/if}
<td>
{include file='_but2.tpl' TYPE='submit' TITLE='добави реда' NAME='subm2' ID='subm2'}
					</table>

