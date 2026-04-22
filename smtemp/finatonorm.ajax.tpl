{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="превърни проформа фактура в нормална" WIDTH=500}
{include file="_erform.tpl"}

<br>
Ще превърнете проформа фактура <b>{$SERIPROF}</b> на стойност <b>{$SUMABILL}</b>
<br>
в нормална фактура 
			{if $ROBILL.seriinvo==0}
със следващия свободен номер, евентуално <b>{$SERIINVONEXT}</b>
			{else}
с вече назначения номер <b>{$ROBILL.seriinvo}</b>
			{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='превърни' NAME='submit' ID='submit'}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
