{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE=$USERNAME|cat:' - корекция на профила'}
{include file="_erform.tpl"}

{*---- указание за паролата ----*}
{include file="_passinstruc.tpl"}
нова парола
<br>
<input type="password" name="pass1" id="pass1" size=60 {include file="_erelem.tpl" ID="pass1" C1="input" C2="inputer"}> 
<br>
повтори новата парола
<br>
<input type="password" name="pass2" id="pass2" size=60 {include file="_erelem.tpl" ID="pass2" C1="input" C2="inputer"}> 
<br>
избери изглед за делата
<br>
{include file="_select.tpl" FROM=$ARPLANNAME ID="mainplan" C1="input" C2="inputer"}

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
