{*
		$FLBICC 
		$VARI =head =cont 
*}
				{if $FLBICC==0}
				{elseif $FLBICC==1 or $FLBICC==5}
					{if $VARI=="head"}
<td>BIC
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
				{if empty($elem.bic)}
<td bgcolor="salmon" title="липсва кода, корегирай" 
				{elseif strlen($elem.bic)<>8}
<td bgcolor="salmon" title="грешна дължина, корегирай" 
				{else}
<td bgcolor="#dddddd" 
				{/if}
							{if $FLBICC==1}
title="корегирай сметката за превода" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editiban}'{rdelim});"
>{$elem.bic}
							{else}
>{$elem.bic}
							{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
