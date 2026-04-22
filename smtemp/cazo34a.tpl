<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
							<table>
							<tr>
							
{*---- лява клетка ----*}
							<td valign=top style="border: 1px solid black; padding:6px">
тип
<br>
{*
{include file="_select.tpl" FROM=$ARTYPENAME ID="idtype" C1="input" C2="inputer"}
*}
{foreach from=$ARTYPE item=elem key=ekey}
		{if empty($elem)}
		{else}
{*
<input type="radio" name="idtype" value='{$ekey}' label="{$elem}" onchange="typechan({$ekey});">
*}
<input type="radio" name="idtype" value='{$ekey}' label="{$elem}" onclick="typechan({$ekey});">
<br>
		{/if}
{/foreach}
име
<br>
<input type="text" name="name" id="name" size=60 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}> 

<br>
<nobr>
		{*---- 20.04.2011 флаг присъединен взискател ----*}
		{if $ISCLAIMER}
<br>
<input type="checkbox" name="isjoin" id="isjoin" label="присъединен взискател"> 
<br>
<input type="checkbox" name="isnoregi" id="isnoregi" label="трето лице, не се предава в регистъра на длъжниците"> 
		{*---- 20.04.2011 флаг да не се предава в регистъра ----*}
		{else}
<br>
<input type="checkbox" name="isnoregi" id="isnoregi" label="да не се предава в регистъра на длъжниците"> 
		{/if}
<nobr>

{*---- средна клетка ----*}
							<td valign=top style="border: 1px solid black; padding:6px">

{*------------------ контейнер за тип=1 юрид.лице -------------------*}
<div id="t1" style="display: none;">
				<table align=center>
				<tr>
				<td align=right>
	ЕИК
				<td>
<input type="text" name="bulstat" id="bulstat" class="input" size=20 {include file="_erelem.tpl" ID="bulstat" C1="input" C2="inputer"}> 
	{*---- линк-икона за търсене ----*}
	&nbsp;&nbsp;&nbsp;
	<a id="lin1" href="#" onclick="dosearch('bulstat'); return false;"> 
	<img src="images/search.png">
	</a>
				<tr>
				<td align=right>
	удост [фирм.дело]
				<td>
