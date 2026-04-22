{include file="_tab2.tpl"}
<style>
.mark {ldelim}font: normal 8pt verdana;background-color:red;color:white{rdelim}
.deli {ldelim}background-color:silver;height:4px;{rdelim}
.case {ldelim}background-color:wheat;cursor:pointer;{rdelim}
</style>
			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'>
списък на делата с ЕТ
			<tr class='head2'>
<td> дело
<td> деловодител
<td> ЦРД-2014
<td> &nbsp;
<td> взиск
<td> длъж
{foreach from=$ARCASE item=elem key=idcase}
			<tr>
<td rowspan=2 class="case" {include file="_href.tpl" LINK=$elem.link} title="виж делото"> {$elem.caseri}/{$elem.cayear}
<td rowspan=2> {$elem.usname}
<td rowspan=2 align=center> 
					{if empty($elem.reg4text)}
&nbsp;
					{else}
<img src="images/info.gif" rela="reg4" rel="#reg4cont{$idcase}" title="последен резултат от ЦРД-2014" style="cursor:help">
<span id="reg4cont{$idcase}" style="display: none">
	{foreach from=$elem.artext item=txelem}
		<nobr>{$txelem[0]}</nobr>
			{if empty($txelem[1])}
			{else}
		<br>
		<span style="font:normal 8pt courier;color:blue">{$txelem[1]}</span>
			{/if}
		<br>
	{/foreach}
</span>
					{/if}
<td> брой бивши ЕТ физ.лица
<td align=center> {$elem.c0} &nbsp;
<td align=center> {$elem.d0} &nbsp;
			<tr>
<td> брой настоящи ЕТ юрид.лица
<td align=center class="{if $elem.c1==$elem.c0}{else}mark{/if}"> {$elem.c1} &nbsp;
<td align=center class="{if $elem.d1==$elem.d0}{else}mark{/if}"> {$elem.d1} &nbsp;
			<tr>
<td class="deli" colspan=20> &nbsp;
{/foreach}
			</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$("[@rela='reg4']").cluetip({ldelim} width: 660, local:true, cursor:'help' {rdelim});
{rdelim});
</script>
