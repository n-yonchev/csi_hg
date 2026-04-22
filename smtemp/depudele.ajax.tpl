{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="прекратяване на заместване"}
{include file="_erform.tpl"}

{*
<input type=hidden name="iduserdepu">
<b>прекратяване на заместването от <br>{$NAMEDEPUOLD}</b>
*}
Деловодителя <b>{$NAMEORIG}</b>
<br>
се замества в момента от 
<br>
<b>{$NAMEDEPU}</b>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
След прекратяване на заместването всичките <b>{$COUNORIG} дела</b> 
</nobr>
<br>
<nobr>
ще бъдат възстановени обратно на деловодителя 
</nobr>
<br>
<b>{$NAMEORIG}</b>
{*
<b>прехвърляне на дела</b>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
всички дела на деловодителя <b>{$NAMEORIG}</b>
</nobr>
<br>
<nobr>
ще бъдат прехвърлени на избрания заместник <b>{$NAMEDEPU}</b>
</nobr>
<br>
с възможност за възстановяване
*}
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
