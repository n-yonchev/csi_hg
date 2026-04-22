<table id='aaa' class="d_table" width='' cellspacing='0' cellpadding='0' align=left>
	<thead>
{*----
		<tr>
			<td class='d_table_title' colspan='200'>{$LISTTEXT}</td>
		</tr>
			{if $FLAGNOCHANGE}
			{else}
		<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
</td>
		</tr>
			{/if}
----*}
		<tr>
		<td class='d_table_title' colspan='200'>
<div style="float:left">
{$LISTTEXT}
</div>
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
</div>
			{/if}
		</tr>
{*--------*}
	</thead>
		<tr class='header'>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> код/егн</span></td>
			<td class='sep'>&nbsp;</td>	
			<td><span> име</span></td>
				{if $FLAGNOCHANGE}
				{else}
<td class='sep'>&nbsp;</td>
<td><span> &nbsp;</span></td>
				{/if}
							{*---- ЦРД-2014 ----*}
							{if $ISDEBT}
			<td class='sep'>&nbsp;</td>	
			<td><span>&nbsp;</span></td>
							{else}
							{/if}
		</tr>
	<tbody>
		{foreach from=$LIST item=elem key=ekey}
		<tr  onmouseover='this.className="trhove";' onmouseout='this.className="";'>
				{assign var="txtype" value=""}
				{assign var="txcode" value=""}
			{if $elem.idtype==1}
				{assign var="txtype" value="ю"}
				{assign var="txcode" value=$elem.bulstat}
			{elseif $elem.idtype==2}
				{assign var="txtype" value="ф"}
				{assign var="txcode" value=$elem.egn}
			{else}
				{assign var="txcode" value=$elem.bulstat}
			{/if}
			<td align="left"> {$txtype}</td>
			<td class='sep'>&nbsp;</td>
			<td align="left"> {$txcode}</td>
			<td class='sep'>&nbsp;</td>
			<td align="left"> 
<nobr>
			{$elem.name}
{if empty($elem.notes)}
{else}
	<img src="images/view.png" class="comment" rel="#cont{$ekey}{$TANAME}" title='коментар' style="cursor:help">
<span id="cont{$ekey}{$TANAME}" style="display: none">
{$elem.notes|nl2br}
</span>
{/if}
</nobr>
			</td>
				{if $FLAGNOCHANGE}
				{else}
			<td class='sep'>&nbsp;</td>
			<td align="left">
<nobr>
<a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.delrec}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
{*---- централен регистър само ако е длъжник ----*}
{*----
						{if isset($elem.relin2)}
<a href="caseregi.ajax.php{$elem.relin2}" class='nyroModal' target='_blank' style="font:normal 6pt verdana">.<a>
<a href="caseregi.ajax.php{$elem.relin3}" class='nyroModal' target='_blank' style="font:normal 6pt verdana">.<a>
						{else}
						{/if}
----*}
						{if isset($elem.regi)}
{*++++++++++
<a href="caseeditzone.php{$elem.regi}" class='nyroModal' target='_blank' style="font:normal 6pt verdana">
<img src="images/bg5.gif" title="справка за съвпадение"><a>
++++++++++*}
{*---- 13.10.2011 флаг длъжника не се предава в регистъра ----*}
			{if $elem.isnoregi==1}
н
			{else}
			{/if}
						{else}
{*---- 20.04.2011 флаг присъединен взискател ----*}
			{if $elem.isjoin==1}
п
			{else}
			{/if}
						{/if}
</nobr>
			</td>
				{/if}
							{*---- ЦРД-2014 ----*}
							{if $ISDEBT}
			<td class='sep'>&nbsp;</td>	
			<td>
<a href="caseeditzone.php{$elem.reg4}" class='nyroModal' target='_blank' style="font:normal 6pt verdana">
<img src="images/admin.gif" title="съвпадение в ЦРД-2014"></a>
			</td>
							{else}
							{/if}
		</tr>			
		{/foreach}
	</tbody>
</table>
{*----
<script>
function delrec(p1){ldelim}
	if(confirm('потвърди изтриването на {$LISTTEXT2}')) window.location.href='index.php'+p1;
{rdelim}
</script>
----*}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
//	$('.comment').cluetip({ldelim} cluetipClass: 'jtip', width: 300, local:true, cursor:'help' {rdelim});
	$('.comment').cluetip({ldelim} width: 300, local:true, cursor:'help' {rdelim});
{rdelim});
</script>
