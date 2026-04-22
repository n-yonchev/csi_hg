{*
		$FLTEXT 
		$VARI =head =cont 
		$elem, $myid 
*}
				{if $FLTEXT==0}
{*
				{elseif $FLIBAN==5}
					{if $VARI=="head"}
<td>iban
					{elseif $VARI=="cont"}
<td>{$elem.iban}&nbsp;
					{/if}
*}
				{elseif $FLTEXT==1 or $FLTEXT==5}
					{if $VARI=="head"}
<td>осн
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
{*
				{if empty($elem.iban)}
<td class="ibac" rel="#ibac{$myid}" bgcolor="salmon" title="липсва сметка, корегирай" 
				{elseif $elem.iban==str_repeat("0",22)}
<td class="ibac" rel="#ibac{$myid}" bgcolor="salmon" title="грешна сметка, корегирай" 
				{elseif strlen($elem.iban)<>22}
<td class="ibac" rel="#ibac{$myid}" bgcolor="salmon" title="грешна дължина, корегирай" 
				{else}
<td class="ibac" rel="#ibac{$myid}" bgcolor="#dddddd" 
				{/if}
*}
				{assign var=bgco value="salmon"}
				{if empty($elem.text)}
		{assign var=mysu value="липсва основание, корегирай"}
				{elseif !$elem.flagtext}
		{assign var=mysu value="надвишава макс.дължина, корегирай"}
				{else}
		{assign var=mysu value="ляв клик - корегирай основанието"}
		{assign var=bgco value="#dddddd"}
{*
		{assign var=bgco value=""}
*}
				{/if}
<td class="osno" rel="#osno{$myid}" bgcolor="{$bgco}" title="основание" 
							{if $FLTEXT==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.edittext}'{rdelim});"
>виж
							{else}
>виж
							{/if}
<span id="osno{$myid}" style="display: none">
{*
	<table>
	<tr>
<td> IBAN
<td> {$elem.iban}
	<tr>
<td> BIC
<td> {$elem.bic}
	<tr>
<td> банка
<td> {$elem.bankname}
	</table>
*}
{***
	{foreach from=$elem.artext item=elemtext}
{$elemtext}
<br>
	{/foreach}
***}
			{if count($elem.artext)<=1}
{$elem.artext[0]}
			{else}
	<table>
	<tr>
<td> основание за плащане
<td> <b>{$elem.artext[0]}</b>
	<tr>
<td> още пояснения
<td> <b>{$elem.artext[1]}</b>
	</table>
			{/if}
<hr>
<font color=blue>{$mysu}</font>
</span>
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
