{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
<script type='text/javascript' src='js/_docuedit.js'></script>
"}
{include file="_ajax.header.tpl" HEADCODE=$myheadcode}
{if $EDIT == 0}
			{if $smarty.session.iscreacase}
	{assign var="_title" value='въведи нов документ за образуване на дело'}
			{else}
	{assign var="_title" value='ВЪВЕДИ НОВ ДОКУМЕНТ'}
			{/if}
{else}
	{assign var="_title" value='КОРЕГИРАЙ ДОКУМЕНТ '|cat:$DOCUMENT}
{/if}
{include file='_window.header.tpl' TITLE=$_title TABS=$TABS}
{include file="_erform.tpl"}
						
						{*---- 10.04.2009 допълнително потвърждение само при серия нови дела+документи ----*}
						{*---- $CONF===true ----*}
						{if $CONF}
				{foreach from=$smarty.post item=postco key=postin}
<input type="hidden" name="{$postin}" id="{$postin}">
				{/foreach}
<br>
описание
<br>
<b>{$POSTTRAN.text}</b>
<br>
<br>
подател
<br>
<b>{$POSTTRAN.from}</b>
<br>
<br>
бележки
<br>
<b>{$POSTTRAN.notes}</b>
<br>
<br>
	<b>
<font color=red>
<div style="width:300px;">
ВНИМАНИЕ.
</div>
С тези входни данни ще създадете 
<br>
	<font size=+1 color=red>
	{$smarty.post.newcount} броя нови документи и
<br>
	{$smarty.post.newcount} броя нови дела
	</font>
<br>
<nobr>Ако този брой е верен, може да продължите.</nobr>
</font>
	</b>
<br>
<br>
<nobr>
{include file='_but2.tpl' TYPE='submit' TITLE='OK, продължи' NAME='submityes' ID='submityes'}
&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='НЕ, върни се' NAME='submitno' ID='submitno'}
</nobr>
						{else}

{*---- 17.10.2018 външен източник ----*}
	{if $EDIT==0}
		{if $smarty.session.iscreacase}
		{else}
<br>
<input type=checkbox name=ispost id=ispost label="документа е от външен източник и е за връчване"
onclick="postclic();">
<br>
		{/if}
	{else}
		{if $ISPOST}
<br>
<font color=red>
документа е от външен източник и е за връчване
</font>
<input type=hidden name=ispost id=ispost>
<br>&nbsp;&nbsp;&nbsp;&nbsp;източник : <b>{$RODELI.exname}</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;метод : <b>{$ARPOSTTYPE_2[$RODELI.idposttype]}</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;адресат: <b>{$RODELI.adresat}</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;адрес: <b>{$RODELI.address}</b>
<br>
		{else}
		{/if}
	{/if}

тип
<br>
{include file="_select.tpl" FROM=$ARDOCUTYPENAME ID="idtype" C1="input" C2="inputer" 
ONCH="$('#text').attr('value',$(this).get(0).options[$(this).get(0).selectedIndex].text);"}
					<div id="base">
