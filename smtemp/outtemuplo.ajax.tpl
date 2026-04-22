{include file="_ajax.header.tpl"}
	{assign var=myti value="смяна на файла за изх.шаблон &quot;"|cat:$TEMPTEXT|cat:"&quot;"}
{include file='_window.header.tpl' TITLE=$myti}
{include file="_erform.tpl"}
						
			{if empty($FILENAME)}
			{else}
ВНИМАНИЕ.
<br>
Текущия файл <b>{$FILENAME}</b>
<br>
ще бъде изтрит след качване на новия.
<br>
			{/if}
		{if $ERTEXT==""}
		{else}
<div style="color:red"> {$ERTEXT} </div>
		{/if}
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
