{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="изключване постъпление от списъка преводи" WITDH=840}
{include file="_erform.tpl"}
<style>
td {ldelim}font:normal 8pt verdana;border-bottom: 1px solid silver;{rdelim}
.pseu {ldelim}font: normal 8pt verdana; color:red;{rdelim}
</style>

		<table>
		<tr bgcolor=silver>
<td colspan=10> постъпление
		<tr bgcolor=silver>
<td align=right> сума
<td> от къде
<td> кога
<td> длъжник
		<tr>
<td align=right> {$DATAFINA.inco|tomoney2}
				{assign var="idtype" value=$DATAFINA.idtype}
				{assign var=bankname value=$ARBANK[$DATAFINA.codebank]}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$DATAFINA.idfinabank|cat:"-"|cat:$bankname}
				{else}
					{assign var="finaba" value=""}
				{/if}
				{assign var=debtdata value=$DEBTLIST[$elem.iddebtor]}
<td> <nobr>{$ARTYPE.$idtype|cat:$finaba}</nobr>
<td>
						{if $idtype==1}
<nobr>{$DATAFINA.finadate} {$DATAFINA.finahour}</nobr>
						{elseif $idtype==2}
<nobr>{$DATAFINA.cashdate}</nobr>
						{else}
&nbsp;
						{/if}
<td> {$DEBTNAME}&nbsp;
		</table>

{**}
		<table>
		<tr bgcolor=silver>
<td colspan=10> разпределения
		<tr bgcolor=silver>
<td align=right> разпред<br>сума
<td> за взискател
<td> сума<br>за превод
<td> от банка
<td> опис
<td> пакет
<td> ръчен
{foreach from=$ARTRAN[$TOFINA] item=elem key=idclai}
								<tr>
<td class="trow" align=right> {$elem.suma|tomoney2}
			{if $idclai<=0 and $idclai<>-1}
<td class="trow pseu" > {$elem.clainame}&nbsp;
			{else}
<td class="trow"> {$elem.clainame}
			{/if}
<td class="trow" align=right> {$elem.amount|tomoney2}
<td class="trow"> {$ARBANKPAYM[$elem.idbank]}
{*---- доп.полета за превода ----*}
						{if $elem.idinve==0}
<td bgcolor=#dddddd>&nbsp;
						{else}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idinvestat]}"> 
{$elem.idinve}
						{/if}
						{if $elem.idinve==0}
		{if $elem.idpack==0}
<td bgcolor=#dddddd>&nbsp;
		{else}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idpackstat]}"> 
{$elem.idpack}
		{/if}
						{else}
		{if $elem.idinvepack==0}
<td bgcolor=#dddddd>&nbsp;
		{else}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idinvepackstat]}"> 
{$elem.idinvepack}
		{/if}
						{/if}
						{if $elem.idstat==9}
<td bgcolor=#dddddd> превед
						{elseif $elem.idstat==6}
<td bgcolor=#dddddd> отлож
						{else}
<td bgcolor=#dddddd>&nbsp;
						{/if}
{/foreach}
		</table>
{**}

<br>
					{if $ISEXCLUDE}
{include file='_button.tpl' TYPE='submit' TITLE='изключи' NAME='submit' ID='submit'}
					{else}
ВНИМАНИЕ.
<br>
НЕ МОЖЕ да изключите разпределенията по това постъпление от списъка с преводи.
За да стане възможно това, е необходимо :
<br>
<br>
- да няма директно преведена сума
<br>
<br>
- всяка от разпределените суми 
<br>
или да не е включена в опис/пакет,
<br>
или да е включена в актуален опис/пакет (зелен)
<br>
<br>
					{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
