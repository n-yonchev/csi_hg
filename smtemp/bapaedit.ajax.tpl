{include file="_ajax.header.tpl"}
{include file="_window.header.tpl"}
{include file="_erform.tpl"}

					{if $VARI=="INIT"}
		{if $ERTEXT==""}
		{else}
<span class="former"> {$ERTEXT} </span>
<br>
<br>
		{/if}
избери XML файл с банково извлечение
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file" id="file" size=50 class="input">
<br>
<input type="submit" class="submit" name="submit" id="submit" value="запиши"> 
					{else}
					{/if}

					{if $VARI=="submit"}
		{if $ERTEXT==""}
		{else}
<span class="former"> {$ERTEXT} </span>
<br>
<br>
		{/if}
{*----
<center class="n10">
основни параметри на извлечението
</center>
<br>
----*}
	<table class="base" align=center>
	<tr>
<td class="t8" colspan=2> 
<center class="n10">
основни параметри на извлечението
</center>
	<tr>
<td class="t8"> сметка
<td class="filtvisu"> <b>{$DATA.iban}</b>
	<tr>
<td class="t8"> от дата
<td class="filtvisu"> <b>{$DATA.date1}</b>
	<tr>
<td class="t8"> до дата
<td class="filtvisu"> <b>{$DATA.date2}</b>
	<tr>
<td class="t8"> нач.салдо
<td class="filtvisu"> <b>{$DATA.balance1}</b>
	<tr>
<td class="t8"> кр.салдо
<td class="filtvisu"> <b>{$DATA.balance2}</b>
	<tr>
<td class="t8" colspan=2> 
<br>
<center class="n10">
статистика на извлечението
</center>
	<tr>
					{if $DATA.cotot==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> общо редове </font>
<td class="filtvisu"> <b>{$DATA.cotot}</b>
	<tr>
					{if $DATA.coinp==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> &nbsp;-&nbsp; постъпления </font>
<td class="filtvisu"> <b>{$DATA.coinp}</b>
	<tr>
					{if $DATA.codub==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> &nbsp;-&nbsp;&nbsp;-&nbsp; дублирани </font>
<td class="filtvisu"> <b>{$DATA.codub}</b>
	<tr>
					{if $DATA.conew==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> &nbsp;-&nbsp;&nbsp;-&nbsp; нови </font>
<td class="filtvisu"> <b>{$DATA.conew}</b>
	</table>
<br>
<input type="submit" class="submit" name="action" id="action" value="обработка"> 
					{else}
					{/if}
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
