<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>изходящи документи</td>
		</tr>
	</thead>
		<tr class='header'>
			<td> изх. номер&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td> изведен&nbsp;</td>
			<td class='sep'>&nbsp;</td>
<td> адресат</td>
			<td class='sep'>&nbsp;</td>
			<td> тип&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> дело </td>
			<td class='sep'>&nbsp;</td>
			<td> деловодител </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
<td>образ</td>
		</tr>
		{foreach from=$LIST item=elem key=ekey}
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
					{if $elem.serial==0}
			<td class="contleft"> 
					{else}
			<td class="contleft"> {$elem.serial}/{$elem.year}
					{/if}
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> {$elem.registered|date_format:"%d.%m.%Y"}
			<td class='sep'>&nbsp;</td>
<td class="contleft"> {$elem.adresat}
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> {$elem.typetext}

			<td class='sep'>&nbsp;</td>
			<td align=right>
							{*---- 22.10.2010  Дичев - за документ на Word ----*}
							{if $elem.suff=="html"}
{if empty($elem.content)}
	<font color=red> празен </font>
{else}
	<a href="{$elem.view}" class="nyroModal" target="_blank">
	<img src="images/view.png" title="разгледай документа">
	</a>
{/if}
							{else}
<a href="file:///{$LETDOC}:/{$elem.id}.doc" target="_blank">
<img src="images/word.gif" title="разгледай">
</a>
							{/if}
			<td class='sep'>&nbsp;</td>
			<td>
<a href="{$elem.dele}" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий документа">
</a>
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> {$elem.caseseri}/{$elem.caseyear}
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> {$elem.ownernam}
			<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}"> <img src="images/view.png" title="делото подробно">
</a></td>
{*---- за сканирания образ ----*}
	{include file="_sepa.tpl"}
<td align=left>
					{assign var=iddocu value=$elem.id}
					{assign var=scancoun value=$ARSCANCOUN[$iddocu]}
		{if $scancoun==0}
&nbsp;
		{else}
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('{$elem.scanview}','win2');w2.focus();">
			{if $scancoun==1}
			{else}
<sup>{$ARSCANCOUN[$iddocu]}</sup>
			{/if}
		{/if}
		{/foreach}
			
{include file="_pagina.tr.tpl"}
			</table>
