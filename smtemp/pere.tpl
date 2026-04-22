<style>
.link {ldelim}font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.culink {ldelim}font:normal 8pt verdana;cursor:pointer;padding:1px 6px;border-bottom: 1px solid brown;color:brown;background-color:khaki;{rdelim}
.poin {ldelim}cursor:pointer;{rdelim}
.mark {ldelim}background-color:lightgreen;{rdelim}
</style>
				
					<table align=center>
								{if $NOVARI}
								{else}
					<tr>
					<td>
{foreach from=$ARVARI item=elem key=ekey}
&nbsp;
<a class="{if $ekey==$VARI}culink{else}link{/if}" {include file="_href.tpl" LINK=$ARLINK[$ekey]}> {$elem} 
{if isset($ARCOUN[$ekey])}[<span id="coun{$ekey}">{if $ARCOUN[$ekey]==0}<font color=red size=+1>ÕﬂÃ¿</font>{else}{$ARCOUN[$ekey]}{/if}</span>]{else}{/if} 
</a>
{/foreach}
								{/if}
					<tr>
					<td>
<br>
{$VARICONT}
					</table>
