{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="получаване данните от искането" WIDTH=400}
{include file="_erform.tpl"}
<style>
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
.data {ldelim}font:normal 8pt verdana;{rdelim}
.dloc {ldelim}font:normal 8pt verdana;color:blue;{rdelim}
.h2 {ldelim}font:bold 7pt verdana;background-color:lightcyan;{rdelim}
.h3 {ldelim}font:normal 7pt verdana;background-color:moccasin;{rdelim}
</style>
<script>
nyremo= function(){ldelim}parent.location.reload();{rdelim}
</script>

{if $ISLO}<b>ЛОКАЛНО</b> {else}{/if}
искане номер <b>{$CODE}</b>
<br>

											{if $VARI==1}
<br>
<span id="subm">
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> получи </a>
&nbsp;
<span class="contcase">данните от искането</span>
</span>

											{elseif $VARI==2}
<span id="subm">
<span class="tose">сървъра върна {$MESS}</span>
<hr>
{$ERTX}
<hr>
<a class="aspec" href="{$LINKTOSE}" onclick="$('#subm').addClass('tose').html('почакай, обръщение към сървъра ...');return true;"> опитай пак </a>
&nbsp;
<span class="contcase">да получиш данните от искането</span>
</span>
											{elseif $VARI==3}
<br>
<center>
искането с този номер вече е използвано
</center>
<br>
											{else}
											{/if}

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
