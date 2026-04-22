{include file="_ajax.header.tpl"}
			{if $EDIT==0}
				{assign var=txti value="добави ново дело"}
			{else}
				{assign var=txti value="корегирай за дело"}
			{/if}
{include file="_window.header.tpl" TITLE=$txti}
{include file="_erform.tpl"}

			<table>
			<tr>
<td> номер
<td width=10>
<td> година
<td width=10>
<td> дата образуване
<td width=10>
			<tr>
<td>
<input type="text" name="serial" id="serial" size=10 {include file="_erelem.tpl" ID="serial" C1="input" C2="inputer"}> 
<td>
<td>
{include file="_select.tpl" FROM=$ARYEARNAME ID="year" C1="input" C2="inputer"}
<td>
<td>
<input type="text" name="created" id="created" size=20 {include file="_erelem.tpl" ID="created" C1="input" C2="inputer"}> 
			</table>
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
