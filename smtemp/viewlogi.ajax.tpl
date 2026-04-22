{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE='вход за наблюдение'}
{include file="_erform.tpl"}

входно име
<br>
<input type="text" name="username" id="username" size=40 {include file="_erelem.tpl" ID="username" C1="input" C2="inputer"}> 
<br>
входна парола
<br>
<input type="password" name="password" id="password" size=40 {include file="_erelem.tpl" ID="password" C1="input" C2="inputer"}> 

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='влез' NAME='submit' ID='submit'}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
