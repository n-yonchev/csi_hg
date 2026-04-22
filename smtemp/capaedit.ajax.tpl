{*

	източник : cash.tpl

*}

{include file="_ajax.header.tpl"}

{if empty($LIST)}
	{assign var='_title' value=''}
{include file='_window.header.tpl' TITLE=$_title WIDTH='300'}
{else}
	{assign var='_title' value='избери приходни ордери за включване в пакета'}
{include file='_window.header.tpl' TITLE=$_title }
{/if}



{include file="_erform.tpl"}

									{if empty($LIST)}
няма свободни приходни ордери за включване в пакета

									{else}

{*---- за извеждане на доп.информация - tooltip ---------------------------*}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

<span id="markttip" style="display: hidden;">

</span>



<br>

		{if isset($MESSER)}

<center class="former">{$MESSER}</center>

		{else}

		{/if}
<table class="d_table" width='800px;' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>касови пакети</td>
		</tr>
	</thead>
		<tr class='header'>
			<td><span>  </span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> номер </span></td>
			<td class='sep'>&nbsp;</td>
			<td> дата </td>
			<td class='sep'>&nbsp;</td>
			<td > сума</td>
			<td class='sep'>&nbsp;</td>
			<td > задел </td>
			<td class='sep'>&nbsp;</td>
			<td > остат</td>
			<td class='sep'>&nbsp;</td>
			<td > вносител </td>
			<td class='sep'>&nbsp;</td>
			<td > длъжник </td>
			<td class='sep'>&nbsp;</td>
			<td > дело </td>
			
		</tr>
	<tbody>
		{foreach from=$LIST item=elem key=ekey}

						{if in_array($elem.id,$ARCHECKED)}

							{assign var="mycl" value="t8checked"}

						{else}

							{assign var="mycl" value="t8"}

						{/if}
			<tr class="{$mycl}" id="tr{$elem.id}" marker="ttip" rel="#markttip" title="обща сума" onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
			<td class="t8"> <input type="checkbox" name="listcash[]" value="{$elem.id}" id="td{$elem.id}" onclick="chan(this);"> </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.serial}/{$elem.year} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.date|date_format:"%d.%m.%Y"} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.amount|tomoney} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.amountsep|tomoney2} </td>
			<td class='sep'>&nbsp;</td>
			{assign var="rest" value=$elem.amount-$elem.amountsep}
			<td class="t8" marker="ssum" id="su{$elem.id}"> {$rest|tomoney} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.name} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.debtname} </td>
			<td class='sep'>&nbsp;</td>
			<td class="t8"> {$elem.suseri}/{$elem.suyear} </td>
			</tr>

		{/foreach}
</table>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}


<script>

$(document).ready(function() {ldelim}
//	parent.$.nyroModalSettings({ldelim}width:600, height:500{rdelim});
	$("tr[@marker='ttip']").cluetip({ldelim} width: 180, local:true, cursor:'help', leftOffset:40 {rdelim});
	summing();
{rdelim});
function chan(p1){ldelim}
	var myid= p1.id.substr(2);
	var mytr= document.getElementById("tr"+myid);
	if (p1.checked){ldelim}
		mytr.className= "t8checked";
	{rdelim}else{ldelim}
		mytr.className= "t8";
	{rdelim}
	summing();
return true;
{rdelim}

function summing(){ldelim}
	var suma= 0.00;
	$("td[@marker='ssum']").each(function(){ldelim}
		var myid= this.id.substr(2);
		var mytd= document.getElementById("td"+myid);
//		var mytd= $("#td"+myid);
		if (mytd.checked){ldelim}
//			suma += parseFloat(this.innerHTML);
				var re= /,/g;
				var myco= this.innerHTML.replace(re,"");
			suma += parseFloat(myco);
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim});
	suma= suma.toFixed(2);
//alert(suma);
	var mysuma= "<center><font size=+3>" +suma +"</font></center>";
	document.getElementById("markttip").innerHTML= mysuma;
	if (document.getElementById("cluetip-inner")){ldelim}
		document.getElementById("cluetip-inner").innerHTML= mysuma;
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
</script>

									{/if}


{include file='_window.footer.tpl'}

{include file="_ajax.footer.tpl"}



