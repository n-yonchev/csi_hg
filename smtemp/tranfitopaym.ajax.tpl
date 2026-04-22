{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="прехвърляне към списъка с преводи" WITDH=840}
{include file="_erform.tpl"}
<style>
.trow {ldelim}font: normal 8pt verdana;border-bottom: 1px solid black;{rdelim}
.pseu {ldelim}font: normal 8pt verdana; color:red;{rdelim}
</style>

																{if count($ARCONS)==0}
Няма суми за превод по дело <b>{$ROCASE.serial}/{$ROCASE.year}</b>
<br>
Вероятно всички суми вече са прехвърлени в списъка с готови за превод.
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='обнови списъка' NAME='submit2' ID='submit2'}
																{else}

Ще прехвърлите към списъка за превод следните обобщени суми от избраните постъпления по дело <b>{$ROCASE.serial}/{$ROCASE.year}</b> :
<br>
		<table align=center>
								<tr class="trow" bgcolor=silver>
<td align=center> сума
<td> взискател
<td> iban
{*
<td> bic
*}
<td align=center> ме<br>тод
<td> сумата да се преведе<br>от банка
<td> пълно<br>пога<br>сяване
<td> rings
{foreach from=$ARCONS item=elem key=idclai}
								<tr>
<td class="trow" align=right> {$elem.suma|tomoney2}
			{if $idclai<=0 and $idclai<>-1}
<td class="trow pseu"> {$elem.clainame}&nbsp;
			{else}
<td class="trow"> {$elem.clainame}
			{/if}
			{if $idclai<=0 and $idclai<>-1}
<td class="trow pseu"> ОК
			{elseif empty($elem.iban)}
<td class="no"> липсва
			{else}
<td class="trow"> {$elem.iban}&nbsp;
					{if $elem.ibaniser}
<span class="no">грешен</span>
					{else}
					{/if}
			{/if}
{*
			{if $idclai<=0 and $idclai<>-1}
<td class="trow pseu"> ОК
			{elseif empty($elem.bic)}
<td class="no"> липсва
			{else}
<td class="trow"> {$elem.bic}&nbsp;
			{/if}
*}
<td class="trow" align=center style="cursor:pointer;" onclick="etog({$idclai})"> 
{*
<span id="s{$idclai}">{if $elem.iselec==0}ръчно{else}Е{/if}</span>
*}
{***
<span id="s{$idclai}">{if $elem.iselec==0}отложен{else}Е{/if}</span>
			<input type="hidden" size=3 name="iselec_{$idclai}" id="iselec_{$idclai}" value="{$elem.iselec}">
***}
<span id="s{$idclai}">{$ARMETH[$elem.idmeth]}</span>
			<input type="hidden" size=3 name="idmeth_{$idclai}" id="idmeth_{$idclai}" value="{$elem.idmeth}">
<td> 
{include file="_select.tpl" FROM=$ARBANKPAYMNAME ID="idbank_"|cat:$idclai C1="input"}
<td align=center> 
<input type="checkbox" name="isfull_{$idclai}" id="isfull_{$idclai}">
<td align=center> 
<input type="checkbox" name="isring_{$idclai}" id="isring_{$idclai}">
						{if $elem.isbudg==1}
								<tr>
<td>
<td class="trow" colspan=4>
<font color=red> за взискател {$elem.clainame} </font>
{include file="finaclos2budg.tpl"}
						{else}
						{/if}
{/foreach}
		</table>

<br>
дата на погасяване за всички постъпления
<br>
<input type="text" name="datebala" id="datebala" size=20 {include file="_erelem.tpl" ID="datebala" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='прехвърли' NAME='submit' ID='submit'}

<script>
{*
$(document).ready(function(){ldelim}
	$("div.wclose_normal").bind("click",function(){ldelim}
parent.$.nyroModalRemove();
parent.location.reload();
	{rdelim});
{rdelim});
*}
							{if $FROMLISTTOPAYM}
$(document).ready(function(){ldelim}
	$("div.wclose_normal").bind("click",function(){ldelim}
		jQuery.ajax({ldelim}
			url: "tranfiunlocase.ajax.php"
			,success: function(data){ldelim}
					if (data=="ok"){ldelim}
parent.$.nyroModalRemove();
parent.location.reload();
					{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
					{rdelim}
			{rdelim}
		{rdelim});
	{rdelim});
{rdelim});
							{else}
							{/if}
document.forms[0].onsubmit= function(){ldelim}
	$('#submit').hide();
return true;
	{rdelim}
var textmeth= new Array();
	{foreach from=$ARMETH item=text key=indx}
textmeth[{$indx}]= "{$text}";
	{/foreach}
function etog(suff){ldelim}
	var idinpu= "idmeth_"+suff;
	var inva= $("#"+idinpu).attr("value");
	var newinva= parseInt(inva);
	newinva += 1;
	if (newinva=={$COUNMETH}){ldelim}
		newinva= 0;
	{rdelim}else{ldelim}
	{rdelim}
	$("#"+idinpu).attr("value",newinva);
	var idspan= "s"+suff;
	$("#"+idspan).text(textmeth[newinva]);
	if (newinva==0){ldelim}
		$("#idbank_"+suff).show();
		$("#isfull_"+suff).show();
		$("#isring_"+suff).show();
	{rdelim}else{ldelim}
		$("#idbank_"+suff).hide();
		$("#isfull_"+suff).hide();
		$("#isring_"+suff).hide();
	{rdelim}
resizeNyroModalIframe();
{rdelim}
</script>
																{*---- {if count($ARCONS)==0} ----*}
																{/if}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
