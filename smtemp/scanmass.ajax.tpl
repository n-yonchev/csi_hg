{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="масово сканирани вх.документи"}
<style>
.ok {ldelim}background-color:lightgreen;cursor:pointer;{rdelim}
.ok:hover {ldelim}background-color:green;{rdelim}
.cancel {ldelim}background-color:lightcoral;cursor:pointer;{rdelim}
.cancel:hover {ldelim}background-color:red;{rdelim}
.error {ldelim}font:bold 7pt verdana !important;background-color:red;color:white;cursor:help;{rdelim}
.calist {ldelim}font:normal 7pt verdana !important;border:0px solid black !important;{rdelim}
</style>

							{if $SMFROMCASE}
								{assign var="CANCELALL" value="caseeditzone.php"|cat:$CANCELALL}
								{assign var="OKALL" value="caseeditzone.php"|cat:$OKALL}
							{else}
							{/if}
{include file="_tab2.tpl"}
		<table class="tab2" cellspacing='0' cellpadding='2' align=center style="margin:10px;">
		<tr class='head2'>
<td style="cursor:pointer;" title="НЕ ПРИЕМАМ ВСИЧКИ" {include file="_href.tpl" LINK=$CANCELALL}> <img src="images/lock3.gif">
<td align=right> вх<br>ном
<td> описание
<td> подател
<td align=right> брой<br>стр
<td> &nbsp;
<td> дело
<td style="cursor:pointer;" title="приемам всички" {include file="_href.tpl" LINK=$OKALL}> <img src="images/topaym.gif">
<td> гре<br>шка
		</tr>
{foreach from=$LIST item=elem}
		{include file="_tab2tr.tpl"}
							{if $SMFROMCASE}
								{assign var="cancel" value="caseeditzone.php"|cat:$elem.cancel}
								{assign var="ok" value="caseeditzone.php"|cat:$elem.ok}
								{assign var="scanv2" value="caseeditzone.php"|cat:$elem.scanv2}
							{else}
								{assign var="cancel" value=$elem.cancel}
								{assign var="ok" value=$elem.ok}
								{assign var="scanv2" value=$elem.scanv2}
							{/if}
<td class="cancel" title="НЕ ПРИЕМАМ" {include file="_href.tpl" LINK=$cancel}> &nbsp;&nbsp;&nbsp;
<td align=right> {$elem.serial}
<td> {$elem.text}
<td> {$elem.from}
<td align=center> {$elem.pageco}
<td> 
<img src="images/view.png" style="cursor:pointer" title="виж" onclick="w2=window.open('{$scanv2}','win2');w2.focus();">
{*
					{assign var=iddocu value=$elem.iddocu}
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
*}
<td> 
			<table class="" cellspacing='0' cellpadding='0'>
		{foreach from=$elem.caselist item=caelem}
			<tr class="">
			<td class="calist"> <nobr>{$caelem.caseseri}/{$caelem.caseyear}</nobr>
			<td class="calist"> <nobr>{$caelem.username}</nobr>
		{/foreach}
			</table>
<td class="ok" title="приемам" {include file="_href.tpl" LINK=$ok}> &nbsp;&nbsp;&nbsp;
				{if $elem.ider==0}
<td> &nbsp;
				{else}
{*
<td class="error" title="{$ARSCANER[$elem.ider]} [{$elem.iddocu}]"> грешка-{$elem.ider}
<td class="error" title="грешка-{$elem.ider} [{$elem.iddocu}]"> {$ARSCANER[$elem.ider]}
*}
<td align=center class="error" title="{$ARSCANER[$elem.ider]} [{$elem.iddocu}]"> {$elem.ider}
				{/if}
{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
		</table>
<script>
$(document).ready(function(){ldelim}
	$("div.wclose_normal").bind("click",function(){ldelim}
//parent.$(document).hide();
//parent.$(document.body).hide();
//++++parent.$("body").hide();
			{if $SMFROMCASE}
parent.$('#t5link').click();
			{else}
parent.$("body").css({ldelim}opacity:0.2{rdelim});
parent.location.reload(true);
			{/if}
	{rdelim});
					{if count($LIST)==0}
	$("div.wclose_normal").click();
					{else}
					{/if}
{rdelim});
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
