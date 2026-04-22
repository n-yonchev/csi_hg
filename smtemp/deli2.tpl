<td {$bgco}> {$elpost.adresat}&nbsp;
<td {$bgco}> {$elpost.address}&nbsp;
<td {$bgco}> {$ARPOSTTYPE_2[$elpost.idposttype]}&nbsp;
			{*---- 18.10.2018 призовкар - името ----*}
			{*
			{if $elpost.idposttype==$DELITYPE2}
<br> <nobr><font color=red>{$ARUSERPOST[$elpost.idus2]}</font></nobr>
			{else}
			{/if}
			*}
<td {$bgco} class="fon7"> {$elpost.date1|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} class="fon7"> {$elpost.date2|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} class="fon7"> {$elpost.date3|date_format:"%d.%m.%Y"}&nbsp;
<td {$bgco} {if $elpost.isertype}class="ertype" title="статуса не отговаря на метода"{else}{/if}> {$elpost.statname}&nbsp;
<td {$bgco} class="ctip" align=center style="cursor:pointer"
onclick="$.nyroModalManual({ldelim}forceType:'iframe',url:'{$elpost.postnote}'{rdelim});"
rel="#note{$idpost}" title="бележки"> 
					{if empty($elpost.notes)}
-
					{else}
<img src="images/info.gif">
					{/if}
</td>
<span id="note{$idpost}" style="display: none">
			{if empty($elpost.notes)}
няма бележки
			{else}
{$elpost.notes|nl2br}
			{/if}
<hr>
<font color=blue>клик за корекция</font>
</span>
{*
				{if $elpost.isertype}
EEE[{$elpost.idposttype}][{$elpost.pstype}]
				{else}
				{/if}
*}
		{*---- икони ----*}
<td>
<nobr>
{*
									{if $elpost.nopostdata}
<a href="{$elpost.postedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			{if $elpost.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdubl} title="дублирай екземпляра"> 
			{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdele} title="изтрий дублирания екземпляр"> 
			{/if}
									{else}
									{/if}
*}
			{if $elpost.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdubl} title="дублирай екземпляра"> 
			{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elpost.postdele} title="изтрий дублирания екземпляр"> 
			{/if}
									{if $elpost.nopostdata}
<a href="{$elpost.postedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
									{else}
									{/if}
&nbsp;
</nobr>
		{*---- чекбокс ----*}
<td align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="{$idpost}" id="{$idpost}">

		{*---- чл.417 ----*}
			{if $isfirst}
<td {$bgco} {$rs2} align=center class="head2" style="cursor:help;"
onmouseover="this.style.backgroundColor='aquamarine';" onmouseout="this.style.backgroundColor='';"
title="дело {$eldout.d2seri}/{$eldout.d2year} &#013;идва от {$eldout.rsname} &#013;
титул {$ARTITU[$eldout.casetitu]} &#013;подтитул {$ARSUBT[$eldout.casesubt]} &#013;тип {$eldout.d2text}">
<span style="{if $eldout.isinterest==0}{else}background-color:orange !important;{/if}"> 
&nbsp;&diams;&nbsp;</span>
			{else}
			{/if}
		{*---- свързан изх.документ ----*}
<td {$bgco} class="head2 fon7"> 
	{if $eldout.isinterest==0}
		{* основен запис - НЕ Е ПДИ_чл.417 *}
					{assign var=idpp value=$elpost.idpp}
					{assign var=ropd value=$ARPP[$idpost]}
		{if empty($ropd)}
&nbsp;
		{else}
			{* основен запис - ПридрПисмо, свързан - ПДИ_чл.417 *}
ПДИ {$ropd.doutseri}/{$ropd.doutcrea|date_format:"%d.%m.%Y"}
{$ARPOSTTYPE[$ropd.idmeth]}
		{/if}
	{else}
		{* основен запис - ПДИ_чл.417, свързан - ПридрПисмо *}
		{if empty($elpost.p2id)}
			{if $elpost.idpoststat==0}
<span style="cursor:help;" title="може да формирате ПП след връчване">п</span>
			{else}
<a href="{$elpost.creapp}" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="формирай придруж.писмо"></a>
			{/if}
		{else}
ПП {$elpost.doutseri}/{$elpost.doutcrea|date_format:"%d.%m.%Y"}
{$ARPOSTTYPE[$elpost.idmeth]}
		{/if}
	{/if}
