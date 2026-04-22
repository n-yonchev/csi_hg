{include file="_ajax.header.tpl"}{include file='_window.header.tpl' TITLE="разпределение на сума"}{include file="_erform.tpl"}
{include file="_erform.tpl"}

<center class="n10">
разпределение на сума <b>{$HEADDATA.amou|tomoney}</b>
<br>
по дълговете на длъжник <b>{$HEADDATA.name}</b>
		{if isset($TEXTMESS)}
<br>
<span class="former">{$TEXTMESS}</span>
		{else}
		{/if}
</center>
<br>

			<table class="d_table" align=center>
{*----
			<tr>
			<td class="cont" colspan=3> начално състояние
			<td class="cont" colspan=3> текущо състояние
----*}
<table class="d_table" width='100%' cellspacing='0' cellpadding='0' align=center>
	<tbody>
		<tr class='header'>
			<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> тип&nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> нач.сума&nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td >&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td><span> неолих&nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> лихва&nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> главница&nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td >&nbsp;</td>
		</tr>
	{assign var="sudist1" value=$SUDIST[1]}
	{assign var="sudist2" value=$SUDIST[2]}
	{assign var="sudist3" value=$SUDIST[3]}
<script>
var lis1= new Array();
var lis2= new Array();
var lis3= new Array();
</script>
		{foreach from=$DATA item=elem key=ekey}
			<tr valign=top>
			<td class="contleft"> 
						{assign var="myid" value=$elem.id}
				<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация">
						{assign var="arindx" value=$elem.idtype}
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> {$ARTYPE.$arindx}
			<td class='sep'>&nbsp;</td>
			<td class="contregu"> {$elem.amount|tomoney}
			<td class='sep'>&nbsp;</td>
			<td class="contleft"> <b>текущо</b>
			<td class='sep'>&nbsp;</td>
			<td class="contregu"> {$elem.lastamou|tomoney2}
			<td class='sep'>&nbsp;</td>
			<td class="contregu"> {$elem.lastinte|tomoney2}
			<td class='sep'>&nbsp;</td>
			<td class="contregu"> {$elem.lastcapi|tomoney2}
			<td class='sep'>&nbsp;</td>
{*---- 2-ри ред - входни полета за погасяване ----*}
			<tr valign=top>
			<td class="contbott"> &nbsp;
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> &nbsp;
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> &nbsp;
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> <b>погасяване</b>
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> 
	{if isset($sudist1.$myid)}
{assign var="inpuid" value="p_"|cat:$myid|cat:"_capi"}
<input class="inputright" type="text" name="{$inpuid}" id="{$inpuid}" size=12 value="{$sudist1.$myid|tomoney}" onkeyup="suminput();"> 
<script>
lis1[lis1.length]= "{$inpuid}";
</script>
	{else}
		&nbsp;
	{/if}
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> 
	{if isset($sudist2.$myid)}
{assign var="inpuid" value="p_"|cat:$myid|cat:"_capi"}
<input class="inputright" type="text" name="{$inpuid}" id="{$inpuid}" size=12 value="{$sudist2.$myid|tomoney}" onkeyup="suminput();"> 
<script>
lis2[lis2.length]= "{$inpuid}";
</script>
	{else}
		&nbsp;
	{/if}
			<td class='sep'>&nbsp;</td>
			<td class="contbott"> 
	{if isset($sudist3.$myid)}
{assign var="inpuid" value="p_"|cat:$myid|cat:"_inte"}
<input class="inputright" type="text" name="{$inpuid}" id="{$inpuid}" size=12 value="{$sudist3.$myid|tomoney}" onkeyup="suminput();"> 
<script>
lis3[lis3.length]= "{$inpuid}";
</script>
	{else}
		&nbsp;
	{/if}

{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
описание : <b>{$elem.text}</b>
<br>
нач.дата : <b>{$elem.fromdate|date_format:"%d.%m.%Y"}</b>
<br>
				{assign var="arindx" value=$elem.idclaimer}
взискател : <b>{$ARCLAI.$arindx}</b>
</span>
		{/foreach}
{*---- сумарен ред --------------------------------*}
			<td class='sep'>&nbsp;</td>
			<td >&nbsp;</td>
			<tr>
			<td class="cont" colspan=7> общо за погасяване
			<td class='sep'>&nbsp;</td>
			<td id="sum1" class="cont" style="text-align: right;"> 0
			<td class='sep'>&nbsp;</td>
			<td id="sum2" class="cont" style="text-align: right;"> 0
			<td class='sep'>&nbsp;</td>
			<td id="sum3" class="cont" style="text-align: right;"> 0
			<td class='sep'>&nbsp;</td>
			<td id="sum4" class="cont" style="text-align: right;"> 0
			</table>

{*---- за извеждане на доп.информация - tooltip ---------------------------*}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 260, local:true, cursor:'pointer' {rdelim});
	//parent.$.nyroModalSettings({ldelim}width:720, height:400{rdelim});
	suminput();
{rdelim});
function suminput(){ldelim}
	var sum1= sumtype(lis1);
		var fix1= sum1.toFixed(2);
		document.getElementById("sum1").innerHTML= fix1;
	var sum2= sumtype(lis2);
		var fix2= sum2.toFixed(2);
		document.getElementById("sum2").innerHTML= fix2;
	var sum3= sumtype(lis3);
		var fix3= sum3.toFixed(2);
		document.getElementById("sum3").innerHTML= fix3;
	var sum4= sum1+sum2+sum3;
		var fix4= sum4.toFixed(2);
		document.getElementById("sum4").innerHTML= fix4;
	var heam= {$HEADDATA.amou}.toFixed(2);
		if (fix4+0.00==heam+0.00){ldelim}
			document.getElementById("sum4").style.backgroundColor= "";
		{rdelim}else{ldelim}
			document.getElementById("sum4").style.backgroundColor= "#dd6666";
		{rdelim}
{rdelim}
function sumtype(parr){ldelim}
	var indx;
	var suma= 0.00;
	for (indx=0; indx<parr.length; indx++){ldelim}
//alert(indx+'/'+parr[indx]);
		suma += parseFloat(document.getElementById(parr[indx]).value);
//alert(suma);
	{rdelim}
return suma;
{rdelim}
</script>
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
