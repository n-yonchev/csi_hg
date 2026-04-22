{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
"}
{include file="_ajax.header.tpl" HEADCODE=$myheadcode}
{include file='_window.header.tpl' TITLE="корегирай сметка на взискател" WIDTH=360}
{include file="_erform.tpl"}

										<table>
										<tr>
										<td>
<b>{$CLAINAME}</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ЕИК=<b>{$EIK}</b>
<br>
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=30 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
{*
<br>
BIC
<br>
<input type="text" name="bic" id="bic" size=10 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}
onblur="bicbank(this.value);"> 
*}
<br>
банка
<br>
<input disabled type="text" name="bankname" id="bankname" size=100 {include file="_erelem.tpl" ID="bankname" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
										</table>

<script>
function bic2(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
$('#bankname').attr("value",arre[1]);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>

<style>
.iban {ldelim};float:left;width:180px;font:normal 7pt verdana;{rdelim}
.bankname {ldelim};float:left;width:280px;font:normal 7pt verdana;{rdelim}
.case {ldelim};float:left;width:60px;font:normal 7pt verdana;{rdelim}
</style>
<script>
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
$('#iban').autocomplete('tranclaiiban.ajax.php?eik={$EIK}',{ldelim}matchContains:false, cacheLength:4, selectFirst:false
						, width:540, formatItem:formrow{rdelim});
$('#iban').result(function(event, data, formatted){ldelim}
	$("#bankname").attr("value",data[1]);
//	$("#bic").attr("value",data[1]);
//	bicbank($("#bic").attr("value"));
{rdelim});
function formrow(data,i,total){ldelim}
	return "<div class='iban'>"+data[0]+"&nbsp;</div><div class='bankname'>"+data[1]+"&nbsp;</div><div class='case'>"+data[2]+"&nbsp;</div>";
{rdelim}
</script>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
