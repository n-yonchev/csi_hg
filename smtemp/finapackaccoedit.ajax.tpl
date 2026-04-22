{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='добави сметка'}
{else}
	{assign var='_title' value='определяне на сметка'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

за превод на разпределена сума <b>{$ROTRAN.amount|tomoney2}</b>
към взискател <b>{$CLAINAME}</b>
<br>
по дело <b>{$SUIT}</b> деловодител <b>{$USERNAME}</b>
<br>
текуща сметка : 
	<b><u>
		{if empty($ROTRAN.iban) and empty($ROTRAN.bic)}
няма
		{else}
{$ROTRAN.iban} &nbsp;&nbsp; {$ROTRAN.bic}
		{/if}
	</u></b>
<br>
избери вариант
<nobr>
		{foreach from=$MODELINK item=liel key=like}
			{if $like==$VARI}
<a style="font: normal 8pt verdana; border-bottom: 1px solid blue; cursor: pointer; color: blue" 
href="{$liel}">{$MODETEXT[$like]}</a>
			{else}
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="{$liel}">{$MODETEXT[$like]}</a>
			{/if}
&nbsp;
		{/foreach}
</nobr>

<br>
<br>
{$FORMCONT}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
