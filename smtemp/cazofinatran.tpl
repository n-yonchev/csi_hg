{*
		$elem $myid 
*}
				<table align=center>
				<tr>
<td class="he4" align=right> разпред<br>сума
<td class="he4"> взискател
<td class="he4" align=right> сума<br>за превод
<td class="he4"> от<br>банка
<td class="he4"> опис
<td class="he4"> пакет
<td class="he4"> ръчен<br>превод
<td class="he4"> преведена
{**}
		{foreach from=$EXLIST[$myid] item=elclai key=idclai}
				<tr>
<td class="ro4" align=right> {$elclai.suma|tomoney2}
				{if $idclai<0}
<td class="ro4"> {$PSEUCLAINAME[$idclai]}
				{else}
<td class="ro4"> {$CLAILIST[$idclai]}
				{/if}
<td class="ro4" align=right> {$elclai.amount|tomoney2}
<td class="ro4"> {$ARBANKPAYM[$elclai.idbank]}
						{if $elclai.idinve==0}
<td class="ro4">&nbsp;
						{else}
<td class="ro4" align=center bgcolor="{$ARPACKCOLO[$elclai.idinvestat]}"> 
{$elclai.idinve}
						{/if}
						{if $elclai.idinve==0}
		{if $elclai.idpack==0}
<td class="ro4">&nbsp;
		{else}
<td class="ro4" align=center bgcolor="{$ARPACKCOLO[$elclai.idpackstat]}"> 
{$elclai.idpack}
		{/if}
						{else}
		{if $elclai.idinvepack==0}
<td class="ro4">&nbsp;
		{else}
<td class="ro4" align=center bgcolor="{$ARPACKCOLO[$elclai.idinvepackstat]}"> 
{$elclai.idinvepack}
		{/if}
						{/if}
<td class="ro4" align=center>
						{if $elclai.idstat==9}
преведена
						{elseif $elclai.idstat==6}
отложена
						{else}
&nbsp;
						{/if}
<td class="ro4">
{*
{$elclai.idpackstat}/{$elclai.idinvepackstat}/{$elclai.packstatmodi}
*}
						{if $elclai.idstat==9}
{$elclai.finastatmodi|date_format:'%d.%m.%Y'}
{*
						{elseif $elclai.idpackstat==2 or $elclai.idinvepackstat==2}
{$elclai.packstatmodi|date_format:'%d.%m.%Y'}
*}
						{elseif $elclai.idpackstat==2}
{$elclai.packstatmodi|date_format:'%d.%m.%Y'}
						{elseif $elclai.idinvepackstat==2}
{$elclai.invepackstatmodi|date_format:'%d.%m.%Y'}
						{else}
не
						{/if}
		{/foreach}
{**}
				</table>
