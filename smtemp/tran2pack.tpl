{*
		$FLPACK 
		$VARI =head =cont 
*}
				{if $FLPACK==0}
				{elseif $FLPACK==5}
					{if $VARI=="head"}
<td>пакет
					{elseif $VARI=="cont"}
						{if $elem.idinve==0}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idpackstat]}"> 
		{if $elem.idpack==0}
&nbsp;
		{else}
{$elem.idpack}
		{/if}
						{else}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idinvepackstat]}"> 
		{if $elem.idinvepack==0}
&nbsp;
		{else}
{$elem.idinvepack}
		{/if}
						{/if}
					{/if}
				{else}
				{/if}
