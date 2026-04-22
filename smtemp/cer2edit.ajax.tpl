{include file="_ajax.header.tpl"}
{if $EDIT <= 0}
	{assign var="_title" value='въведи ново искане за справка от регистъра на длъжниците'}
{else}
	{assign var="_title" value='корегирай искането за справка от регистъра на длъжниците'}
{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}
<style>
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
</style>


{*
					{if $EDIT <= 0}
					{else}
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
входящ номер <b>{$D2.serial}/{$D2.year}</b>
&nbsp;&nbsp;&nbsp;
изходящ номер <b>{$D2.seriout}/{$D2.yearout}</b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
въведен от <b>{$D2.u2name}</b> на <b>{$D2.created|date_format:"%d.%m.%Y"}</b>
&nbsp;&nbsp;&nbsp;
послед.корекция от <b>{$D2.lastname}</b> на <b>{$D2.lastmodi|date_format:"%d.%m.%Y"}</b>
					{/if}
*}
		<fieldset class="filtgr">
		<legend align=right> иска справката и плаща таксата </legend>
			<table>
			<tr>
<td> тип
<td>
{*
<span 
		{if isset($LISTER.idtype)}
class="inputer" onmouseover="viewer('idtype');" onmouseout="viewer('');"
		{else}
		{/if}
style="padding:1px 1px 1px 1px"
>
*}
		{foreach from=$ARTYPE item=elem key=ekey}
<input type="radio" name="idtype" value='{$ekey}' label="{$elem}" onclick="typechan({$ekey});">
&nbsp;&nbsp;&nbsp;&nbsp;
		{/foreach}
{*
</span>
*}
			<tr>
<td> име
<td>
<input type="text" name="name" id="name" size=60 {include file="_erelem.tpl" ID="name" C1="input" C2="inputer"}>
			<tr>
<td id="egneiktext"> 
<td>
<input type="text" name="egneik" id="egneik" size=20 {include file="_erelem.tpl" ID="egneik" C1="input" C2="inputer"}>
			<tr id="invowhat">
