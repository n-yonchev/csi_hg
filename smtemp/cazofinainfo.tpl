	<table align=center>
{*---- сумата, датата на постъпване - според типа ----*}
	<tr>
	<td align=left valign=top colspan=4> сума
<div style="margin-left:10px;">
<b>{$elem.inco}</b>
</div>
	<tr>
	<td align=left valign=top colspan=4> 
					{if $elem.banktype==1}
време на постъпване в банката
					{else}
време на въвеждане 
					{/if}
<div style="margin-left:10px;">
<b>{$elem.banktime|date_format:"%d.%m.%Y %H:%M:%S"}</b>
</div>
{*--------------------------------------------*}
	<tr>
	<td align=left valign=top colspan=4> описание
<div style="margin-left:10px;">
<b>{$elem.descrip}</b>
</div>
			{*---- само за в_брой = ПКО ----*}
			{if $elem.idtype==2}
	<tr>
	<td align=left valign=top colspan=4> прих.касов ордер
<div style="margin-left:10px;">
номер <b>{$elem.cashserial}/{$elem.cashyear}</b>
<br>
дата <b>{$elem.cashdate}</b>
<br>
вносител <b>{$elem.cashname}</b>
</div>
			{else}
			{/if}
	<tr>
	<td align=left valign=top colspan=4> последна корекция
<div style="margin-left:10px;">
<b>
{$elem.time|date_format:"%d.%m.%Y"}
{$elem.time|date_format:"%H:%M:%S"}
{$elem.finaname}
</b>
</div>

	<tr>
	<td align=right valign=top> за ЧСИ неолихвяеми
	<td width=10>
<td align=left valign=top> <b> {$elem.separa|tomo3} </b>
	<tr>
	<td align=right valign=top> за ЧСИ т.26
	<td width=10>
<td align=left valign=top> <b> {$elem.separa2|tomo3} </b>
		{*---- сумите по взискатели ----*}
		{if count($elem.clailist)==0}
	<tr>
<td align=right valign=top colspan=3> няма взискатели
		{else}
			{foreach from=$elem.clailist item=clainame key=idclai}
	<tr>
<td align=right valign=top> за взискател {$clainame}
	<td width=10>
<td align=left valign=top> <b> {$elem.claiamou.$idclai} </b>
			{/foreach}
		{/if}
{*---- за връщане ----*}
	<tr>
	<td align=right valign=top> за връщане
	<td width=10>
<td align=left valign=top> <b> {$elem.back|tomo3} </b>
{*---- за банк.такси ----*}
					{if $ISBANKTAX}
	<tr>
	<td align=right valign=top> за банкови такси
	<td width=10>
<td align=left valign=top> <b> {$elem.banktax|tomo3} </b>
					{else}
					{/if}
	</table>
