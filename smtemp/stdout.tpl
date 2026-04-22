										{if $FLPRIN}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
</style>
								{assign var=bord value="border=1"}		
										{else}
										{/if}
				<table align=center {$bord}>
										{if $FLPRIN}
										{else}
				<tr>
<td colspan=4 align=right> <a class="" href="#" onclick="fuprin('{$CURINT}');">изход в Excel</a>
										{/if}
				<tr>
<td class="hetext" colspan=4> &nbsp; изведени изходящи документи (броя) по деловодители &nbsp;
				<tr>
<td class="hetext" align=center> деловодител
<td class="hetext" align=center> общо
<td class="hetext" align=center> ръчно<br>въвед
<td class="hetext" align=center> ръчно=<br>%общо

		{foreach from=$USERLIST item=username key=ukey}
				<tr>
				{if $ukey==-1}
					{assign var=tdcl value="hetext"}
				{else}
					{assign var=tdcl value="sttext"}
				{/if}
	<td class="{if $ukey==-1}hetext{else}td8{/if}" align=left> 
{if $ukey==0 or $ukey==-9}<font color=red>{else}{/if}
&nbsp;{$username}
{if $ukey==0}</font>{else}{/if}
	<td class="{$tdcl}" align=right> 
{include file="_stcell.tpl" VALUE=$DATA[$ukey].coun}
	<td class="{$tdcl}" align=right> 
{include file="_stcell.tpl" VALUE=$DATA[$ukey].ente}
	<td class="{$tdcl}" align=right> 
<font color=red>
{include file="_percent.tpl" P1=$DATA[$ukey].ente P2=$DATA[$ukey].coun}
</font>
		{/foreach}

				</table>

{include file="_download.tpl"}
