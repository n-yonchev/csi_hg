{include file="_base.header.tpl"}
<style>
.gene {ldelim}font:normal 10pt verdana;{rdelim}
.link {ldelim}background-color:#dddddd;cursor:pointer;padding-left:10px;padding-right:10px;{rdelim}
.mark {ldelim}background-color:khaki;{rdelim}
</style>

<center class="gene">
{if $ISDOCUOUT}ИЗХОДЯЩ{else}входящ{/if} документ <b>{$RODATA.docuseri}/{$RODATA.docuyear}</b> 
				{if $COUNCASE==1}
&nbsp;&nbsp;&nbsp;
по изп.дело <b>{$RODATA.caseseri}/{$RODATA.caseyear}</b>  
&nbsp;&nbsp;&nbsp;
деловодител <b>{$RODATA.username}</b>
				{else}
по <b>{$COUNCASE} броя</b> дела 
				{/if}
							{if count($ARSCAN)==0}
<br>
<br>
няма сканирани изображения
							{else}
								{if count($ARSCAN)==1}
								{else}
<br>
разгледай сканирано изображение &nbsp;&nbsp;&nbsp;
{foreach from=$ARSCAN item=elem key=indx}
			{math equation="a+b" a=$indx b=1 assign="cuindx"}
	<a class="link {if $indx==$CUINDX}mark{else}{/if}" {include file="_href.tpl" LINK=$elem.link}
	title="качен от {$elem.username} на {$elem.time|date_format:"%d.%m.%Y %H:%M"}">
	{$cuindx}</a> &nbsp;
{/foreach}
								{/if}
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="dele('{$LINKDELE}'); return false;"><img src="images/free.gif" title="изтрий текущото изображение"></a>
<br>
			{if isset($NOVIEWTYPE)}
<br>
тип на файла <font size=+1>{$NOVIEWTYPE}</font> не може да сe изобрази
			{else}
{***
<iframe id="framscan" src="docuedits2.ajax.php?p1={$IDDOCU}&p2={$CUINDX}" width=900 height=1300 frameborder=1></iframe>
***}
<iframe id="framscan" src="docuedits2.ajax.php?p1={$IDDOCU}&p2={$CUINDX}{if $ISDOCUOUT}&p3=1{else}{/if}" width=900 height=1300 frameborder=1></iframe>
			{/if}
							{/if}
</center>

<script>
				{if isset($ISRELO)}
$(document).ready(function() {ldelim}
					{if $ISINCASE}
{*
	window.opener.$('#t5link').click();
*}
	window.opener.$('#{$ZOSCAN}').click();
					{else}
	window.opener.document.location.reload();
					{/if}
{rdelim});
				{else}
				{/if}
function dele(link){ldelim}
	if(confirm('потвърди изтриването на текущото изображение')) window.location.href=link;
{rdelim}
</script>

{include file="_base.footer.tpl"}
