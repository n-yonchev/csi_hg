{include file="_ajax.header.tpl"}
{***
{include file='_window.header.tpl' TITLE="приключване на постъпление по дело "|cat:$ROCASE.serial|cat:"/"|cat:$ROCASE.year}
***}
{include file='_window.header.tpl' TITLE="приключване на постъпление"}
{include file="_erform.tpl"}
<style>
.h6 {ldelim}font:bold 10pt verdana;{rdelim}
</style>

				{*---- за отключването след exit ----*}
				<font color=red><span id="{$NYREMO.idzone}"></span></font>

				{***
статус на делото 
				{if $ROCASE.idstat==0 or $ROCASE.idstat==24}
<b>{$ARSTAT[$ROCASE.idstat]}</b>
				{else}
<br>
<font color=red size=+1>
<b>{$ARSTAT[$ROCASE.idstat]}</b>
</font>
				{/if}
				***}

		<table bgcolor=beige>
		<tr>
<td> по изп.дело
<td class="h6"> {$ROCASE.serial|cat:"/"|cat:$ROCASE.year}
		<tr>
<td> статус на делото
<td class="h6">
				{if $ROCASE.idstat==0 or $ROCASE.idstat==24}
{$ARSTAT[$ROCASE.idstat]}
				{else}
<font color=red>
{$ARSTAT[$ROCASE.idstat]}
</font>
				{/if}
		<tr>
<td> сума на постъплението
<td class="h6"> {$DATA.inco|tomo3}
		</table>
{***
<br>
<br>
<div style="background-color:tomato;color:white;font:bold 10pt verdana;text-align:center;letter-spacing:180%">вариант 1</div>

Маркиране на постъплението <font size=+1><b>{$DATA.inco|tomo3}</b></font>
като СТАРО ПРИКЛЮЧЕНО.
<br>
<br>
Това означава, че постъплението е било <b>реално приключено</b> преди сегашния момент,
<br>
но досега не е било маркирано като приключено.
<br>
<nobr>
Приключването означава, че разпределените суми вече са преведени на взискателите.
</nobr>
<br>
След маркирането няма да може да променяте данните за това постъпление.
<br>
<br>
дата на <b>реалното приключване</b>
<br>
<input type="text" name="datebala" id="datebala" size=20 {include file="_erelem.tpl" ID="datebala" C1="input" C2="inputer"}> 
								{if $FLAGOLD}
<br>
дата на приключване - задължителна за старо постъпление
<br>
<input type="text" name="dateclos" id="dateclos" size=20 {include file="_erelem.tpl" ID="dateclos" C1="input" C2="inputer"}> 
								{else}
								{/if}
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='маркирай като старо приключено' NAME='submclos' ID='submclos'}
&nbsp;&nbsp;

<br>
<br>
<div style="background-color:tomato;color:white;font:bold 10pt verdana;text-align:center;letter-spacing:180%">вариант 2</div>

<nobr>
Маркиране на постъплението <font size=+1><b>{$DATA.inco|tomo3}</b></font>
като ГОТОВО ЗА ПРЕВОД.
</nobr>
<br>
<br>
***}
<br>
<nobr>
Ще маркирате постъплението като ГОТОВО ЗА ПРЕВОД.
</nobr>
<br>
<nobr>
След маркирането няма да може да променяте данните за това постъпление.
</nobr>

<br>
{foreach from=$ARFINA item=elem key=idclai}
	{if $idclai>0 and empty($elem.iban)}
<div class="no"> ВНИМАНИЕ.</div>
<div class="no"> липсва IBAN за сумата {$elem.suma} към взискател {$elem.clainame}
</div>
	{else}
	{/if}
	{if $idclai>0 and $elem.ibaniser}
<div class="no"> ВНИМАНИЕ.</div>
<div class="no"> ГРЕШЕН IBAN за сумата {$elem.suma} към взискател {$elem.clainame}
</div>
	{else}
	{/if}
{/foreach}

{*---- 13.10.2016 - евент.планирана такса по т.26 ----*}
 						{if $SUMA26==0}
						{else}
<br>
ВНИМАНИЕ.
<br>
Ще бъде формирана планирана такса в размер <b>{$SUMA26|tomoney2}</b> € 
<br>
за т.26 с платец длъжника <b>{$DEBTNAME}</b>
						{/if}

<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='маркирай постъплението' NAME='submtran' ID='submtran'}
като готово за превод
<br>&nbsp;

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
