<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
						<table align=center>
				{if isset($PAGEBACKLINK)}
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> {$PAGEBACKTEXT} </a>
{*----
	{if isset($PAGEDATACASE)}
<div style="font: normal 8pt verdana;" align=right> <b>дело {$PAGEDATACASE.serial}/{$PAGEDATACASE.year}</b> </div>
	{else}
	{/if}
----*}
				{else}
				{/if}
<tr><td align=left>
<br>
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='40'> списък с дела на наблюдател {$ROVIEW.name}
{*
<span align=right>
{include file='_button.tpl' HREF="$ADDCAS" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
{include file='_button.tpl' HREF="$ADDCAS" TITLE='добави'}
<a href="{$ADDCAS}">добавиго</a>
*}
&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_button.tpl' ONCLICK="window.location.href='$ADDCAS';" TITLE='добави'}
{*
</span>
*}
			<tr>
<td colspan='40'>
			{if $COUNTO+0==0}
			{else}
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$LINKDELALL}> изтрий наведнъж всичките {$COUNTO+0} бр.дела от списъка </a>
&nbsp;&nbsp;&nbsp;&nbsp;
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
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='изтрий' NAME='submit' ID='submit'}
маркираните дела от списъка на наблюдателя {$ROVIEW.name} 
<br>
			</thead>
			<tr class='header'>
<td> номер </td>
			<td class='sep'>&nbsp;</td>
<td> деловодител </td>
			<td class='sep'>&nbsp;</td>
<td> описание </td>
			<td class='sep'>&nbsp;</td>
<td> идва от </td>
			<td class='sep'>&nbsp;</td>
<td> създадено </td>
			<td class='sep'>&nbsp;</td>
<td> посл.промяна </td>
			<td class='sep'>&nbsp;</td>
<td> представител </td>
			<td class='sep'>&nbsp;</td>
<td> взискатели </td>
			<td class='sep'>&nbsp;</td>
<td> статус </td>
			<td class='sep'>&nbsp;</td>
<td> изтрий </td>

{foreach from=$CASELIST item=elem key=ekey}
{*
			<tr onclick="document.location.href='{$elem.edit}';"
onmouseover='this.style.backgroundColor="#dddddd";this.style.cursor="pointer";' 
onmouseout='this.style.backgroundColor="";this.style.cursor="default";'
>
*}
			<tr 
onmouseover='this.style.backgroundColor="#dddddd";' 
onmouseout='this.style.backgroundColor="";'
>
<td> {$elem.serial}/{$elem.year}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.username}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.text}
				{assign var="arindx" value=$elem.idcofrom} </td>
			<td class='sep'>&nbsp;</td>
<td> {$ARFROM[$elem.idcofrom]}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.lastdocu|date_format:"%d.%m.%Y %H:%M"}</td>
				{assign var="myid" value=$elem.id}
			<td class='sep'>&nbsp;</td>
<td> {$elem.agenname}</td>
			<td class='sep'>&nbsp;</td>
<td>
		{foreach from=$LISTCLAI[$elem.id] item=claielem}
<nobr>
{$claielem} &nbsp;
</nobr>
<br>
		{/foreach}
			<td class='sep'>&nbsp;</td>
<td> {$ARSTAT[$elem.idstat]} &nbsp;
			<td class='sep'>&nbsp;</td>
<td>
<input type="checkbox" name="marklist[]" value="{$elem.id}" rela="mycblist">
{/foreach}

{include file="_pagina.tr.tpl"}
			</table>
						</table>
</form>
