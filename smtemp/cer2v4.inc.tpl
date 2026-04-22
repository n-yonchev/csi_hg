{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="получаване фактура по искането" WIDTH=400}
{include file="_erform.tpl"}
<style>
td {ldelim}font:normal 8pt verdana;{rdelim}
.tdtext {ldelim}font:normal 7pt verdana;background-color:silver;padding:2px 16px 2px 6px;{rdelim}
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
.data {ldelim}font:normal 8pt verdana;{rdelim}
.dloc {ldelim}font:normal 8pt verdana;color:blue;{rdelim}
.h2 {ldelim}font:bold 7pt verdana;background-color:lightcyan;{rdelim}
.h3 {ldelim}font:normal 8pt verdana;background-color:moccasin;{rdelim}
</style>
<script>
nyremo= function(){ldelim}parent.location.reload();{rdelim}
</script>

{if $ISLO}<b>ЛОКАЛНО</b> {else}{/if}
искане номер <b>{$CODE}</b>
<br>
<br>
<br>
{assign var=V1 value=false}
{assign var=V2 value=false}
{include file="cer2info.inc.tpl"}

											{if $VARI==1}
<br>
<br>
<span id="subm">
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> получи </a>
&nbsp;
<span class="contcase">фактурата по искането</span>
</span>
<br>

											{elseif $VARI==2}
<br>
<span id="subm">
<span class="tose">сървъра върна {$MESS}</span>
<hr>
{$ERTX}
<hr>
<br>
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> опитай пак </a>
&nbsp;
<span class="contcase">да получиш фактурата по искането</span>
</span>
											{else}
											{/if}
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
