{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="корекция на фактура за кред.известие" WIDTH=300}
{include file="_erform.tpl"}
<br>
		<table>
		<tr>
<td> кредитното известие е към фактура
<br> 
<input type="text" name="credmess" id="credmess" size=30 {include file="_erelem.tpl" ID="credmess" C1="input" C2="inputer"}>
		</table>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
