{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="запазване на номера с празни сметки/фактури" WIDTH=360}
{include file="_erform.tpl"}
									{if $RETUCODE== -2}
<input type="hidden" name="invocoun" id="invocoun"> 
<input type="hidden" name="invodate" id="invodate"> 
ВНИМАНИЕ.
<br>
За да запазите <b>{$smarty.post.invocoun} номера</b>, ще създадете :
<br>
<br>
<b>{$smarty.post.invocoun}</b> нови сметки с дата <b>{$DATE}</b> и номера <b>след {$MXBILL}</b>
<br>
и 
<br>
<b>{$smarty.post.invocoun}</b> нови фактури с дата <b>{$DATE}</b> и номера <b>след {$MXINVO}</b>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='създай' NAME='submyes' ID='submyes'}
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}
<br> &nbsp;
									{else}
<br>
брой на празните сметки/фактури
<br>
<input type="text" name="invocoun" id="invocoun" size=6 {include file="_erelem.tpl" ID="invocoun" C1="input" C2="inputer"}> 
<br>
дата за всички празни сметки/фактури
<br>
<input type="text" name="invodate" id="invodate" {include file="_erelem.tpl" ID="invodate" C1="input" C2="inputer"}> 
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
<br> &nbsp;
									{/if}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
