{*
		$FLBANK 
		$VARI =head =cont 
*}
				{if $FLBANK==0}
				{elseif $FLBANK==1}
					{if $VARI=="head"}
<td>от банка
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
<td title="корегирай банката" 
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.bank}>
{$ARBANKPAYM[$elem.idbank]}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{elseif $FLBANK==5}
					{if $VARI=="head"}
<td>от банка
					{elseif $VARI=="cont"}
<td>
{$ARBANKPAYM[$elem.idbank]}
					{else}
					{/if}
				{else}
				{/if}
