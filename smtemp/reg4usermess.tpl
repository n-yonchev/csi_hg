{include file="_tab2.tpl"}
<style>
.over {ldelim}background-color:silver;{rdelim}
.caselink {ldelim}font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
body {ldelim}margin:0px 10px;{rdelim}
</style>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък грешки от ЦРД-2014 по дела {$REG4USNAME}
		<tr class='head2'>
<td> дело
<td> грешка
<td> време
<td> пас
{foreach from=$LIST item=elem key=ekey}
				<tr onmouseover="$(this).addClass('over');" onmouseout="$(this).removeClass('over');">
<td class="caselink" {include file="_href.tpl" LINK=$elem.edit}> {$elem.caseri}/{$elem.cayear}
<td> 
	{foreach from=$elem.artext item=textelem}
		{if empty($textelem[0])}
		{else}
			{$textelem[0]}
				{if empty($textelem[1])}
				{else}
<br>
<span style="font:normal 8pt courier;color:blue">{$textelem[1]}</span>
				{/if}
			<br>
					{if isset($elem.texttip)}
<span style="background-color:gold" onmouseover="$('#t{$elem.ekey}').show();" onmouseout="$('#t{$elem.ekey}').hide();"> 
виж [{$elem.id}] </span>
<div id="t{$elem.ekey}" style="background-color:silver; font:normal 8pt courier; display:none;">
<pre>{$elem.texttip}</pre>
</div>
					{else}
					{/if}
		{/if}
	{/foreach}
<td> {$elem.time|date_format:"%d.%m.%Y %H:%M:%S"}
<td> {$elem.idreg4}
{/foreach}

{include file="_tab2pagi.tpl"}