<td> фактура
<td>
<input type="radio" name="isinvo" value='1' label="да се издаде" onclick="invochan(1);">
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="isinvo" value='0' label="без фактура" onclick="invochan(0);">
{*****
			<tr>
<td> дата на молбата
<td>
<input type="text" name="dateapplic" id="dateapplic" size=20 {include file="_erelem.tpl" ID="dateapplic" C1="input" C2="inputer"}>
			<tr>
<td> описание
<td>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
			<tr>
<td> подател
<td>
<input type="text" name="from" id="from" size=40 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>
			<tr>
<td> бележки
<td>
<textarea rows=2 cols=50 name="notes" id="notes" {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
*****}
			</table>
		</fieldset>

		<fieldset class="filtgr" id="invodata" style="display:none">
		<legend align=right> данни за фактурата </legend>
			<table>
			<tr>
<td> <nobr>ДДС №</nobr>
<td>
<input type="text" name="invovat" id="invovat" size=20 {include file="_erelem.tpl" ID="invovat" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>град
<td>
<input type="text" name="invocity" id="invocity" size=50 {include file="_erelem.tpl" ID="invocity" C1="input" C2="inputer"}>
			<tr>
<td> адрес
<td>
<textarea rows=2 cols=50 name="invoaddr" id="invoaddr" {include file="_erelem.tpl" ID="invoaddr" C1="input" C2="inputer"}></textarea>
			<tr>
<td> МОЛ
<td>
<input type="text" name="invomol" id="invomol" size=60 {include file="_erelem.tpl" ID="invomol" C1="input" C2="inputer"}>
			<tr>
			</table>
		</fieldset>

		<fieldset class="filtgr">
		<legend align=right> справката да се издаде за </legend>
			<table>
			<tr>
<td colspan=3> име
&nbsp;
<input type="text" name="name2" id="name2" size=60 {include file="_erelem.tpl" ID="name2" C1="input" C2="inputer"}>
			<tr>
<td> <nobr><input type="radio" name="idtype2" value='1' label="физическо лице" onclick="chan2('1');"></nobr>
<td rela="t2" view="1"> <nobr>с ЕГН или ЛНЧ</nobr>
<td rela="t2" view="1">
<input type="text" name="egn" id="egn" size=30 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}>
			<tr>
<td> <input type="radio" name="idtype2" value='2' label="юридическо лице" onclick="chan2('2');">
<td rela="t2" view="2"> с ЕИК
<td rela="t2" view="2">
<input type="text" name="eik" id="eik" size=30 {include file="_erelem.tpl" ID="eik" C1="input" C2="inputer"}>
			<tr>
<td colspan=2> <input type="radio" name="idtype2" value='3' label="чуждестр.лице без ЛНЧ" onclick="chan2('3');">
{*****
			<tr>
<td> <nobr>адресат</nobr>
<td>
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>описание</nobr>
<td>
<input type="text" name="descrip" id="descrip" size=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
*****}
			<tr>
			</table>
		</fieldset>

бележки
<br>
<textarea rows=2 cols=50 name="notes" id="notes" {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>

{*****
		<fieldset class="filtgr">
		<legend align=right> данни за платена такса </legend>
			<table>
			<tr>
<td> <nobr>име на платеца</nobr>
<td>
<input type="text" name="taxname" id="taxname" size=40 {include file="_erelem.tpl" ID="taxname" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>дата на плащане</nobr>
<td>
<input type="text" name="taxdate" id="taxdate" size=20 {include file="_erelem.tpl" ID="taxdate" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>платена в банка</nobr>
<td>
{include file="_select.tpl" FROM=$ARBANKNAME ID="idtaxbank" C1="input" C2="inputer"}
			<tr>
<td> <nobr>референтен номер</nobr>
<td>
<input type="text" name="taxrefe" id="taxrefe" size=60 {include file="_erelem.tpl" ID="taxrefe" C1="input" C2="inputer"}>
			<tr>
			</table>
		</fieldset>
*****}

<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
var currcode;
var currinvo;
function typechan(code){ldelim}
//alert("typechan="+code);
	currcode= code;
		if (code==1){ldelim}
			$("#invowhat").show();
			$("#egneiktext").html("ЕГН");
		{rdelim}else{ldelim}
			$("#invowhat").hide();
			$("#egneiktext").html("ЕИК");
		{rdelim}
	invochan();
{rdelim}
function invochan(isinvo){ldelim}
//alert(isinvo+'/'+typeof(isinvo));
		if (typeof(isinvo)!=='undefined'){ldelim}
	currinvo= isinvo;
		{rdelim}else{ldelim}
		{rdelim}
		if (currcode==1 && currinvo==1 || currcode==2){ldelim}
			$("#invodata").show();
		{rdelim}else{ldelim}
			$("#invodata").hide();
		{rdelim}
resizeNyroModalIframe();
{rdelim}
typechan({$smarty.post.idtype});
invochan({$smarty.post.isinvo});
chan2('{$smarty.post.idtype2}');

function chan2(cuid){ldelim}
	$("[@rela='t2']").each(function(){ldelim}
		if ($(this).attr("view")==cuid){ldelim}
			$(this).show();
		{rdelim}else{ldelim}
			$(this).hide();
		{rdelim}
	{rdelim});
{rdelim}
{*
function onch(cuid){ldelim}
	var idlist= new Array("egn","eik","foname");
	var inid, indx;
	for (indx=0; indx<idlist.length; indx++){ldelim}
		inid= idlist[indx];
		if (inid==cuid){ldelim}
		{rdelim}else{ldelim}
$("#"+inid).attr("value","");
		{rdelim}
	{rdelim}
{rdelim}
*}
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
