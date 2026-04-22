{*
		$FLINVE 
		$VARI =head =cont 
*}
				{if $FLINVE==0}
				{elseif $FLINVE==1}
					{if $VARI=="head"}
<td>за<br>опис
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
					{if $elem.islist==1}
{*
<td align=center title="{$elem.trandesc}, клик за промяна">
заоп
*}
						{if $elem.isnolist==0}
{*
<td align=center title="включен в опис {$elem.trandesc}, клик за изключване"
*}
<td align=center title="може да се включи в опис &quot;{$elem.trandesc}&quot;, клик за забрана"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.noli}>
да
						{else}
{*
<td align=center title="ИЗключен от опис {$elem.trandesc}, клик за включване"
*}
<td align=center title="НЯМА да се включва в опис &quot;{$elem.trandesc}&quot;, клик за разрешение"
onmouseover="$(this).addClass('dire');" onmouseout="$(this).removeClass('dire');"
{include file="_href.tpl" LINK=$elem.noli}>
<font color=red>не</font>
						{/if}
					{else}
<td align=center>
&nbsp;
					{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{elseif $FLINVE==5}
					{if $VARI=="head"}
<td>опис
					{elseif $VARI=="cont"}
{*
<td align=center>{if $elem.idinve==0}&nbsp;{else}{$elem.idinve}{/if}
*}
						{if $elem.idinve==0}
<td>&nbsp;
						{else}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idinvestat]}"> 
{$elem.idinve}
						{/if}
					{/if}
				{else}
				{/if}
