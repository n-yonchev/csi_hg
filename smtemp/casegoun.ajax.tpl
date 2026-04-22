{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="ВНИМАНИЕ"}
{include file="_erform.tpl"}

				{if $LOCKEDBY==0}
<nobr>
Делото може да бъде отключено безопасно.
</nobr>
				{else}
<nobr>
<br>
Преди да отключите делото, убедете се, че потребителя 
<br>
<b>{$USERNAME}</b> не го е отворил в момента.
<br>
В противен случай е възможно разминаване на данните по делото.
</nobr>
				{/if}
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='отключи' NAME='submit' ID='submit'}

<br>
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
