{include file="_ajax.header.tpl"}
{if $EDIT <= 0}
	{assign var="_title" value='въведи нова молба'}
{else}
	{assign var="_title" value='корегирай молбата'}
{/if}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

за издаване на удостоверение за вписване в регистъра на длъжниците
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

		<fieldset class="filtgr">
		<legend align=right> общи данни </legend>
			<table>
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
			</table>
		</fieldset>

		<fieldset class="filtgr">
		<legend align=right> удостоверението се издава за </legend>
			<table>
			<tr>
<td> <nobr>физическо лице с ЕГН</nobr>
<td>
<input type="text" name="egn" id="egn" size=30 {include file="_erelem.tpl" ID="egn" C1="input" C2="inputer"}
onkeyup="onch('egn');" autocomplete=off>
			<tr>
<td> <nobr>юридическо лице с ЕИК</nobr>
<td>
<input type="text" name="eik" id="eik" size=30 {include file="_erelem.tpl" ID="eik" C1="input" C2="inputer"}
onkeyup="onch('eik');" autocomplete=off>
			<tr>
<td> <nobr>чужд гражданин с име</nobr>
<td>
<input type="text" name="foname" id="foname" size=60 {include file="_erelem.tpl" ID="foname" C1="input" C2="inputer"}
onkeyup="onch('foname');" autocomplete=off>
			<tr>
<td> <nobr>адресат</nobr>
<td>
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>описание</nobr>
<td>
<input type="text" name="descrip" id="descrip" size=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
			<tr>
			</table>
		</fieldset>

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

<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

<script>
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
</script>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
