{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="данни за ПДИ изх.номер "|cat:$RODO.serial|cat:"/"|cat:$RODO.year}
{include file="_erform.tpl"}

дата на връчване
<br>
<input type="text" name="date" id="date" size=20 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
	<nobr>
<input type="checkbox" name="flag" id="flag">
започнало ли е доброволното изпълнение
	</nobr>
<br>
задължено лице за днев.изв.действия
<br>
<input type="text" name="person" id="person" size=60 {include file="_erelem.tpl" ID="person" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
