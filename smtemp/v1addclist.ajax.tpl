{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="намерени дела с "|cat:$FILTTEXT}
<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
{*
<style>
.he2 {ldelim}font: bold 7pt verdana; background-color: silver;{rdelim}
.ro2 {ldelim}font: normal 7pt verdana; border-bottom: 1px solid black;{rdelim}
</style>
*}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b>{$ARCOUN[9]+0}</b></font> бр.дела намерени общо
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b>{$ARCOUN[1]+0}</b></font> бр.дела от тях вече са включени в списъка
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b>{$ARCOUN[0]+0}</b></font> бр.дела от тях не са включени в списъка
			{if $ARCOUN[0]+0==0}
			{else}
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$LINKINCALL}> включи наведнъж всичките {$ARCOUN[0]+0} бр.дела в списъка на наблюдателя {$ROVIEW.name} </a>
			{/if}
<br>
<br>
маркирай само за тази страница
{*---- група чекбоксове - всички да/ всички не - източник : cazo6bran.tpl ----*}
&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
href="#" onclick="checkon();return false;"> <nobr>всички да</nobr> </a>
&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="#" onclick="checkoff();return false;"> <nobr>всички не</nobr> </a>
<script type="text/javascript" src="js/jq.checkbox.js"></script>
<script>
function checkon(){ldelim}
	$("input[@rela='mycblist']").check("on");
{rdelim}
function checkoff(){ldelim}
	$("input[@rela='mycblist']").check("off");
{rdelim}
</script>
{*-----------------------------------------------*}
{*
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$LINKINCALL}> включи маркираните дела в списъка на наблюдателя {$ROVIEW.name} </a>
*}
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='включи' NAME='submit' ID='submit'}
маркираните дела в списъка на наблюдателя {$ROVIEW.name} 

<br>
		<table class="d_table" align=center cellspacing='0' cellpadding='0'>
		<tr class="header">
<td class="he2"> номер
<td class="he2"> деловодител
<td class="he2"> идва от
<td class="he2"> създадено
<td class="he2"> представител
<td class="he2"> взискатели
<td class="he2"> статус
<td class="he2"> включи
	{foreach from=$LISTCASE item=elem}
		<tr>
<td class="ro2"> {$elem.serial}/{$elem.year}
<td class="ro2"> {$elem.username}
<td class="ro2"> {$ARFROM[$elem.idcofrom]}
<td class="ro2"> {$elem.created|date_format:"%d.%m.%Y"}
<td class="ro2"> {$elem.agenname} &nbsp;
<td class="ro2"> 
		{foreach from=$LISTCLAI[$elem.id] item=claielem}
<nobr>
{$claielem} &nbsp;
</nobr>
<br>
		{/foreach}
<td class="ro2"> {$ARSTAT[$elem.idstat]} &nbsp;
<td class="ro2"> 
&nbsp;
					{if $elem.isinlist==0}
{*
<input type="checkbox" class="input" name="branlist[]" value="{$branid}" label="{$branname}" rela="mycblist" onclick="putsuma();">
*}
<input type="checkbox" name="marklist[]" value="{$elem.id}" rela="mycblist">
					{else}
					{/if}
		</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
		</table>
{*
{include file='_but2.tpl' TYPE='submit' TITLE='включи маркираните дела' NAME='submit' ID='submit'}
в списъка на наблюдателя {$ROVIEW.name} 
*}
</form>

<script>
$(document).ready(function(){ldelim}
	$("div.wclose_normal").bind("click",function(){ldelim}
//parent.$('#linkrelo').click();
		var lire= parent.$('#linkrelo').attr("href");
//alert(lire);
parent.location.href= "index.php"+lire;
	{rdelim});
{rdelim});
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
