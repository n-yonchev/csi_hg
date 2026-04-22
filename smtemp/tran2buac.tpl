{*
		$FLBUAC 
		$VARI =head =cont 
*}
				{if $FLBUAC==0}
				{elseif $FLBUAC==1}
					{if $VARI=="head"}
<td>бс
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
				{if empty($elem.iban)}
<td align=center> &nbsp;
				{elseif $elem.iban==str_repeat("0",22)}
<td align=center> &nbsp;
				{elseif strlen($elem.iban)<>22}
<td align=center> &nbsp;
				{else}
<td align=center class="buac" rel="#buac{$myid}" title="състояние на сметка" onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.accobudg}'{rdelim});">
{if isset($elem.editbudg)}бс{else}&nbsp;{/if}
<span id="buac{$myid}" style="display: none">
{$elem.iban} {if isset($elem.editbudg)}е{else}НЕ Е{/if} бюджетна сметка
<hr>
<font color=blue>ляв клик - направи я {if isset($elem.editbudg)}НЕбюджетна{else}бюджетна{/if} </font>
</span>
				{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
