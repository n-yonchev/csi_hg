{include file="_tab2.tpl"}
<style>
.over {ldelim}cursor:pointer;background-color:aqua;{rdelim}
.dire {ldelim}cursor:pointer;background-color:wheat;{rdelim}
{*
.he3 {ldelim}font:bold 7pt verdana;background-color:steelblue;color:white{rdelim}
*}
.he3 {ldelim}font:bold 7pt verdana;background-color:lightblue;{rdelim}
.ro3 {ldelim}font:normal 8pt verdana;border: 0px solid green !important;{rdelim}
.busy {ldelim}font:normal 7pt verdana{rdelim}
</style>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

				<form name="formseye" method=post 
				style="margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 8pt verdana;white-space:nowrap;">

		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'>
<div style="float:left">списък на постъпленията готови за превод {$HEADTX}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
		<tr class='head2'>
<td> дело
<td> деловодител
<td> постъпления
<td> разпределения
<td> заето от

{foreach from=$ARCASE item=elem key=idcase}
		<tr>
{*---- дело ----*}
						{if empty($ARLOCK[$idcase])}
<td bgcolor=wheat {include file="_href.tpl" LINK=$elem.link} onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
						{else}
<td>
						{/if}
{$elem.caseseri}/{$elem.caseyear}
<td> {$elem.username}
		{*---- постъпления ----*}
<td valign=top class="tab4">
		<table>
		<tr>
				{if empty($ARLOCK[$idcase])}
		<td align=center> 
<a href="#" onclick="casetopa({$idcase}); return false;"> 
<img src="images/topaym.gif" title="маркираните към списъка с преводи">
</a>
				{else}
				{/if}
		<td class="he3"> сума
		<td class="he3"> тип
		<td class="he3"> готово
				{if empty($ARLOCK[$idcase])}
		<td class="he3"> върни
				{else}
				{/if}
		{foreach from=$ARFINA[$idcase] item=elfina key=idfina}
		<tr>
				{if empty($ARLOCK[$idcase])}
<td class="ro3" align=center> 
<input type=checkbox id="cb{$idfina}" caseto="{$idcase}" checked>
				{else}
				{/if}
{*
{$idcase}/{$idfina}
*}
<td class="ro3" align=right 
{*
			{if empty($elfina.lockname)}
			{else}
bgcolor=salmon style="cursor:help;" title="заключена от {$elfina.lockname}"
			{/if}
*}
>{$elfina.inco|tomoney2}
				{assign var="idtype" value=$elfina.idtype}
				{assign var=bankname value=$ARBANK[$elfina.codebank]}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$elfina.idfinabank|cat:"-"|cat:$bankname}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td class="ro3"> <nobr>{$ARTYPE.$idtype|cat:$finaba}</nobr>
<td class="ro3"> {$elfina.time|date_format:'%d.%m.%Y [%H:%M:%S]'}
				{if empty($ARLOCK[$idcase])}
<td class="ro3" align=center> 
<img src="images/unmark.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elfina.finaback} title="върни на деловодителя за корекция"> 
				{else}
				{/if}
		{/foreach}
		</table>
		{*---- преводи ----*}
<td valign=top>
		<table class="tab4">
		<tr>
		<td class="he3"> сума
		<td class="he3"> взискател
		<td class="he3"> iban
		{foreach from=$ARTRAN[$idcase] item=eltran key=idclai}
		<tr>
<td class="ro3" align=right> {$eltran.suma|tomoney2}
			{if $idclai<=0}
<td class="ro3 pseu"> {$eltran.clainame}&nbsp;
			{else}
<td class="ro3"> {$eltran.clainame}
			{/if}
			{if $idclai<=0 and $idclai<>-1}
<td class="ro3 pseu"> ОК
			{else}
				{if empty($eltran.iban)}
<td class="no"> липсва
				{else}
<td class="ro3"> {$eltran.iban}&nbsp;
					{if $eltran.ibaniser}
<span class="no">грешен</span>
					{else}
					{/if}
				{/if}
			{/if}
<td class="ro3">
				{if $idclai<=0}
				{else}
					{if empty($ARLOCK[$idcase])}
<a href="{$eltran.claimodi}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай сметката"></a>
					{else}
					{/if}
				{/if}

		{/foreach}
		</table>
{*---- заето от ----*}
<td class="busy"> {$ARLOCK[$idcase]}
{/foreach}

				</form>

{include file="_tab2pagi.tpl"}
		</table>

<script>
function casetopa(suid){ldelim}
	var list= $("input[@caseto="+suid+"]");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+",";
			coun += 1;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (coun==0){ldelim}
	{rdelim}else{ldelim}
		lico= lico.substring(0,lico.length-1);
		jQuery.ajax({ldelim}
			url: "cbsess.ajax.php?p="+lico
			,success: topasuccess
			{rdelim});
	{rdelim}
{rdelim}
function topasuccess(data){ldelim}
//alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
$.nyroModalManual({ldelim}forceType:'iframe', url:'{$CBTOPAYM}'{rdelim});
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
