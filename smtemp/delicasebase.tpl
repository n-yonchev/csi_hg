<style>
.desc {ldelim}font:normal 10pt verdana;{rdelim}
.h2 {ldelim}font: normal 8pt verdana; background-color:#bbbbbb;{rdelim}
.r1 {ldelim}font: normal 8pt verdana;{rdelim}
.r2 {ldelim}font: normal 8pt verdana; border-bottom:1px solid black;{rdelim}
.addr {ldelim}font:normal 7pt verdana;color:blue;{rdelim}
.wait {ldelim}font:normal 7pt verdana !important;color:red !important;{rdelim}
{*
.link {ldelim}font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;{rdelim}
.budg {ldelim}font: normal 8pt verdana; background-color:wheat;cursor:pointer;{rdelim}
.pseu {ldelim}font: normal 8pt verdana; color:red;{rdelim}
.locked {ldelim}font: normal 8pt verdana; background-color:salmon;padding-left:4px;padding-right:4px;{rdelim}
.curr2 {ldelim}cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;background-color:wheat;{rdelim}
.vari2 {ldelim}cursor:pointer;font:normal 8pt verdana;padding:1px 6px;border-bottom: 1px solid brown;color:brown;{rdelim}
.stat1 {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:thistle;{rdelim}
.stat2 {ldelim}cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:magenta;{rdelim}
.stat2ok {ldelim}font:bold 7pt verdana;color:white;{rdelim}
.seye {ldelim}font:normal 8pt verdana;{rdelim}
*}
</style>
									<table align=center>
{*
						{if isset($smarty.session.backpage) and !$NOBACKPAGE}
									<tr>
<td colspan=20> 
<span class="link" {include file="_href.tpl" LINK=$smarty.session.backlink}> назад към стр.{$smarty.session.backpage} от списъка </span>
						{else}
						{/if}
*}
									<tr>
<td class="desc">
дело <b>{$DATACASE.serial}/{$DATACASE.year}</b> деловодител <b>{$DATACASE.username}</b>
									<tr>
						<td rowspan=2 valign=top>
						<table align=center>
						<tr>
<td class="h2" colspan=9 align=center> осн.данни по делото
			<tr>
<td class="r1"> образувано на
<td class="r2"> {$DATACASE.created|date_format:"%d.%m.%Y"}
			<tr>
<td class="r1"> описание
<td class="r2"> {$DATACASE.text}
			<tr>
<td class="r1"> идва от
<td class="r2"> {$ARFROM[$DATACASE.idcofrom]}
	{if empty($DATACASE.cogrou)}
	{else}
/ състав {$DATACASE.cogrou}
	{/if}
			<tr>
<td class="r1"> изп.титул
<td class="r2"> {$ARTITU[$DATACASE.idtitu]}
						{if $DATACASE.idtitu==1}
от {$DATACASE.dateexec}
						{else}
						{/if}
			<tr>
<td class="r1"> вид номер/год
<td class="r2"> {$ARSORT[$DATACASE.idsort]} {$DATACASE.conome}/{$DATACASE.coyear}
			<tr>
<td class="r1"> текущ статус
<td class="r2"> {$ARSTAT[$DATACASE.idstat]}
			<tr>
<td class="r1"> вземане произход
<td class="r2"> {$DATACASE.origtext}
						</table>
						<td rowspan=2 width=14> &nbsp;
						<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=9 align=center> взискатели по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
				{foreach from=$CLAILIST item=elem}
									<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
						{if empty($elem.address)}
						{else}
									<tr>
<td class="addr" colspan=2> &nbsp;
<td class="addr" colspan=3> {$elem.address}
						{/if}
				{/foreach}
						</table>
									<tr>
						<td valign=top>
						<table>
						<tr>
<td class="h2" colspan=6 align=center> длъжници по делото
									<tr>
<td class="h2"> ЕИК
<td class="h2"> ЕГН
<td class="h2"> име
				{foreach from=$DEBTLIST item=elem}
									<tr>
<td class="r2"> {$elem.bulstat}&nbsp;
<td class="r2"> {$elem.egn}&nbsp;
<td class="r2"> {$elem.name}&nbsp;
						{if empty($elem.address)}
						{else}
									<tr>
<td class="addr" colspan=2> &nbsp;
<td class="addr" colspan=3> {$elem.address}
						{/if}
				{/foreach}
						</table>
									</table>

