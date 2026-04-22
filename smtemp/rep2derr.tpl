<style>
.c1 {ldelim}font: normal 8pt verdana; border-bottom: 1px solid silver !important; padding: 2px 8px;{rdelim}
.c1link {ldelim}font: normal 8pt verdana; background-color:#dddddd; padding: 2px 8px; cursor:pointer;{rdelim}
.c1head {ldelim}font: normal 8pt verdana; background-color:#dfe8f6; padding: 2px 8px;{rdelim}
.c1he2 {ldelim}font: bold 8pt verdana; background-color:#dfe8f6; padding: 2px 8px;{rdelim}
</style>
				<table align=center class="d_table">
				<tr>
<td class="c1he2" colspan=20> {$REHEAD}
				<tr>
<td class="c1head"> дело
<td class="c1head"> образувано
<td class="c1head"> ред за отчета
<td class="c1head"> последен статус преди периода
<td class="c1head"> време
						{if $ARTEXTER}
<td class="c1head"> не влиза поради
						{else}
						{/if}
		{foreach from=$DATA item=elem}
				<tr>
<td class="c1"> {$elem.serial}/{$elem.year}
<td class="c1"> {$elem.created|date_format:"%d.%m.%Y"}
<td class="c1"> {$ARREPO[$elem.idrepo]}
<td class="c1"> {$ARSTAT[$elem.statbefo]}
<td class="c1"> {$elem.timebefo|date_format:"%d.%m.%Y"}
						{if $ARTEXTER}
<td class="c1"> {$ARTEXTER[$elem.iderror]}
						{else}
						{/if}
		{/foreach}
{include file="_pagina.tr.tpl"}
				</table>
