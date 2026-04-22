										{if $FLPRIN}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
</style>
								{assign var=bord value="border=1"}		
										{else}
{include file="_styearlist.tpl"}
{*----
<br>
{include file="_stdateform.tpl"}
----*}
										{/if}
								{if isset($MONT)}
						{assign var=text value="месеца"}
								{else}
						{assign var=text value="периода"}
								{/if}

<br>
			<table align=center {$bord}>
										{if $FLPRIN}
						{assign var=cosp value="12"}
						{assign var=cos2 value="1"}
										{else}
						{assign var=cosp value="13"}
						{assign var=cos2 value="2"}
			<tr>
<td colspan={$cosp} align=right> <a class="" href="#" onclick="fuprin('{$CURINT}');">изход в Excel</a>
										{/if}
			<tr>
<td class="hetext" colspan={$cosp}> обща статистика за {if isset($MONT)}месец {$MONT}-{$YEAR}
{else}периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}{/if} по деловодители
			<tr>
<td class="hetext" {if $FLPRIN}{else}colspan=2{/if}> деловодител
<td class="hetext"> общо дела
<td class="hetext"> бр.дела<br>в края на<br>{$text}
<td class="hetext"> отваряни<br>дела<br>през {$text}
<td class="hetext"> неотваряни<br>дела<br>през {$text}
<td class="hetext"> дела<br>без движ.<br>през {$text}
<td class="hetext"> изходени<br>документи<br>през {$text}
<td class="hetext"> входени<br>документи<br>през {$text}
<td class="hetext"> извършени<br>действия<br>през {$text}
<td class="hetext"> общо дълг
{*----
<td class="hetext"> общо<br>дълг
<td class="hetext"> събрано<br>по делата
<td class="hetext"> събрано<br>разн/такси
----*}
<td class="hetext"> събрано<br>общо<br>през {$text}
<td class="hetext"> събрано<br>заЧСИ<br>през {$text}
				{foreach from=$USERLIST item=elem key=userid}
					{if $DATA1[$userid]<=0}
					{else}
			<tr>
<td> {if $userid<=0}<font color=red>ненасочени</font>{else}{$elem}{/if}
										{if $FLPRIN}
										{else}
<td align=center>
<a href="stmontuser.ajax.php{$USERLINK.$userid}" class="nyroModal" target="_blank"><img src="images/view.png" title="подробно" border=0></a>
<a href="#" onclick="fuprin('stmontuser2.ajax.php{$USERLINK2.$userid}');"><img src="images/open.gif" title="суми ЧСИ" border=0></a>
										{/if}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA1[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA1A[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA2[$userid]}
{*
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA3[$userid]}
*}
<td class="sttext" align=right style="background-color:wheat;"> 
{include file="_stcell.tpl" VALUE=$DATA3[$userid] FLAG=1}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA4[$userid]}
{*
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA5[$userid]}
*}
<td class="sttext" align=right style="background-color:wheat;"> 
{include file="_stcell.tpl" VALUE=$DATA5[$userid] FLAG=2}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA6[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA7[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA8[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA9[$userid]}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$DATA10[$userid]}
					{/if}
				{/foreach}
			<tr>
<td class="hetext" colspan={$cos2} align=right> общо за {$text}
				{foreach from=$ARSUMA item=elem key=cuindx}
<td class="hetext" align=right> {include file="_stcell.tpl" VALUE=$elem}
				{/foreach}
			</table>

{include file="_download.tpl"}