описание
<br>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
<br>подател<br>
<input type="text" name="from" id="from" size=40 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>
<br>бележки<br>
<textarea rows=2 cols=50 name="notes" id="notes" {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
					</div>
					<div id="dipost">
	{if $EDIT==0}
						<span style="display:none">
<br>
<input type="checkbox" name="iscreacase" id="iscreacase" onclick="chancrea();">
документа е за образуване на ново дело (дела)
						</span>
<br>
<div id="creayes" style="display: none;">
брой нови документи и дела
<input type="text" name="newcount" id="newcount" size=4 {include file="_erelem.tpl" ID="newcount" C1="input" C2="inputer"}>
</div>
<div id="creano" style="display: none;">
	{else}
<div id="creano" style="display: block;">
	{/if}
списък на делата, свързани с документа, разделени с интервал<br>
<textarea rows=6 cols=50 name="tacaselist" id="tacaselist" {include file="_erelem.tpl" ID="tacaselist" C1="input" C2="inputer"}></textarea>
</div>
{*---- 09.07.2010 Дичев ----*}
{*---- флаг : за всяко дело - отделен документ, само при нов документ, но не за образуване ----*}
			<span id="flagmd">
			{if $smarty.session.iscreacase or $EDIT<>0}
			{else}
<br>
<input type="checkbox" name="flagmultidoc" id="flagmultidoc" label="за всяко дело да се формира отделен документ с отделен входящ номер">
			{/if}
			</span>
					</div>
					{*---- външен източник за връчване ----*}
					<div id="disour" style="display:none">
<br>
		<fieldset class="filtgr" style="padding:10px;">
		<legend align=right> за връчване </legend>
описание на вх.документ
<br>
<input type="text" name="text2" id="text2" size=50 {include file="_erelem.tpl" ID="text2" C1="input" C2="inputer"}>
{*
<br>подател<br>
<input type="text" name="from2" id="from2" size=40 {include file="_erelem.tpl" ID="from2" C1="input" C2="inputer"}>
*}
<br>външен източник<br>
{include file="_select.tpl" FROM=$ARSOURPOSTNAME ID="iddelisour" C1="input" C2="inputer"}
<br>тип документ за връчване и дело<br>
<textarea rows=2 cols=50 name="notes2" id="notes2" {include file="_erelem.tpl" ID="notes2" C1="input" C2="inputer"}></textarea>
<br>метод на връчване<br>
{include file="_select.tpl" FROM=$ARPOSTTYPENAME_2 ID="idposttype" C1="input" C2="inputer"}
<br>адресат за връчване<br>
<textarea rows=2 cols=50 name="postadresat" id="postadresat" {include file="_erelem.tpl" ID="postadresat" C1="input" C2="inputer"}></textarea>
<br>адрес за връчване<br>
<textarea rows=3 cols=50 name="postaddress" id="postaddress" {include file="_erelem.tpl" ID="postaddress" C1="input" C2="inputer"}></textarea>
		</fieldset>
					</div>

<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

		{if isset($CASEER)}
<span style="font: normal 8pt verdana;">
<br>
<br>
грешки в списъка с дела
				{assign var=perrow value=6}
				{counter start=$perrow assign=coun}
	<table align=center class="calist">
{foreach from=$CASEER item=ele2 key=key2}
			{if $coun==$perrow}
				{counter start=1 assign=coun}
	<tr>
			{else}
				{counter assign=coun}
			{/if}
			{if $ele2.type==0}
				{assign var=tdclas value="erro"}
			{elseif $ele2.type==2}
				{assign var=textti value="делото липсва, но номера превишава максималния "|cat:$ele2.link}
				{assign var=tdclas value="erro"}
				{assign var=onclic value=""}
			{else}
				{assign var=textti value="дублирано дело"}
				{assign var=tdclas value="dubl"}
				{assign var=onclic value=""}
			{/if}
	<td id="cont{$ele2.idcode}"> 
<span class="{$tdclas}" title="{$textti}" onclick="{$onclic}"> 
{$ele2.text} 
</span>
{/foreach}
	</table>
</span>
		{else}
		{/if}
						{/if}

	{if $EDIT==0 and !$CONF}
<script>
var obcrea= document.getElementById("iscreacase");
var obcreayes= document.getElementById("creayes");
var obcreano= document.getElementById("creano");
			{if $smarty.session.iscreacase}
obcrea.checked= true;
			{else}
			{/if}
chancrea();
function chancrea(){ldelim}
{*----
//	if (obcrea.checked){ldelim}
	if (obcrea.checked || {if $smarty.session.iscreacase}true{else}false{/if}){ldelim}
----*}
	if (obcrea.checked){ldelim}
		obcreayes.style.display= "block";
		obcreano.style.display= "none";
		resizeNyroModalIframe();
	{rdelim}else{ldelim}
		obcreayes.style.display= "none";
		obcreano.style.display= "block";
		resizeNyroModalIframe();
	{rdelim}
{rdelim}
</script>
	{else}
	{/if}

<script>
var sendlist= [
{$SENDCODE}
];
function caseacti(p1,p2){ldelim}
	$("#"+p1).html("<img src='ajaxload.gif'>");
	$("#"+p1).load(encodeURI("docucase.ajax.php"+p2));
{rdelim}

{*---- 17.10.2018 външен източник ----*}
postclic();
var oldtype= {$smarty.post.idtype} +0;
function postclic(){ldelim}
	var obje= document.getElementById("ispost");
{***
alert(obje.checked);
//alert(obje.checked+'/'+'{$ISPOST});
{if isset($ISPOST)}
	alert("ISPOST="+"{if $ISPOST}TRUE{else}FALSE{/if}");
{else}
	alert("ISPOST=notset");
{/if}
***}
	if(obje.checked){ldelim}
oldtype= $('#idtype').val();
		$('#idtype').val({$EXTETYPE});
		$('#dipost').hide();
		$('#base').hide();
					{if $EDIT==0}
		$('#disour').show();
					{else}
					{/if}
	{rdelim}else{ldelim}
$('#idtype').val(oldtype);
		$('#base').show();
					{if $ISPOST}
		$('#dipost').hide();
					{else}
		$('#dipost').show();
					{/if}
		$('#disour').hide();
	{rdelim}
	resizeNyroModalIframe();
{rdelim}
</script>

<style>
table.calist td span {ldelim}padding-left:10px;padding-right:10px;margin-left:4px;{rdelim}
.norm {ldelim}color:black;cursor:help;{rdelim}
.dubl {ldelim}color:white;background-color:black;cursor:help;{rdelim}
.erro {ldelim}color:white;background-color:red;cursor:pointer;{rdelim}
.e2inva {ldelim}color:white;background-color:orange;cursor:help;{rdelim}
.e2exis {ldelim}color:white;background-color:green;cursor:help;{rdelim}
</style>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
