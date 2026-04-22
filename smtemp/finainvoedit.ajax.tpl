{include file="_ajax.header.tpl"}
			{if $EDIT <= 0}	
				{assign var="myti" value='въведи за нова фактура (евент.номер '|cat:$MXINVO|cat:')'}
			{else}
				{assign var="myti" value='корегирай фактура '|cat:$SERIINVO}
			{/if}
{include file="_window.header.tpl" TITLE=$myti}
{include file="_erform.tpl"}

{*
дата
<input type="text" name="invodate" id="invodate" size=14 {include file="_erelem.tpl" ID="invodate" C1="input" C2="inputer"}>
{include file="cazoinvo.tpl"}
*}
		<table>
		<tr>
<td colspan=4> 
дата
<input type="text" name="invodate" id="invodate" size=14 {include file="_erelem.tpl" ID="invodate" C1="input" C2="inputer"}>
тип фактура 
{*
{include file="_select.tpl" FROM=$ARINVOTYPESELE ID="idinvotype" C1="input" C2="inputer" ONCH="fuprof(this);"}
*}
									{if $EDIT==0}
{include file="_select.tpl" FROM=$ARINVOTYPESELE ID="idinvotype" C1="input" C2="inputer" ONCH="fuprof(this);"}
									{else}
										{if $smarty.post.idinvotype==1}
<b>проформа</b>
<input type="hidden" name="idinvotype" id="idinvotype"> 
										{else}
{include file="_select.tpl" FROM=$ARINVO2SELE ID="idinvotype" C1="input" C2="inputer" ONCH="fuprof(this);"}
										{/if}
									{/if}
		<span id="profno" style="display:none">
				{if $SERIPROFEXIS}
съществуващ номер
				{else}
нов номер
				{/if}
<input type="text" name="seriprof" id="seriprof" size=14 {include file="_erelem.tpl" ID="seriprof" C1="input" C2="inputer"}> 
		</span>
		<tr>
<td colspan=4>
<input type="checkbox" name="invoisva" id="invoisva" label="ДДС"
	{if $EDIT <= 0}
onclick="calcul();"
	{else}
	{/if}
>
&nbsp;&nbsp;&nbsp;&nbsp;
обща сума <b><span id="sumatota">{$SUMATOTA}</span></b>
&nbsp;&nbsp;&nbsp;&nbsp;
платена сума
<input type="text" name="invopaid" id="invopaid" size=14 {include file="_erelem.tpl" ID="invopaid" C1="input" C2="inputer"}>
&nbsp;&nbsp;&nbsp;&nbsp;
		<tr>
<td colspan=4>
<nobr>
метод на плащане
{include file="_select.tpl" FROM=$ARMETHNAME ID="invometh" C1="input" C2="inputer" ONCH="chuscash();"}
</nobr>
<nobr>
<span rela="uscash"> платено на
<span rela="uscash"> {include file="_select.tpl" FROM=$USERLISTNAME ID="cashiduser" C1="input7" C2="inputer"}
</nobr>
		<tr>
<td colspan=4>
IBAN на ЧСИ като съставител на фактура/сметка
{include file="_select.tpl" FROM=$ARSELENAME ID="iban" C1="iban" C2="inputer"}
							{if $PAIDER}
		<tr>
<td colspan=4>
<font color=red>платената сума надвишава общата</font>
							{else}
							{/if}
		<tr>
<td colspan=4 align=center bgcolor=silver> данни за получателя
		<tr>
<td> име
<td> 
<input type="text" name="invoname" id="invoname" size=40 {include file="_erelem.tpl" ID="invoname" C1="input" C2="inputer"}>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td rowspan=4> 
адрес
<br>
<textarea name="invoaddr" id="invoaddr" rows=4 cols=40 {include file="_erelem.tpl" ID="invoaddr" C1="input" C2="inputer"}></textarea>
		<tr>
<td> ЕГН
<td> 
<input type="text" name="invoegn" id="invoegn" size=20 {include file="_erelem.tpl" ID="invoegn" C1="input" C2="inputer"}>
		<tr>
<td> ЕИК
<td> 
<input type="text" name="invoeik" id="invoeik" size=20 {include file="_erelem.tpl" ID="invoeik" C1="input" C2="inputer"}>
		<tr>
<td> МОЛ
<td> 
<input type="text" name="invopers" id="invopers" size=40 {include file="_erelem.tpl" ID="invopers" C1="input" C2="inputer"}>
<td>
		</table>







