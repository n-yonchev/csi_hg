										{if $FLPRIN}
										{else}
<a class="{if $TYPE=="count"}curr{else}{/if}" href="{$ARLINK.count}">броя</a>
&nbsp;
<a class="{if $TYPE=="amount"}curr{else}{/if}" href="{$ARLINK.amount}">лева</a>
&nbsp;
<a class="" href="#" onclick="fuprin('{$CURINT}');">изход в Excel</a>
										{/if}
										{if $FLPRIN}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
.hesuma {ldelim}background-color:#d0d0d0;{rdelim}
</style>
								{assign var=bord value="border=1"}		
										{else}
<style>
.hesuma {ldelim}background-color:#add8e6; font: normal 8pt verdana;{rdelim}
</style>
										{/if}

					<table>
					<tr>
					<td valign=top>
{include file="stfinacolo.tpl" LIS1=$DATA LIS2=$DATAUSER TEX1="постъпленията" TEX2="" FULL=true}
					<td valign=top>
{include file="stfinacolo.tpl" LIS1=$DATABANK LIS2=$DATAUSERBANK TEX1="БАНКОВИТЕ постъпления" TEX2="БАНКОВИ" FULL=false}
					</table>

										{if $FLPRIN}
										{else}
{include file="_download.tpl"}
										{/if}
