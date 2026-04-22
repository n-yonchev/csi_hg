<style>
.c1 {ldelim}font: normal 8pt verdana; border-bottom: 1px solid silver !important; padding: 2px 2px 2px 2px;{rdelim}
.c1link {ldelim}font: normal 8pt verdana; background-color:#dddddd; padding: 2px 2px 2px 2px; cursor:pointer;{rdelim}
.c1head {ldelim}font: bold 8pt verdana; background-color:#dfe8f6; padding: 2px 2px 2px 2px; letter-spacing:2;{rdelim}
</style>
						{assign var="sp" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}
				<table align=center>
				<tr>
<td class="c1head" align=center colspan=9> брой на делата за отчета
				<tr>
<td class="c1"> общо
<td class="c1" align=right> {$COUNTOTA.tota|tointe}
<td class="c1" width=30> &nbsp;

				<tr>
<td class="c1"> не влизат, по причини :
<td class="c1" align=right> {$COUNTOTA.out|tointe}
<td class="c1"> &nbsp;
		{foreach from=$ARMESS item=txmess key=ekey}
				<tr>
<td class="c1"> {$sp} {$txmess}
<td colspan=2 class="c1link" align=right onclick="document.location.href='{$ERLINK[$ekey]}';"> {$sp} {$LISTCOUN[$ekey]|tointe}
		{/foreach}

				<tr>
<td class="c1"> влизат, по редове :
<td class="c1" align=right> {$COUNTOTA.in|tointe}
<td class="c1"> &nbsp;
		{foreach from=$ARROTYPE item=elem}
				<tr>
<td class="c1"> {$sp} [{$REPOCODE[$elem]}] {$VIEWREPO[$elem]}
<td colspan=2 class="c1link" align=right onclick="document.location.href='{$ROLINK[$elem]}';"> {$sp} {$LISTINRE[$elem]|tointe}
		{/foreach}
				</table>
				