{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="въведи за филтъра"}
{include file="_erform.tpl"}

<br>
дата от
<br>
<input type="text" name="date" id="date" size=20 {include file="_erelem.tpl" ID="date" C1="input" C2="inputer"}> 
<br>
дата до
<br>
<input type="text" name="date2" id="date2" size=20 {include file="_erelem.tpl" ID="date2" C1="input" C2="inputer"}> 
<br>
адресата да съдържа
<br>
<input type="text" name="adre" id="adre" size=30 {include file="_erelem.tpl" ID="adre" C1="input" C2="inputer"}> 
<br>
бележките да съдържат
<br>
<input type="text" name="bele" id="bele" size=30 {include file="_erelem.tpl" ID="bele" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='избери' NAME='submit' ID='submit'}

{*---- скрипт за js календара --------------------------------*}
{*----
{include file="_jscale.tpl" FIELD="date"}
{include file="_jscale.tpl" FIELD="date2"}
----*}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
