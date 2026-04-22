{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE='Вход'}
{include file="_erform.tpl"}

{*----
избери потребител
<br>
<select name="iduser" id="iduser" size=10 onchange="document.forms[0].submit();"> {$USERLISTNAME}
</select>
----*}

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
{* <input type="submit" class="submit" name="submit" id="submit" value="влез"> *}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
