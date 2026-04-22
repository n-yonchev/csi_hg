			{if isset($EXITCODE)}
{include file="_ajax.header.tpl"}
{include file="_ajax.footer.tpl"}
			{else}

<form name="formdebt" method="post">
				{if isset($ARLIST)}
{include file="_select.tpl" FROM=$ARLIST ID="debtnewid" SIZE=6 C1="input7" ONCH="document.forms['formdebt'].submit();"}
<br>
<br> &nbsp;
				{else}
???????????????????????
				{/if}
</form>

			{/if}
