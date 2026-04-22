{*
		$FLRING 
		$VARI =head =cont 
*}
				{if $FLRING==0}
				{elseif $FLRING==1}
					{if $VARI=="head"}
<td>rin<br>gs
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
{*
						{if $elem.idclaimer<=0}
<td>&nbsp;
						{else}
<td align=center title="{if $elem.isring==1}включен RINGS, клик за изключване{else}клик за включване на RINGS{/if}" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.ring}>
{if $elem.isring==1}ri{else}&nbsp;{/if}
						{/if}
*}
<td align=center title="{if $elem.isring==1}включен RINGS, клик за изключване{else}клик за включване на RINGS{/if}" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.ring}>
{if $elem.isring==1}ri{else}&nbsp;{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{elseif $FLRING==5}
					{if $VARI=="head"}
<td>rin<br>gs
					{elseif $VARI=="cont"}
<td align=center>
{if $elem.isring==1}ri{else}&nbsp;{/if}
					{else}
					{/if}
				{else}
				{/if}
