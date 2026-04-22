{*
		$FLFULL 
		$VARI =head =cont 
*}
				{if $FLFULL==0}
				{elseif $FLFULL==1}
					{if $VARI=="head"}
<td>пп
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
						{if $elem.idclaimer<=0}
<td>&nbsp;
						{else}
<td align=center title="{if $elem.isfull==1}пълно погасяване, клик за промяна{else}клик за пълно погасяване{/if}" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.full}>
{if $elem.isfull==1}пп{else}&nbsp;{/if}
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{elseif $FLFULL==5}
					{if $VARI=="head"}
<td>пп
					{elseif $VARI=="cont"}
<td align=center>
{if $elem.isfull==1}пп{else}&nbsp;{/if}
					{else}
					{/if}
				{else}
				{/if}
