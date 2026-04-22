{include file="_ajax.header.tpl"}
			{if $EDIT <= 0}	
				{assign var="myti" value="въведи нов ред за фактура"}
			{else}
				{assign var="myti" value="корегирай реда от фактура"}
			{/if}
{include file="_window.header.tpl" TITLE=$myti|cat:" с получател "|cat:$ROINVO.name}
{include file="_erform.tpl"}

		<table>
		<tr>
<td> описание
<td> 
<textarea name="descrip" id="descrip" rows=3 cols=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}></textarea>
		<tr>
<td> м€рка
<td> 
<input type="text" name="meas" id="meas" size=14 {include file="_erelem.tpl" ID="meas" C1="input" C2="inputer"}>
		<tr>
<td> количество
<td> 
<input type="text" name="quan" id="quan" size=14 {include file="_erelem.tpl" ID="quan" C1="input" C2="inputer"}>
		<tr>
<td> ед.цена
<td> 
<input type="text" name="price" id="price" size=20 {include file="_erelem.tpl" ID="price" C1="input" C2="inputer"}>
		</table>

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
