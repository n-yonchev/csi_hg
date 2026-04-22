	<table cellspacing=0 cellpadding=0>
		{*---- сумите по взискатели ----*}
		{if count($elem.clailist)==0}
	<tr>
<td colspan=3> няма взискатели
		{else}
			{foreach from=$elem.clailist item=clainame key=idclai}
				{if $elem.claiamou.$idclai==0}
				{else}
	<tr>
<td> {$clainame}
	<td width=10>
<td align=right> <b> {$elem.claiamou.$idclai|tomo3} </b>
				{/if}
			{/foreach}
		{/if}
{*---- ЧСИ ----*}
				{if $elem.separa==0}
				{else}
	<tr>
	<td> ЧСИ неолихвяеми
	<td width=10>
<td align=right> <b> {$elem.separa|tomo3} </b>
				{/if}
				{if $elem.separa2==0}
				{else}
	<tr>
	<td> ЧСИ т.26
	<td width=10>
<td align=right> <b> {$elem.separa2|tomo3} </b>
				{/if}
{*---- връщане ----*}
				{if $elem.back==0}
				{else}
	<tr>
	<td> връщане
	<td width=10>
<td align=right> <b> {$elem.back|tomo3} </b>
				{/if}
{*---- банк.такси ----*}
					{if $ISBANKTAX}
	<tr>
	<td> банкови такси
	<td width=10>
<td align=left> <b> {$elem.banktax|tomo3} </b>
					{else}
					{/if}
	</table>
