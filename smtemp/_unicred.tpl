{include file="_base.header.tpl"}
<style>
td {ldelim}font: normal 8pt verdana{rdelim}
.head {ldelim}font: normal 8pt verdana; background-color:#dddddd{rdelim}
</style>

{*---- обща статистика ----*}
					<table align=center cellpadding=6>
					<tr>
<td colspan=5> Статистика за дългове по изп.лист с взискател Уникредит
					<tr>
<td class="head" rowspan=2> период
<td class="head" colspan=2> за периода
<td class="head" colspan=2> с натрупване
					<tr>
<td class="head" align=right> дела
<td class="head" align=right> дълг
<td class="head" align=right> дела
<td class="head" align=right> дълг
		{foreach from=$ARPLAN item=text key=ekey}
					<tr>
<td> {$text}
<td align=right> {$ARSTAT.$ekey[0]}
<td align=right> {$ARSTAT.$ekey[1]|tomo3}
<td align=right> {$SUSTAT.$ekey[0]}
<td align=right> {$SUSTAT.$ekey[1]|tomo3}
		{/foreach}
					</table>

{*---- детайлни списъци по месеци ----*}
		{foreach from=$ARDATA item=eldata key=ekey}
<br>
					<table align=center cellpadding=2>
					<tr>
<td class="head" colspan=5> списък на дължимите суми по изп.лист по дела образувани "{$ARPLAN.$ekey}"
					<tr>
<td class="head"> дело
<td class="head"> деловодител
<td class="head"> тип
<td class="head"> описание
<td class="head" align=right> сума
						{assign var="cuseryea" value=""}
			{foreach from=$eldata item=elem}
					<tr>
{*
<td> {$elem.serial}/{$elem.year}
*}
						{assign var="seryea" value=$elem.serial|cat:"/"|cat:$elem.year}
				{if $seryea==$cuseryea}
<td> &nbsp;
<td> &nbsp;
				{else}
<td> {$seryea}
<td> {$elem.username}
						{assign var="cuseryea" value=$seryea}
				{/if}
				{assign var="arindx" value=$elem.idsubtype}
			{if empty($ARSUBT.$arindx)}
				{assign var="txsubtype" value=""}
			{else}
				{assign var="txsubtype" value="/"|cat:$ARSUBT.$arindx}
			{/if}
<td> {$ARTYPE[$elem.idtype]}{$txsubtype}
<td> {$elem.text}
<td align=right> {$elem.amount|tomo3}
			{/foreach}
					</table>
		{/foreach}

{include file="_base.footer.tpl"}
