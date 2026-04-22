{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="заключено постъпление" WIDTH=360}
{include file="_erform.tpl"}

ВНИМАНИЕ.
<br>
Вероятно в момента <b>{$USERNAME}</b> извършва корекция на това постъпление от <b>{$INCO}</b> €.
<br>
<br>
Ако това е така, 
<br>
изчакай приключването на корекцията и след това 
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='обнови' NAME='submrefr' ID='submrefr'}
списъка с постъпления.
<br>
<br>
ИЛИ без да чакаш приключването
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='излез' NAME='submexit' ID='submexit'}
от този екран
<br>
<br>
Ако в момента <b>СЪС СИГУРНОСТ</b> не се извършва корекция на това постъпление,
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='отключи' NAME='submunlo' ID='submunlo'}
постъплението и обнови екрана.
<br>
<br>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
