{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корекция на дата за погасяването"}
{include file="_erform.tpl"}

<br>
сума <font size=+1><b>{$DATA.inco}</b></font>
<br>
<br>
дата за погасяването
<br>
<input type="text" name="datebala" id="datebala" size=20 {include file="_erelem.tpl" ID="datebala" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
&nbsp;&nbsp;

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
