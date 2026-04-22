{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="извлечение"}
{include file="_erform.tpl"}

					{if $VARI=="INIT" or $VARI===NULL}
		{if $ERTEXT==""}
		{else}
{*
<span class="former"> {$ERTEXT} </span>
*}
<span><font color=red> {$ERTEXT} </font></span>
<br>
<br>
		{/if}
<br>
от коя банка е файла с извлечението
{include file="_select.tpl" FROM=$ARXMLNAME ID="xmlsuffix" C1="input" C2="inputer" ONCH="tosuff();"}
{*
ONCH="$('#banksuff').load('finabanksuff.ajax.php?indx='+$(this).get(0).options[$(this).get(0).selectedIndex].value);"}
*}
<br>
<br>
избери <font color=red><b><span id="banksuff"></span></b></font> файл с извлечението
<br>
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
<input type="file" name="file" id="file" size=50 class="input">
<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='приеми файла' NAME='submit' ID='submit'}
					{else}
					{/if}

					{if $VARI=="submit"}
<input type="hidden" name="xmlsuffix">
		{if $ERTEXT==""}
		{else}
{*
<span class="former"> {$ERTEXT} </span>
*}
<span><font color=red> {$ERTEXT} </font></span>
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
<td class="t8" colspan=4> 
<br>
<center class="n10">
основни параметри на извлечението
</center>
<br>
	<tr>
<td class="t8"> сметка
<td class="filtvisu" colspan=3> <b>{$DATA.iban}</b>
	<tr>
<td class="t8"> от дата
<td class="filtvisu" colspan=3> <b>{$DATA.date1}</b>
	<tr>
<td class="t8"> до дата
<td class="filtvisu" colspan=3> <b>{$DATA.date2}</b>
	<tr>
<td class="t8"> нач.салдо
<td class="filtvisu" colspan=3> <b>{$DATA.balance1}</b>
	<tr>
<td class="t8"> кр.салдо
<td class="filtvisu" colspan=3> <b>{$DATA.balance2}</b>
	<tr>
<td class="t8" colspan=4> 
<br>
<center class="n10">
статистика на извлечението
</center>
<br>
	<tr>
					{if $DATA.cotot==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> <nobr>общо редове</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;{$DATA.cotot}</b>
	<tr>
<td class="t8"> <nobr>&nbsp;-&nbsp; разходи</nobr>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;{$DATA.cotot-$DATA.coinp}</b>
	<tr>
					{if $DATA.coinp==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> <nobr>&nbsp;-&nbsp; постъпления</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;{$DATA.coinp}</b>
	<tr>
					{if $DATA.codub==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> <nobr>&nbsp;-&nbsp;&nbsp;-&nbsp; дублирани</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;{$DATA.codub}</b>
	<tr>
					{if $DATA.conew==0}
						{assign var="foco" value="color='red'"}
					{else}
						{assign var="foco" value=""}
					{/if}
<td class="t8"><font {$foco}> <nobr>&nbsp;-&nbsp;&nbsp;-&nbsp; нови</nobr> </font>
<td class="filtvisu"> <b>&nbsp;&nbsp;&nbsp;{$DATA.conew}</b>
	</table>
<br>
			{if $DATA.conew==0}
			{else}
{*----
{include file='_button.tpl' TYPE='submit' TITLE='въведи '|cat:$DATA.conew|cat:' нови постъпления' NAME='action' ID='action'}
----*}
{include file='_button.tpl' TYPE='submit' TITLE='приеми извлечението' NAME='action' ID='action'}
			{/if}
					{else}
					{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}

<script>
tosuff();
function tosuff(){ldelim}
	$('#banksuff').load('finabanksuff.ajax.php?indx='+$('#xmlsuffix').get(0).options[$('#xmlsuffix').get(0).selectedIndex].value);
{rdelim}
</script>
