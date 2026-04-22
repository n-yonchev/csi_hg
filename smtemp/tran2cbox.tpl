{*
		$FLCBOX 
		$VARI =head =cont 
*}
{*
{$FLCBOX}
*}
				{if $FLCBOX==0}
				{else}
					{if $VARI=="head"}
<td align=center>
						{if $FLCBOX==1}
&nbsp;
						{elseif $FLCBOX==2}
<a href="#" onclick="exdeinve(); return false;"> 
<img src="images/exclude.gif" title="изключи маркираните от описа">
</a>
						{elseif $FLCBOX==3}
&nbsp;
						{elseif $FLCBOX==4}
<a href="#" onclick="exdepack(); return false;"> 
<img src="images/exclude.gif" title="изключи маркираните от ПАКЕТА">
</a>
						{elseif $FLCBOX==5}
<a href="#" onclick="inclmark(); return false;"> 
{*
<img src="images/include.gif" title="превърни маркираните в директно преведени">
*}
<img src="images/include.gif" title="превърни маркираните в отложени за ръчен превод">
</a>
						{elseif $FLCBOX==6}
<a href="#" onclick="exdemark(); return false;"> 
<img src="images/exclude.gif" title="превърни маркираните обратно в чакащи">
</a>
						{else}
&nbsp;
						{/if}
					{elseif $VARI=="cont"}
{*------------------------------------------------------------*}
<td align=center>
						{if $FLCBOX==6 and $elem.idstat==9}
						{else}
<input type=checkbox id="cb{$elem.cbcode}" bank="{$elem.idbank}">
						{/if}
{*------------------------------------------------------------*}
					{else}
					{/if}
				{/if}
