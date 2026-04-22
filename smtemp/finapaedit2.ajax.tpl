<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />

въведи част от име на собственик
<input type="text" name="filtname" id="filtname" size=20 {include file="_erelem.tpl" ID="filtname" C1="input" C2="inputer"}> 
+ enter
							{if count($ACLIST)==0}
<br>
								{if empty($POSTNAME)}
								{else}
няма сметки на собственици с фраза <b>{$POSTNAME}</b> в името
								{/if}
							{else}
<br>
избери една от сметките
на собственици с фраза <b>{$POSTNAME}</b> в името
				<table>
										{assign var=issubmit value=0}
		{foreach from=$ACLIST item=acelem key=ackey}
				<tr bgcolor="silver">
			{if empty($acelem.iban) and empty($acelem.bic)}
<td>
			{else}
{*
<td> <input type="radio" name="idiban" id="idiban" value="{$acelem.id}" {if $acelem.flag}checked{else}{/if}>
<td> <input type="radio" name="idiban" value="{$acelem.id}" onclick="document.forms[0].submit();">
*}
<td> <input type="radio" name="idiban" value="{$acelem.id}" onclick="$('#submit').click();">
			{/if}
<td> {$acelem.c2name}
<td> {$acelem.descrip}
			{if empty($acelem.iban) and empty($acelem.bic)}
<td colspan=2> няма сметка
			{else}
<td> {$acelem.iban}
<td> {$acelem.bic}
										{assign var=issubmit value=1}
			{/if}
		{/foreach}
				</table>
										{if $issubmit==1}
{*
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
*}
										{else}
										{/if}
<br>
или добави нова сметка за превеждане на сумата <b>{$ROTRAN.amount|tomoney2}</b>
			<table align=center style="border: 1px solid black; padding: 6px;">
			<tr>
<td align=right> собственик
<td>
{include file="_select.tpl" FROM=$C2LIST ID="idclaim2" C1="input" C2="inputer"}
				{if empty($IBANER)}
				{else}
			<tr>
<td>
<td> <font color=red>{$IBANER}</font>
				{/if}
			<tr>
<td align=right> iban
<td> 
<input type="text" name="iban" id="iban" class="input" size=50 {include file="_erelem.tpl" ID="iban" C1="input" C2="inputer"}> 
			<tr>
<td align=right> bic
<td>
<input type="text" name="bic" id="bic" class="input" size=20 {include file="_erelem.tpl" ID="bic" C1="input" C2="inputer"}> 
			<tr>
<td align=right> описание
<td> 
<input type="text" name="descrip" id="descrip" class="input" size=40 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}> 
			<tr>
<td>
<td> 
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
			</table>
							{/if}

<script type="text/javascript">
	$('#filtname').autocomplete("finapacoun.ajax.php",{ldelim}matchContains:false, cacheLength:4, selectFirst:false{rdelim});
{*
	$('#idiban').bind("change",function(){ldelim}
//		$(document.forms[0]).submit();
//		document.forms[0].submit();
//alert('ssss');
		$('#submit').click();
	{rdelim});
*}
</script>
