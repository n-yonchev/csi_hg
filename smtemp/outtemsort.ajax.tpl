{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="подреждане на изх.шаблон"}
{include file="_erform.tpl"}

<b>{$RODOTY.text}</b>
<br>
<br>
вмъкни този шаблон преди избрания
<br>
{include file="_select.tpl" FROM=$ARDATANAME ID="iddoty" C1="input" C2="inputer" ONCH="document.forms[0].submit();"}
<br>&nbsp;

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
