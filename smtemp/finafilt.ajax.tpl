<form name="formfilt" method="post">
				{if isset($ARLIST)}
{include file="_select.tpl" FROM=$ARLIST ID="filtpara" SIZE=20 C1="input7" ONCH="document.forms['formfilt'].submit();"}
<br>
<br> &nbsp;
				{else}
???????????????????????
				{/if}
</form>
