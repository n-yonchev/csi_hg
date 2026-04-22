{*
		$FLBACK 
		$VARI =head =cont 
*}
				{if $FLBACK==0}
				{elseif $FLBACK==1}
					{if $VARI=="head"}
<td>вър<br>нат
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
<td align=center>
					{if $elem.idstat==3}
върн
					{else}
&nbsp;
					{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
