

		<table class="d_table" align=center cellpadding=0 cellspacing=0>
		<thead>
		<tr>
			<td class="d_table_title" colspan=10>
списък на изходящите пакети
		</thead>
		<tbody style='font-size:14px;'>
{*---- статистика -------------------------------*}
		{assign var=txready value="готови за включване в нов пакет"}
			<tr>
			<td class="none" colspan=10 align=right>
		{if $COUNPA==0}
			няма невключени плащания
		{else}
			има общо <b>{$COUNPA}</b> невключени плащания
			<img src="images/open.gif" title="виж списъка" style="cursor:pointer" onclick="document.location.href='{$VIEWALL}';"> <br> от тях
	{if $COUNREADY==0}
		<b>няма</b> {$txready}
	{elseif $COUNREADY==$COUNPA}
		<b>всички</b> са {$txready}
	{else}
		<b>{$COUNREADY}</b> са {$txready}
		<img src="images/open.gif" title="виж списъка" style="cursor:pointer" onclick="document.location.href='{$VIEWREADY}';">
	{/if}
		{/if}
		
{*---- бутон за общия списък -----------------------------*}
{*----
		{if $COUNPA==0}
		{else}
<img src="images/edit.png" title="виж списъка" style="cursor:pointer" onclick="document.location.href='{$VIEWLIST}';">
		{/if}
----*}
{*---- бутон за нов пакет -----------------------------*}
		{if $COUNREADY==0}
		{else}
<br>
може да формирате нов пакет от {$COUNREADY} плащания
<br>
<br>
{include file='_button.tpl' HREF=$ADDNEW TITLE='формирай'}
{*<span class="submit"><a href="{$ADDNEW}"> формирай </a></span> *}
		{/if}
</table>

<br />
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на изходящите пакети</td>
		</tr>
	</thead>
	
{*---- антетка -----------------------------*}
		<tr class='header'>
			<td> номер </td>
			<td class='sep'>&nbsp;</td>
			<td> формиран </td>
			<td class='sep'>&nbsp;</td>
			<td> брой плащания </td>
			<td class='sep'>&nbsp;</td>
			<td> обща сума </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			
			
		{foreach from=$LIST item=elem key=ekey}
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
			<td align=center> {$elem.serial}</td>
			<td class='sep'>&nbsp;</td>
			<td> {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"}</td>
			<td class='sep'>&nbsp;</td>
			<td align=center> {$elem.coun}&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td align=right> {$elem.amou|tomoney2}</td>
			<td class='sep'>&nbsp;</td>
			<td align=center> <img src="images/down.gif" title="свали файла" style="cursor:pointer" onclick="xmldown('{$elem.down}');"></td>
			<td class='sep'>&nbsp;</td>
			<td align=center> <a href="{$elem.view}" class="nyroModal" target="_blank"><img src="images/view.png" title="виж файла"></a></td>
			<td class='sep'>&nbsp;</td>
						{if $elem.serial==$MAXSER}
			<td align=center> <img src="images/free.gif" title="анулирай пакета" style="cursor:pointer"	onclick="document.location.href='{$elem.cancel}';"></td>
						{else}
			<td>&nbsp;</td>
						{/if}
			</tr>
		{/foreach}
{include file="_pagina.tr.tpl"}
			</table>
<br>

{*--------------------- скрит вътр.фрейм за download ------------------------------*}
<iframe id="ifdown" style="display:none">
</iframe>
<script>
function xmldown(downurl){ldelim}
	document.getElementById('ifdown').src= downurl;
{rdelim}
		{if isset($DIREDOWN)}
xmldown('{$DIREDOWN}');
		{else}
		{/if}
</script>