<input type="text" name="regidocu" id="regidocu" class="input" size=10 {include file="_erelem.tpl" ID="regidocu" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	от дата
				<td>
<input type="text" name="regidate" id="regidate" class="input" size=16 {include file="_erelem.tpl" ID="regidate" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	съд
				<td>
<input type="text" name="regicase" id="regicase" class="input" size=30 {include file="_erelem.tpl" ID="regicase" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	представлявано от
				<td>
<input type="text" name="regipers" id="regipers" class="input" size=30 {include file="_erelem.tpl" ID="regipers" C1="input" C2="inputer"}> 
				<tr>
				<td align=right>
	с егн
				<td>
<input type="text" name="regipersegn" id="regipersegn" class="input" size=30 {include file="_erelem.tpl" ID="regipersegn" C1="input" C2="inputer"}> 
				<tr>
<td> избери подтип
<td> {include file="_select.tpl" FROM=$AR1TYPENAME ID="t1type" C1="input" C2="inputer"}
{***
				<tr>
<td> избери статус
<td> {include file="_select.tpl" FROM=$AR1STATNAME ID="t1stat" C1="input" C2="inputer"}
***}
{*---- ------------------------------------------- ----*}
				<tr>
<td colspan=2>
<input type="checkbox" name="t1fo" id="t1fo" label="чуждестранна фирма" onclick="t1fochan();"> 
<br>
	<span id="t1foyes" style="display: none;">
държава
{include file="_select.tpl" FROM=$ARCORYNAME ID="t1cory" C1="input" C2="inputer"}
	</span>
{*---- ------------------------------------------- ----*}
				</table>
</div>
{*-------------------------------------*}

{*------------------ контейнер за тип=2 физич.лице -------------------*}
<div id="t2" style="display: none;">
	ЕГН
<input type="text" name="egn" id="egn" size=20 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}> 
	{*---- линк-икона за търсене ----*}
	&nbsp;&nbsp;&nbsp;
	<a id="lin2" href="#" onclick="dosearch('egn'); return false;"> 
	<img src="images/search.png">
	</a>
	{*-------------------------------*}
{*--------------------------
<br>
<input type="checkbox" name="t2et" id="t2et" label="едноличен търговец"> 
--------------------------*}
<br>
<input type="checkbox" name="t2fo" id="t2fo" label="чужд гражданин" onclick="t2fochan();"> 
	<span id="t2foyes" style="display: none;">
{*@@@
&nbsp;&nbsp;&nbsp;&nbsp;
рожд.дата
<input type="text" name="t2date" id="t2date" size=20 {include file="_erelem.tpl" ID="t2date" C1="input" C2="inputer"}> 
<br>
@@@*}
&nbsp;&nbsp;&nbsp;&nbsp;
държава
<br>
{*
<input type="text" name="t2cory" id="t2cory" size=20 {include file="_erelem.tpl" ID="t2cory" C1="input" C2="inputer"}> 
*}
{include file="_select.tpl" FROM=$ARCORYNAME ID="t2cory" C1="input" C2="inputer"}
	</span>
</div>
{*-------------------------------------*}

{*------------------ контейнер за тип=3 други -------------------*}
{*---- ----*}
<div id="t3" style="display: none;">
избери подтип
{include file="_select.tpl" FROM=$AR3TYPENAME ID="t3type" C1="input" C2="inputer"}
<br>
ЕИК
<input type="text" name="buls2" id="buls2" class="input" size=20 {include file="_erelem.tpl" ID="buls2" C1="input" C2="inputer"}> 
</div>
{*---- ----*}
{*-------------------------------------*}

{*---- дясна клетка ----*}
							<td valign=top style="border: 1px solid black; padding:6px">
представител
<br>
<input type="text" name="agent" id="agent" size=40 {include file="_erelem.tpl" ID="agent" C1="input" C2="inputer"}> 
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=40 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
{*
<br>
BIC
<br>
<input type="text" name="bic" id="bic" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
*}

							</table>

{*
<span id="coderesu" style="display: none; padding: 6px; background-color: #bbbbff">
</span>
<span id="coderesu" style="display: none; padding: 6px;">
</span>
*}

{*----
<br>
адрес
<br>
<input type="text" name="address[]" id="address" size=70 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}
onkeypress="var cval= this.value;if(cval==''){ldelim}alert('ddddd');{rdelim}"
> 
----*}
{*--------*}
							
							<table>
							<tr>
{*---- лява клетка ----*}
							<td valign=top> 
адреси
<br>
<textarea name="address" id="address" rows=4 cols=80 {include file="_erelem.tpl" ID="address" C1="input" C2="inputer"}></textarea>
{***
представител
<br>
<input type="text" name="agent" id="agent" size=40 {include file="_erelem.tpl" ID="agent" C1="input" C2="inputer"}> 
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=40 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
<br>
BIC
<br>
<input type="text" name="bic" id="bic" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
***}
{*---- дясна клетка ----*}
							<td valign=top> 
коментар
<br>
<textarea name="notes" id="notes" rows=4 cols=30 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
							</table>

{*
		{if $ISCLAIMER}
*}
{*
		{else}
<input type="hidden" name="iban" id="iban" size=40 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
<input type="hidden" name="bic" id="bic" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
		{/if}
*}

<br>
{*
		<fieldset id="t2a" class="filtgr" style="display: none; padding: 6px">
*}
		<fieldset id="t2a" style="display:none; padding: 6px">
		<legend align=right><b> данни за съпруг/а </b></legend>
					<table>
					<tr>
					<td valign=top>
име на съпруг/а
<br>
<input type="text" name="name2" id="name2" size=40 {include file="_erelem.tpl" ID="name2" C1="input" C2="inputer"}> 
<br>
ЕГН на съпруг/а
<br>
<input type="text" name="egn2" id="egn2" size=20 {include file="_erelem.tpl" ID="egn2" C1="input" C2="inputer"}> 
					<td valign=top>
адреси на съпруг/а
<br>
<textarea name="address2" id="address2" rows=3 cols=60 {include file="_erelem.tpl" ID="address2" C1="input" C2="inputer"}></textarea>
					</table>
		</fieldset>

					<table>
					<tr>
<td id="coderesu" style="display: none; padding: 6px;">
					</table>

<script type="text/javascript">
		{if $ISCLAIMER}
$('#agent').autocomplete("agclaiauto.ajax.php",{ldelim}matchSubset:false{rdelim});
		{else}
$('#agent').autocomplete("agdebtauto.ajax.php",{ldelim}matchSubset:false{rdelim});
		{/if}
//parent.$.nyroModalSettings({ldelim}width:520, height:580{rdelim}); 
{*---- скрипт за скриване/показване според типа ----*}
function typechan(code){ldelim}
//alert("typechan="+code);
	var indx, cuob;
//	for (indx=1; indx<{$ARLEN}; indx=indx+1){ldelim}
	$("#coderesu").html("");
	for (indx=1; indx<={$ARLEN}; indx=indx+1){ldelim}
		var cuob= document.getElementById("t"+indx);
		if (cuob){ldelim}
			if (indx==code){ldelim}
				cuob.style.display= "block";
				resizeNyroModalIframe();
			{rdelim}else{ldelim}
				cuob.style.display= "none";
				resizeNyroModalIframe();
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
		var cuob2= document.getElementById("t"+indx+"a");
		if (cuob2){ldelim}
			if (indx==code){ldelim}
				cuob2.style.display= "block";
				resizeNyroModalIframe();
			{rdelim}else{ldelim}
				cuob2.style.display= "none";
				resizeNyroModalIframe();
			{rdelim}
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
	if (code==1){ldelim}
		t1fochan();
	{rdelim}else{ldelim}
	{rdelim}
	if (code==2){ldelim}
		t2fochan();
	{rdelim}else{ldelim}
	{rdelim}
//				parent.$.nyroModalSettings({ldelim}width:900, height:380{rdelim});
//				resizeNyroModalIframe();
{rdelim}
//t2fochan();
function t1fochan(){ldelim}
	var obfo= document.getElementById("t1fo");
	var obfoyes= document.getElementById("t1foyes");
	if (obfo.checked){ldelim}
		obfoyes.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obfoyes.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
function t2fochan(){ldelim}
	var obfo= document.getElementById("t2fo");
	var obfoyes= document.getElementById("t2foyes");
	if (obfo.checked){ldelim}
		obfoyes.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obfoyes.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}

