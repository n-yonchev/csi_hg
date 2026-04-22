{include file="_tab2.tpl"}
<style>
.link {ldelim}background-color:khaki;cursor:pointer;{rdelim}
.link2 {ldelim}background-color:gold;cursor:pointer;{rdelim}
body {ldelim}margin-left:10px; margin-right:10px;{rdelim}
</style>
															
															<table align=center>
{**}
															<tr>
															<td>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> назад към списъка трансформации </a>
{**}															
															<tr>
															<td>
															
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head2'>
<td colspan=20> списък дела на взискател <b>{$NAME}</b> и ред за отчета <b>{$ARREPO[$IDRE]}</b>
				<tr class='head2'>
<td> дело
<td> деловодител
<td> статус
<td> образувано
<td> идва от
<td> описание
<td> взискатели
<td> длъжници
{foreach from=$ARCASE item=elem key=indx}
				<tr onmouseover="this.style.backgroundColor='#dddddd';" onmouseout="this.style.backgroundColor='';">
<td class="link" title="виж делото" onclick="document.location.href='{$elem.edit}';return false;"> {$elem.caseseri}/{$elem.caseyear}
<td> {$elem.username}
<td> {$ARSTAT[$elem.idstat]} {$elem.timestat|date_format:"%d.%m.%Y"}
<td> {$elem.casedate|date_format:"%d.%m.%Y"}
<td> {$ARFROM[$elem.casefrom]}
<td> {$elem.casetext}
<td>
			{assign var='idcase' value=$elem.idcase}
					{foreach from=$LISTCLAI[$idcase] item=memb}
{if $memb.idtype==1}юл{elseif $memb.idtype==2}фл{else}др{/if} {$memb.name}
<br>
					{/foreach}
<td>
					{foreach from=$LISTDEBT[$idcase] item=memb}
{if $memb.idtype==1}юл{elseif $memb.idtype==2}фл{else}др{/if} {$memb.name}
<br>
					{/foreach}
{/foreach}
{include file="_tab2pagi.tpl"}
				</table>
				
				{if !empty($ARCASE) and isset($ARLINK)}
															<tr>
															<td style="font: normal 10pt verdana;">
за всичките {$PAGIPARA.TOTREC|tointe} дела от списъка промени текущия ред за отчета в нов, <br>който да е 
<br>
{foreach from=$ARLINK item=elem key=newrepo}
	<div class="link2" style="float:left;padding:1px 10px;border:1px solid red;" 
	onclick="document.location.href='{$elem}';return false;">{$ARREPO[$newrepo]}</div>
	<div style="float:left;">&nbsp;&nbsp;</div>
{/foreach}
				{else}
				{/if}
															</table>

