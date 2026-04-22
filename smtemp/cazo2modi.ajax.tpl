{include file="_ajax.header.tpl"}
{if $EDIT <= 0}
	{assign var="_title" value='въведи нов предмет'}
{else}
	{assign var="_title" value='корегирай съществуващ предмет'}
{/if}
{include file='_window.header.tpl' TITLE=$_title WIDTH=500}
{include file="_erform.tpl"}


описание
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}> 

<br>
тип
<br>
{include file="_select.tpl" FROM=$ARTYPENAME ID="idtype" C1="input" C2="inputer"}

{*------------------ контейнер -------------------*}
<div id="suma" class="inputcont" style="display: none; padding: 6px;">
<span id="subt">
	подтип
{include file="_select.tpl" FROM=$ARSTNAME ID="idsubtype" C1="input" C2="inputer"}
	<br>
</span>
	сума
<input type="text" name="amount" id="amount" class="input" size=12 {include file="_erelem.tpl" ID="amount" C1="input" C2="inputer"}
autocomplete=off> 
<span id="tobr">
	<br>
</span>
<span id="fromda">
	от дата
<input type="text" name="fromdate" id="fromdate" class="input" size=12 {include file="_erelem.tpl" ID="fromdate" C1="input" C2="inputer"}> 
</span>
<span id="toda">
	до дата
<input type="text" name="todate" id="todate" class="input" size=12 {include file="_erelem.tpl" ID="todate" C1="input" C2="inputer"}> 
</span>
	<span id="type1text">
	<br>
	</span>
</div>
{*-------------------------------------*}

<br>
взискател
<br>
{include file="_select.tpl" FROM=$ARCLAINAME ID="idclaimer" C1="input" C2="inputer"}

{*--------------- СТАНДАРТ checkbox list ------------------*}
{*
<br>
длъжници
<br>
<div 
		{if isset($LISTER.listde)}
class="inputer" onmouseover="viewer('listde');" onmouseout="viewer('');"
		{else}
class="input"
		{/if}
>
		{foreach from=$ARDEBT item="dename" key="deid"}
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" class="input" name="listde[]" value="{$deid}" label="{$dename}">
<br/>
		{/foreach}
</div>
*}
<br>
{*----- дв-86/17----- *}
длъжници {if isset($LISTER.listde)}&nbsp;<span style="color:red;">{$LISTER.listde}</span>{else}{/if}
<br>
		{foreach from=$ARDEBT item="dename" key="deid"}
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" class="input" name="listde[]" value="{$deid}" label="{$dename}">
<br/>
		{/foreach}
{*---------------------------------*}

<div id="flag" style="display: none;">
{*----
<br>
<input type="checkbox" name="istoclaimer" id="istoclaimer" label="сумата да се превежда ли на взискателя">
----*}
<br>
{*----- дв-86/17----- *}
<input type="checkbox" name="isintax" id="isintax" label="сумата да участва ли в таксата за ЧСИ по т.26">
{if isset($LISTER.isintax)}<br><span style="color:red;">{$LISTER.isintax}</span>{else}{/if}
</div>
{*@@@
<br>
избери тип на вземането
<br>
{include file="_select.tpl" FROM=$AR4TYPENAME ID="t4type" C1="input" C2="inputer"}
<br>
избери вид на вземането
<br>
{include file="_select.tpl" FROM=$AR4VARINAME ID="t4vari" C1="input" C2="inputer"}
@@@*}

{*----- дв-86/17----- *}
<br>
избери тип на предмета съгласно ДВ-86/17
{include file="cazo2at2.inc.tpl"}

<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{* <input type="submit" class="submit" name="submit" id="submit" value="запиши"> *}

{*---- скрипт за скриване/показване според типа --------------------------------*}
<script type="text/javascript">
//parent.$.nyroModalSettings({ldelim}height:400{rdelim});
//parent.$.nyroModalSettings({ldelim}width:700{rdelim});
var obtype= document.getElementById("idtype");
var obcase= document.getElementById("suma");
var obsubt= document.getElementById("subt");
var obflag= document.getElementById("flag");
obtype.onchange= typechan;
	var obt1= document.getElementById("type1text");
	var obfrom= document.getElementById("fromdate");
	var obto= document.getElementById("toda");
	var obbr= document.getElementById("tobr");
	obfrom.onkeyup= t1text;
typechan();
t1text();
function typechan(){ldelim}
{*
	if (obtype.value==1 || obtype.value==2 || obtype.value==3){ldelim}
*}
	if (obtype.value==1 || obtype.value==2 || obtype.value==3 || obtype.value==5){ldelim}
		obcase.style.display= "block";
		obflag.style.display= "block";
		obto.style.display= "none";
		obbr.style.display= "none";
		if (obtype.value==2){ldelim}
			//parent.$.nyroModalSettings({ldelim}height:340,width:450{rdelim});
			obsubt.style.display= "block";
			//resizeNyroModalIframe();
		{rdelim}else{ldelim}
			//parent.$.nyroModalSettings({ldelim}height:320,width:450{rdelim});
			obsubt.style.display= "none";
			//resizeNyroModalIframe();
		{rdelim}
{*
		if (obtype.value==3){ldelim}
*}
		if (obtype.value==3 || obtype.value==5){ldelim}
			obto.style.display= "";
			obbr.style.display= "";
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}else{ldelim}
		obcase.style.display= "none";
		obflag.style.display= "none";
		//parent.$.nyroModalSettings({ldelim}height:260,width:450{rdelim});
		//resizeNyroModalIframe();
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
function t1text(){ldelim}
	if (obtype.value==1){ldelim}
		if (obfrom.value==""){ldelim}
			obt1.style.color= "red";
			obt1.innerHTML= "празна дата - сумата НЯМА да се олихвява";
		{rdelim}else{ldelim}
			obt1.style.color= "";
			obt1.innerHTML= "ИМА дата - сумата ще се олихвява";
		{rdelim}
	{rdelim}else{ldelim}
	{rdelim}
return true;
{rdelim}
</script>

{*---- скрипт за js календара --------------------------------*}
{*----
{include file="_jscale.tpl" FIELD="fromdate"}
----*}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
