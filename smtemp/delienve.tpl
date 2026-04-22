{include file="_tab2.tpl"}
{*
<style>
body {ldelim}font: normal 8pt verdana; padding: 1px 8px 1px 8px;{rdelim}
.link3 {ldelim}font: normal 8pt verdana; cursor: pointer; border-bottom:1px solid black; padding:2px 6px 2px 6px;{rdelim}
.curr3 {ldelim}background-color:khaki;cursor:pointer;{rdelim}
.fon7 {ldelim}font: normal 7pt verdana !important;{rdelim}
</style>
*}

					<table align=center>
					<tr>
<td>
{foreach from=$ARV3LINK item=culink key=codevari}
	<span class="link3{if $codevari==$V3} curr3{else}{/if}" 
	{include file="_href.tpl" LINK=$culink}> 
	{$ARV3.$codevari}
	{if $ARV3COUN[$codevari]==0}{else}&nbsp;[{$ARV3COUN[$codevari]}]{/if}
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
{/foreach}
					</table>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на документи за връчване по поща
				<tr class='head2'>
<td> изх.номер
<td> изходен
<td> тип
<td> дело
<td> деловодител
<td> адресат
<td> адрес
<td> статус
<td> бел
<td colspan=3 align=center> плик

{foreach from=$ARPOST item=elem key=idpost}
				<tr>
<td title="{$idpost}">
<nobr>
{$elem.d2seri}/{$elem.d2year}
				{*
				<a href="file:///{$LETDOC}:/{$elem.iddout}.doc" target="_blank">
				<img src="images/word.gif" title="корегирай/изведи">
				</a>
				*}
			{if $elem.isdoc==0}
<img src="images/view.png" style="cursor:pointer" title="виж съдържанието" onclick="w2=window.open('{$elem.viewcont}','win2');w2.focus();">
			{else}
<img src="images/word.gif" style="cursor:pointer" title="виж документа" onclick="fuprin('{$elem.viewcont}');">
			{/if}
</nobr>
<td class="fon7" title="{$elem.created|date_format:"%d.%m.%Y %H:%M:%S"} от {$elem.postuser}"> {$elem.created|date_format:"%d.%m.%Y"}
<td style="cursor:help;" title="{$elem.d2text}"> {$elem.d2text|truncate:30:"...":true}
					{if empty($elem.caseri)}
<td> &nbsp;
					{else}
<td> {$elem.caseri}/{$elem.cayear}
					{/if}
<td> {$elem.username}
<td> {$elem.adresat}
<td> {$elem.address}
<td {if $elem.isertype}class="ertype" title="статуса не отговаря на метода"{else}{/if}> {$elem.statname}
					{if empty($elem.notes)}
<td> &nbsp;
					{else}
<td align=center style="cursor:help;" title="{$elem.notes}"><img src="images/info.gif">
					{/if}
				{if empty($elem.idenve)}
<td align=center class="curr3" title="включи в нов плик"
{include file="_href.tpl" LINK=$elem.tonew}
> &nbsp;нов&nbsp;
<td align=center class="" style="cursor:pointer;" title="включи в съществуващ плик"
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$elem.toexi}'{rdelim});"
> &nbsp;с&nbsp;
<td> &nbsp;
				{else}
					{if $elem.idstatenve==0}
<td align=center class="stat0 tohe" title="чакащ плик"
> #{$elem.idenve}
<td align=center class="" style="cursor:pointer;" title="включи в съществуващ плик"
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$elem.toexi}'{rdelim});"
> &nbsp;с&nbsp;
<td class="toli" title="изключи от плик #{$elem.idenve}"
{include file="_href.tpl" LINK=$elem.noenve}
> <img src="images/ignore.gif">
					{else}
<td align=center class="stat1 tohe" title="изпратен плик"> #{$elem.idenve}
<td> &nbsp;
<td> &nbsp;
					{/if}
				{/if}
{/foreach}
{include file="_tab2pagi.tpl"}
				</table>