{*---- търсене и извеждане на списъка ----*}
function dosearch(code){ldelim}
	var codecont= document.getElementById(code).value;
//alert(codecont);
		if (codecont==""){ldelim}
//////////////////////////////alert("липсва съдържание на полето");
//	$("#coderesu").css("display","none");
	$("#coderesu").html("");
		{rdelim}else{ldelim}
	$("#coderesu").css("display","block");
	$("#coderesu").html("<img src='ajaxload.gif'>");
	$("#coderesu").load(encodeURI("cazo34sear.ajax.php?para="+code+"/"+codecont),{ldelim}{rdelim},function() {ldelim}
//		resizeNyroModalIframe();
//		setTimeout("resizeNyroModalIframe();",1000);
	{rdelim});
	resizeNyroModalIframe();
//parent.$.nyroModalSettings({ldelim}width:860, height:680{rdelim});
//parent.$.nyroModalSettings({ldelim}width:900{rdelim});
//				parent.$.nyroModalSettings({ldelim}width:980, height:480{rdelim});
//				resizeNyroModalIframe();
		{rdelim}
{rdelim}
typechan({$smarty.post.idtype});
t1fochan();
t2fochan();
</script>

{*---- показване на списъка ----*}
{*
<script type="text/javascript">
function copyhtml(p1){ldelim}
	$("#tdview").html($("#cont"+p1).html());
{rdelim}
function clearhtml(p1){ldelim}
	$("#tdview").html('');
{rdelim}
</script>
*}
