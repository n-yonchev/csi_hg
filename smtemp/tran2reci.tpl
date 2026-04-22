{*
		$FLRECI 
		$VARI =head =cont 
		$elem, $myid 
*}
				{if $FLRECI==0}
				{elseif $FLRECI==1 or $FLRECI==5}
					{if $VARI=="head"}
{***
<td>по<br>луч
***}
<td>име на получателя
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
				{assign var=bgco value="salmon"}
				{if empty($elem.clainame)}
		{assign var=mysu value="липсва получател, корегирай"}
				{elseif !$elem.flagreci}
		{assign var=mysu value="надвишава макс.дължина, корегирай"}
				{else}
{*
		{assign var=mysu value="ляв клик - корегирай име на получателя"}
*}
		{assign var=mysu value="корегирай име на получателя"}
{***
		{assign var=bgco value="#dddddd"}
***}
		{assign var=bgco value=""}
				{/if}
<td class="osno" bgcolor="{$bgco}" title="{$mysu}" 
							{if $FLRECI==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editclai}'{rdelim});"
>{$elem.clainame}
							{else}
>{$elem.clainame}
							{/if}
{*****
<td class="osno" rel="#reci{$myid}" bgcolor="{$bgco}" title="получател" 
							{if $FLRECI==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editclai}'{rdelim});"
>{$elem.clainame}
							{else}
>{$elem.clainame}
							{/if}
<span id="reci{$myid}" style="display: none">
<font color=blue>{$mysu}</font>
</span>
*****}
{***
<td class="osno" rel="#reci{$myid}" bgcolor="{$bgco}" title="име на получателя" 
							{if $FLRECI==1}
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
onclick="$.nyroModalManual({ldelim}forceType:'iframe', url:'{$elem.editclai}'{rdelim});"
>виж
							{else}
>виж
							{/if}
<span id="reci{$myid}" style="display: none">
<b>{$elem.clainame}</b>
<hr>
<font color=blue>{$mysu}</font>
</span>
***}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
