					{assign var="cali" value=$elem.caselist}
					{if $elem.casecoun==0}
						{assign var="tdtext" value=""}
						{assign var="tddire" value="left"}
						{assign var="tdtite" value=""}
						{assign var="usname" value=""}
					{elseif $elem.casecoun==1}
						{assign var="tdtext" value=$cali[0].caseseri|cat:"/"|cat:$cali[0].caseyear}
						{assign var="tddire" value="right"}
						{assign var="tdtite" value=""}
						{assign var="usname" value="$cali[0].username}
					{elseif $elem.casecoun<=12}
						{assign var="tdtext" 
value="<span class='caselist' rel='#cont"|cat:$ekey|cat:"' title='списък дела'>"|cat:$elem.casecoun|cat:"</span>"}
						{assign var="tddire" value="center"}
						{assign var="tdtite" value=""}
						{assign var="usname" value=""}
{*----
						{assign var="tdtext" value=$elem.casecoun}
						{assign var="tddire" value="center class='caselist' rel='#cont"|cat:$ekey|cat:"'"}
						{assign var="tdtite" value="списък дела"}
						{assign var="usname" value=""}
----*}
{*---- съдържание на доп.информация ----*}
<span id="cont{$ekey}" style="display: none">
	<table cellspacing=0 cellpadding=0>
	{foreach from=$elem.caselist item=caseelem}
		<tr>
		<td align=right> <b>{$caseelem.caseseri}/{$caseelem.caseyear}</b>
		<td width=10>
		<td> {$caseelem.username}
{*----
<b>{$caseelem.caseseri}/{$caseelem.caseyear}</b>
&nbsp;&nbsp;&nbsp;
{$caseelem.username}
<br>
----*}
	{/foreach}
	</table>
</span>
					{else}
						{assign var="tdtext" 
value="<a href='"|cat:$elem.viewlist|cat:"' class='nyroModal' target='_blank'><span class='caselist'>"|cat:$elem.casecoun|cat:"</span></a>"}
						{assign var="tddire" value="center"}
						{assign var="tdtite" value="кликни за списъка"}
						{assign var="usname" value=""}
					{/if}
		<td class='sep'>&nbsp;</td>
		<td align={$tddire} title="{$tdtite}"> {$tdtext}</td>
		<td class='sep'>&nbsp;</td>
{*----
		<td> {$elem.username}</td>
----*}
<td> {$usname}</td>
