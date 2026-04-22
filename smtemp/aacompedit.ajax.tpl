{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="състояние на жалба"}
{include file="_erform.tpl"}

{*----
избери новия статус
<br>
{include file="_select.tpl" FROM=$ARSTATNAME ID="idstatus" C1="input" C2="inputer"}
----*}
				<table>
				<tr>
<td> входящ номер
<td> <b>{$DOCU.serial}/{$DOCU.year}</b>
				<tr>
<td> постъпила на
<td> <b>{$DOCU.created|date_format:"%d.%m.%Y"}</b>
				<tr>
<td> подател
<td> <b>{$DOCU.from}</b>
							{if empty($smarty.post.date2) and empty($smarty.post.date4) and empty($smarty.post.date6) and empty($smarty.post.date8)}
							{else}
				<tr>
<td bgcolor=#eeeeee colspan=2> 
последна промяна <br>на <b>{$ROCONT.created|date_format:"%d.%m.%Y"}</b> от <b>{$ROCONT.username}</b>
							{/if}
				<tr>
<td> приета от ЧСИ на дата
<td>
<input type="text" name="date2" id="date2" size=16 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
				<tr>
<td> внесена такса на дата
<td>
<input type="text" name="date4" id="date4" size=16 {include file="_erelem.tpl" ID="date4" C1="input" C2="inputer"}> 
				<tr>
<td> удовлетворена на дата
<td>
<input type="text" name="date6" id="date6" size=16 {include file="_erelem.tpl" ID="date6" C1="input" C2="inputer"}> 
				<tr>
<td> <nobr>НЕудовлетворена на дата</nobr>
<td>
<input type="text" name="date8" id="date8" size=16 {include file="_erelem.tpl" ID="date8" C1="input" C2="inputer"}> 
				<tr>
<td colspan=2>
бележки по жалбата
<br>
<textarea name="notes" id="notes" rows=6 cols=50 {include file="_erelem.tpl" ID="notes" C1="input" C2="inputer"}></textarea>
				</table>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
