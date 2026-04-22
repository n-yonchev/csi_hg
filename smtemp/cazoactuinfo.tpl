{*---- източник : 
		cazoactu.tpl - cazobala.tpl 
----*}
													{assign var=ACTUDEBT value=true}
		<table class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
{*----
		<tr>
		<td class='d_table_title' colspan='200'>
актуален дълг
----*}
		<tr class='header'>
<td>дата описание сума</td>
			<td class='sep'>&nbsp;</td>	
<td></td>
<td> движение </td>
<td> актуален дълг </td>
<td> %погас </td>
		</tr>
		</thead>
		<tbody>

{*--------------------- състояние на актуалния дълг ---------------------*}
		<tr>
		<td colspan='200'>
състояние на дълга
		{foreach from=$LIST item=elem key=ekey}

<tr>
{*---- дата ----*}
<td> 
	{if empty($elem.date)}
<font color=red>няма</font>
	{else}
{$elem.date|date_format:"%d.%m.%Y"}
	{/if}
{*---- операция и описание ----*}
				{assign var="arindx" value=$elem.oper}
<br>
<nobr>
&nbsp;&nbsp;&nbsp;&nbsp;
	{$ARBALAOPER.$arindx}
</nobr>
<br>
<nobr>
&nbsp;&nbsp;&nbsp;&nbsp;
	{$elem.desc}
			{if $elem.desctran}
&nbsp;<font color="red">без-олихв</font>
			{else}
			{/if}
</nobr>
{*---- сума ----*}
<div style="text-align:right;">
<b>{$elem.amou|tomoney2}</b>
</div>
{*---- състояние ----*}
		<td class='sep'>&nbsp;</td>
<td valign=top>
				<table cellspacing=0 cellpadding=0>
				<tr>
<td class="tdbalahead" width=160> направление
	{foreach from=$CLAILIST item=clainame key=claiid}
				<tr>
<td class="tdbala"> <nobr>{$clainame}</nobr>
	{/foreach}
				</table>
</td>
						{assign var=movebg value=""}
						{assign var=plusbg value=""}
						{assign var=minubg value=""}
						{assign var=resubg value=""}
						{if $elem.direction=="+"}
							{assign var=movebg value="#f8c4bf"}
							{assign var=plusbg value="#f8c4bf"}
						{else}
						{/if}
						{if $elem.direction=="-"}
							{assign var=movebg value="#ddffdd"}
							{assign var=minubg value="#ddffdd"}
						{else}
						{/if}
<td valign=top>
{include file="cazobalastat.tpl" VARI="move" BGCO=$movebg}
</td>
{*----
<td valign=top rel="tohide">
{include file="cazobalastat.tpl" VARI="plus" BGCO=$plusbg}
</td>
<td valign=top rel="tohide">
{include file="cazobalastat.tpl" VARI="minu" BGCO=$minubg}
</td>
----*}
<td valign=top>
{include file="cazobalastat.tpl" VARI="resu" BGCO=$resubg}
</td>
<td valign=top>
{include file="cazobalaproc.tpl" VARI="percpaid"}
</td>
		
		{/foreach}

		</tbody>
		</table>



