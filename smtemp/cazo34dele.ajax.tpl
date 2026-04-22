{include file="_ajax.header.tpl"}
	{assign var="_title" value='изтриване на '|cat:$TYPETEXT}
{include file='_window.header.tpl' TITLE=$_title}
{include file="_erform.tpl"}

<br>
<nobr>
	{if $CASECOUN==0}
потвърди изтриването на {$TYPETEXT} <b>{$NAME}</b>
	{else}
{$TYPETEXT} <b>{$NAME}</b> участва в {$CASECOUN} {if $CASECOUN==1}елемент{else}елемента{/if} от предмета на изпълнение
<br>
и не може да бъде изтрит
	{/if}
</nobr>

<br>
<br>
	{if $CASECOUN==0}
{include file='_but2.tpl' TYPE='submit' TITLE='да' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
	{else}
	{/if}
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
