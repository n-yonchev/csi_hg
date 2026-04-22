{*
		$FLIBAN 
		$VARI =head =cont 
		$myid 
*}
				{if $FLIBAN==0}
				{elseif $FLIBAN==1 or $FLIBAN==5}
					{if $VARI=="head"}
<td>IBAN
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
				{assign var=bgco value="salmon"}
				{if empty($elem.iban)}
		{assign var=mysu value="липсва сметка, корегирай"}
				{elseif $elem.iban==str_repeat("0",22)}
		{assign var=mysu value="грешна сметка, корегирай"}
				{elseif strlen($elem.iban)<>22}
		{assign var=mysu value="дължината не е 22 симв, корегирай"}
				{elseif strlen($elem.ibaniser<>0)}
		{assign var=mysu value="грешен IBAN, корегирай"}
				{else}
					{*
					{if empty($elem.bic)}
		{assign var=mysu value="липсва BIC, корегирай"}
					{elseif strlen($elem.bic)<>8}
		{assign var=mysu value="грешна дължина BIC, корегирай"}
					{else}
					*}
						{if $elem.idbank==$INDXBANKPOST and empty($elem.bankname)}
		{assign var=mysu value="липсва име на банка, корегирай"}
						{else}
		{assign var=mysu value="ляв клик - корегирай сметката"}
		{assign var=bgco value="#dddddd"}
						{/if}
					{*
					{/if}
					*}
				{/if}
<td class="ibac" rel="#ibac{$myid}" bgcolor="{$bgco}" title="информация за сметката" 
							{if $FLIBAN==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editiban}'{rdelim});"
>{$elem.iban}
							{else}
>{$elem.iban}
							{/if}
<span id="ibac{$myid}" style="display: none">
	<table>
	<tr>
<td> IBAN
<td> <b>{$elem.iban}</b>
{*
	<tr>
<td> BIC
<td> {$elem.bic}
*}
	<tr>
<td> банка
<td> <b>{$elem.bankname}</b>
	</table>
<hr>
<font color=blue>{$mysu}</font>
</span>
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
