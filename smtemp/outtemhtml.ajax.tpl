{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="корегирай съдържанието на шаблон &quot;"|cat:$TEMPTEXT|cat:"&quot;"}
{include file="_erform.tpl"}
						
<textarea style="margin-left:20px;margin-right:20px;" name="htmlcont" id="htmlcont" rows=24 cols=100 
{include file="_erelem.tpl" ID="htmlcont" C1="input" C2="inputer"}></textarea>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
