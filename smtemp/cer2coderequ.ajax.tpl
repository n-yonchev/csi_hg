{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="вземане номер на искането" WIDTH=340}
{include file="_erform.tpl"}
<style>
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
</style>
<script>
nyremo= function(){ldelim}parent.location.reload();{rdelim}
</script>

			<table align=center>
			<tr>
<td> подател
<td> <b>{$D2.name}</b> {if $D2.idtype==1}ЕГН={else}ЕИК={/if}{$D2.egneik}
			<tr>
<td> иска справка за
<td> <b>{$D2.name2}</b>
			{if $D2.idtype2==1}
ЕГН={$D2.param}
			{elseif $D2.idtype2==2}
ЕИК={$D2.param}
			{elseif $D2.idtype2==3}
чуждестр.лице
			{else}
?????
			{/if}
			<tr>
<td> фактура
<td> <b>{if $D2.isinvo==0}без фактура{else}да се издаде{/if}</b>

			<tr>
<td colspan=2> 
{*
<br>
<span id="subm">
{include file='_button.tpl' TYPE='submit' TITLE='вземи' NAME='submit' ID='submit'}
<br>
<span class="contcase">номер на искането за справка от регистъра</span>
</span>
{include file='_button.tpl' HREF='{$LINKTOSE}' TITLE='вземи'}
*}
					{if isset($ERTX)}
					{else}
						{if isset($CODEREQU)}
						{else}
<br>
<span id="subm">
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> вземи </a>
<br>
<span class="contcase">номер на искането за справка от регистъра</span>
</span>
						{/if}
					{/if}
			</table>

					{if isset($ERTX)}
<span id="subm">
<span class="tose">сървъра върна {$MESS}</span>
<hr>
{$ERTX}
<hr>
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> опитай пак </a>
&nbsp;
<span class="contcase">да вземеш номер на искането</span>
</span>
					{else}
					{/if}
						{if isset($CODEREQU)}
сървъра върна номер искане <font size=+1><b>{$CODEREQU}</b></font>
						{else}
						{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