{*------------------------------------------------------------------*}
{*---- само при създаване - редовете от фактурата ----*}
			{if $EDIT <= 0}	
<script>
function rocopy(obje){ldelim}
	var obj2= $("#row0").clone().show().appendTo("#tab0");
	obj2.children(":first").children(":first")
		.bind("blur",function(){ldelim}rocopy(this);{rdelim});
	obj2.find("[name^=quan]").bind("keyup",function(){ldelim}calcul();{rdelim});
	obj2.find("[name^=pric]").bind("keyup",function(){ldelim}calcul();{rdelim});
	if (obje){ldelim}$(obje).unbind("blur");{rdelim}
resizeNyroModalIframe();
{rdelim}

function calcul(){ldelim}
//alert('calcul');
	var vatche= $("#invoisva").attr("checked");
	var isva= (vatche) ? 1:0;
//alert(isva);
	var arra= $(":text[name^=quan]",document.forms[0]);
	var a1= "";
	arra.each(function(i){ldelim}
		a1 += ","+$(this).attr("value");
	{rdelim});
	var arra= $(":text[name^=pric]",document.forms[0]);
	var a2= "";
	arra.each(function(i){ldelim}
		a2 += ","+$(this).attr("value");
	{rdelim});
//alert(a1+"^"+a2);
//alert(arra);
	jQuery.ajax({ldelim}
		url: "finainvoeditsuma.ajax.php?p="+isva+"^"+a1+"^"+a2
		,success: succ2
		{rdelim});
{rdelim}

function succ2(data){ldelim}
//alert(data);
	var arre= data.split("^");
	var ok= arre[0];
	var sumaform= arre[1];
	var suma= arre[2];
	if (ok=="ok"){ldelim}
$("#sumatota").text(sumaform);
$("#invopaid").attr("value",suma);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
					<table id="tab0">
					<tr>
<td colspan=4 align=center bgcolor=silver> редове на фактурата
					<tr>
<td> описание
<td> мярка
<td> колич
<td> ед.цена
{foreach from=$smarty.post.desc item=x1 key=key}
		{if $key==0}
					<tr class="tabrow" id="row0" style="display:none">
{*
<td> <input type=text name="desc[]" value="">
*}
<td>
<textarea name="desc[]" rows=2 cols=50 value=""></textarea>
<td valign=top> <input type=text name="meas[]" value="" size=10>
<td valign=top> <input type=text name="quan[]" value="" size=10>
<td valign=top> <input type=text name="pric[]" value="" size=10>
					</tr>
		{else}
					<tr class="tabrow">
{*
<td> <input type=text name="desc[{$key}]"
*}
					{assign var=iddesc value="desc_"|cat:$key}
					{assign var=idmeas value="meas_"|cat:$key}
					{assign var=idquan value="quan_"|cat:$key}
					{assign var=idpric value="pric_"|cat:$key}
<td>
<textarea name="desc[{$key}]" id="{$iddesc}" rows=2 cols=50 {include file="_erelem.tpl" ID=$iddesc C1="input" C2="inputer"}
			{if $key==count($smarty.post.desc)-1}
onblur="rocopy(this);"
			{else}
			{/if}
></textarea>
<td valign=top> <input type=text name="meas[{$key}]" id="{$idmeas}" size=10 {include file="_erelem.tpl" ID=$idmeas C1="input" C2="inputer"}>
<td valign=top> <input type=text name="quan[{$key}]" id="{$idquan}" size=10 {include file="_erelem.tpl" ID=$idquan C1="input" C2="inputer"}
onkeyup="calcul();"
>
<td valign=top> <input type=text name="pric[{$key}]" id="{$idpric}" size=10 {include file="_erelem.tpl" ID=$idpric C1="input" C2="inputer"}
onkeyup="calcul();"
>
					</tr>
		{/if}
{/foreach}
					</table>
			{else}
			{/if}
{*------------------------------------------------------------------*}

<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
function fuprof(obje){ldelim}
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	if (valu==1){ldelim}
//alert(valu);
		$("#profno").show();
	{rdelim}else{ldelim}
		$("#profno").hide();
	{rdelim}
{rdelim}
$(document).ready(function() {ldelim}
	fuprof($("#idinvotype"));
{rdelim})

chuscash();
function chuscash(){ldelim}
	var obje= $("#invometh");
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
//alert(valu);
	if (valu=="c"){ldelim}
		$("[@rela=uscash]").show();
	{rdelim}else{ldelim}
		$("[@rela=uscash]").hide();
	{rdelim}
{rdelim}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
