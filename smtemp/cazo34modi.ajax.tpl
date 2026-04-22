{include file="_ajax.header.tpl"}

{if $EDIT <= 0}
	{assign var="_title" value='ÂÚÂÅÄÈ ÍÎÂ '|cat:$TYPETEXT}
{else}
	{assign var="_title" value='ÊÎĞÅÃÈĞÀÉ ÑÚÙÅÑÒÂÓÂÀÙ '|cat:$TYPETEXT}
{/if}

{include file='_window.header.tpl' TITLE=$_title WIDTH=700}
{include file="_erform.tpl"}

{include file="cazo34a.tpl"}

<br>
{include file='_but2.tpl' TYPE='submit' TITLE='çàïèøè' NAME='submit' ID='submit'}
			{if $SUB2}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='çàïèøè ñ ãğåøêè' NAME='submit2' ID='submit2'}
			{else}
			{/if}
<br>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
