{*
		$FLEDIT 
		$VARI =head =cont 
*}
				{if $FLEDIT==0}
				{elseif $FLEDIT==1}
					{if $VARI=="head"}
<td> &nbsp;
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
						{if $elem.trancode=="nop" or $elem.trancode=="t26"}
<td> &nbsp;
						{else}
<td align=center>
<a href="{$elem.editiban}" class="nyroModal" target="_blank">
<img src="images/edit.png" title="корегирай сметката">
</a>
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{else}
				{/if}
