{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="качване на файл"}
{include file="_erform.tpl"}

					{if $VARI=="INIT"}
		{if $ERTEXT==""}
		{else}
<span class="former"> {$ERTEXT} </span>
<br>
<br>
		{/if}
			{if empty($FILENAME)}
			{else}
ВНИМАНИЕ.
<br>
Текущия файл <b>{$FILENAME}</b>
<br>
ще бъде изтрит след качване на новия.
<br>
<br>
			{/if}
избери файла за качване
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='качи файла' NAME='submit' ID='submit'}
					{else}
					{/if}

					{if $VARI=="submit"}
		{if $ERTEXT==""}
файла е качен успешно
		{else}
<span class="former"> {$ERTEXT} </span>
<br>
<br>
		{/if}
					{else}
					{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
