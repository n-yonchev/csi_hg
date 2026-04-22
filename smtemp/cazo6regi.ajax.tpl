{include file="_ajax.header.tpl" ONLOAD="chancrea();"}
{include file="_window.header.tpl" TITLE="регистриране на изходящ документ"}
{include file="_erform.tpl"}

												{if isset($smarty.post.branstri)}
<input type="hidden" name="branstri" id="branstri">
<input type="hidden" name="getnext" id="getnext">
<input type="hidden" name="serinome" id="serinome">
<input type="hidden" name="notes" id="notes">
	<input type="hidden" name="regitext" id="regitext">
	<input type="hidden" name="regitax" id="regitax">
						{*---- за връчването ----*}
						{if $ISPOST}
<input type="hidden" name="idposttype" id="idposttype">
<input type="hidden" name="postadresat" id="postadresat">
<input type="hidden" name="postaddress" id="postaddress">
						{else}
						{/if}
<br>
ВНИМАНИЕ.
<br>
Ще бъдат изходени <font size=+1><b>{$COUNBRAN} броя</b></font> документи с различни последователни изходящи номера и различни адресати.
<br>
След това : 
<ul>
<li> Няма да може да промените <u>броя на тези документи.</u> </li>
<li> Няма да може да изтриете <u>нито един от тези документи.</u> </li>
<li> Ще може да корегирате тези документи <u>само поотделно.</u> </li>
{*
<li> Ще може да отпечатите тези документи наведнъж. </li>
*}
</ul>
Откажете изходяването, ако имате съмнения в : 
<ul>
<li><u>съдържанието</u> на документа,</li>
<li><u>броя</u> на копията</li>
<li>или в <u>списъка</u> на адресатите.
</ul>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='изходи '|cat:$COUNBRAN|cat:' броя документи' NAME='submit' ID='submit'}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='откажи' NAME='cancel' ID='cancel'}

												{else}

<input type="checkbox" name="getnext" id="getnext" onclick="chancrea();">
вземи поредния изходящ номер - евентуално <b>{$NEXTNUMB}</b>
	<div id="seriente" style="display: block;">
или въведи желания изходящ номер
<input type="text" name="serinome" id="serinome" size=10 {include file="_erelem.tpl" ID="serinome" C1="input" C2="inputer"}>
	</div>
									{*---- ако има списък с клонове, няма адресат ----*}
									{if isset($ARBRAN)}
<input type="hidden" name="adresat" id="adresat" value="PLACEAD">
									{else}
				{*---- 09.04.2010 - за ПДИ адресата може да се избира от списъка на длъжниците ----*}
				{if isset($ARDEBTNAME)}
<br>
избери длъжник за адресат
{include file="_select.tpl" FROM=$ARDEBTNAME ID="debtname" C1="input" C2="inputer"
ONCH="$('#adresat').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);"}
				{else}
				{/if}
<br>
адресат
<br>
<input type="text" name="adresat" id="adresat" size=60 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
									{/if}
<br>
бележки
<br>
<input type="text" name="notes" id="notes" size=60 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}>
<br>
				{*---- евентуално списък с клонове ----*}
				{if isset($ARBRAN)}
<br>
избери клонове за изходяване
&nbsp;&nbsp;&nbsp;&nbsp;
{include file="cazo6bran.tpl"}
				{else}
				{/if}
				{*---- евентуално за предмет на изпълнение ----*}
{*
				{if $ISREGITAX and isset($ARBRAN)}
*}
				{if $ISREGITAX}
{*
<br>
		<div style="margin-left:50px;padding: 10px; border: 1px solid black">
			{if $NOADDSUB}
<font color= red>
нулева такса. НЯМА да бъде добавен предмет на изпълнение
</font>
			{else}
ще бъде добавен предмет на изпълнение
<br>
с описание
<br>
<input type="text" name="regitext" id="regitext" size=80 {include file="_erelem.tpl" ID="regitext" C1="input" C2="inputer"}>
<br>
и сума
<br>
<input type="text" name="regitax" id="regitax" size=10 {include file="_erelem.tpl" ID="regitax" C1="input" C2="inputer"}>
			{/if}
		</div>
*}
{include file="_cazo6tax.tpl"}
				{else}
				{/if}
						{*---- за връчването ----*}
						{if $ISPOST}
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчването </legend>
метод
<br>
{include file="_select.tpl" FROM=$ARPOSTTYPENAME_2 ID="idposttype" C1="input" C2="inputer"}
							{*---- 30.03.2017 при размножаване не се въвеждат адрес и адресат ----*}
							{if isset($ARBRAN)}
							{else}
<br>
адресат 
<br>
<input type="text" name="postadresat" id="postadresat" class="input" size=100 {include file="_erelem.tpl" ID="postadresat" C1="input" C2="inputer"}> 
<br>
адрес 
<br>
<input type="text" name="postaddress" id="postaddrress" class="input" size=100 {include file="_erelem.tpl" ID="postaddress" C1="input" C2="inputer"}> 
							{/if}
		</fieldset>
						{else}
						{/if}
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
var obje= document.getElementById("getnext");
var obente= document.getElementById("seriente");
			var retax= {$smarty.post.regitax} +0;
			var retext= "{$TEMPTEXT}";
			var tempmark= "{$TEMPMARK}";
//chancrea();
function chancrea(){ldelim}
	if (obje.checked){ldelim}
		obente.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obente.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
</script>
												
												{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
