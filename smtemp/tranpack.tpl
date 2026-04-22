{include file="_tab2.tpl"}
<style>
.pa0 {ldelim}background-color:{$ARPACKCOLO[0]};{rdelim}
.pa1 {ldelim}background-color:{$ARPACKCOLO[1]};{rdelim}
.pa2 {ldelim}background-color:{$ARPACKCOLO[2]};{rdelim}
.to0 {ldelim}background-color:{$ARPACKCOLO[0]};cursor:pointer;{rdelim}
.to1 {ldelim}background-color:{$ARPACKCOLO[1]};cursor:pointer;{rdelim}
.to2 {ldelim}background-color:{$ARPACKCOLO[2]};cursor:pointer;{rdelim}
</style>
					<table class="tab2" cellspacing='0' cellpadding='2' align=center>
					<tr class='head1'>
<td colspan='200'>списък на пакетите с преводи
{***
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								{if isset($ARV2COUN)}
			{foreach from=$ARV2COUN item=elem key=ekey}
			{/foreach}
<br>
								{else}
								{/if}
***}
					<tr class='head2'>
<td colspan=7 align=center style="font-size:7pt;"> описание на пакета
<td colspan=5 align=center style="font-size:7pt;"> съдържание на пакета
<td colspan=3 align=center style="font-size:7pt;"> файлове
					<tr class='head2'>
{*****
<td> 
<td> #
<td> 
*****}
<td colspan=3 align=center> номер
<td> статус
<td colspan=2> създаден
<td> банка
<td> общ<br>брой<br>преводи
<td align=center> номера описи
<td> прев<br>извън<br>описи
<td> брой<br>пре<br>води
<td> обща<br>сума
<td> файл
<td> 
<td align=center> описи
{*
<td>&nbsp;
*}

{foreach from=$LIST item=elem key=ekey}
		{include file="_tab2tr.tpl"}
									{assign var=txstat value=$ARPACKTEXT[$elem.idstat]}
									{assign var=padata value=$ARCOUN[$elem.id]}
					{if $elem.idstat==0}
<td align=center class="pa{$elem.idstat}">&nbsp;{$elem.id}&nbsp;
					{elseif $elem.idstat==1}
<td align=center>
<span class="to0" title="активирай" {include file="_href.tpl" LINK=$elem.tostat0}><sup>&nbsp;&nbsp;&nbsp;</sup></span>
					{elseif $elem.idstat==2}
<td> &nbsp;
					{else}
<td> ??????
					{/if}
					{if $elem.idstat==0}
						{if $padata.coun==0}
<td>&nbsp;
						{else}
<td align=center>
<span class="to1" title="заключи" {include file="_href.tpl" LINK=$elem.tostat1}><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						{/if}
					{elseif $elem.idstat==1}
<td align=center class="pa{$elem.idstat}">&nbsp;{$elem.id}&nbsp;
					{elseif $elem.idstat==2}
<td align=center>
<span class="to1" title="маркирай като заключен" onclick="goto1({$elem.id},'{$elem.tostat1}','{$ARBANKPAYM[$elem.idbank]}'); return false;">
<sup>&nbsp;&nbsp;&nbsp;</sup></span>
					{else}
<td> ??????
					{/if}
					{if $elem.idstat==0}
<td> &nbsp;
					{elseif $elem.idstat==1}
						{if $padata.coun==0}
<td>&nbsp;
						{else}
<td align=center>
<span class="to2" title="маркирай като приключен" onclick="goto2({$elem.id},'{$elem.tostat2}','{$ARBANKPAYM[$elem.idbank]}'); return false;">
<sup>&nbsp;&nbsp;&nbsp;</sup></span>
						{/if}
					{elseif $elem.idstat==2}
<td align=center class="pa{$elem.idstat}">&nbsp;{$elem.id}&nbsp;
					{else}
<td> ??????
					{/if}



<td> {$txstat}
<td> {$elem.created|date_format:"%d.%m.%Y"} 
<td> {$elem.usernamepack}
<td> {$ARBANKPAYM[$elem.idbank]} {if $elem.code==$CODEBANKPOST}/бюджетен{else}{/if}
{*---- общо преводи ----*}
		{if $padata.coun==0}
<td>&nbsp;
		{else}
{*
<td align=center bgcolor=wheat style="cursor:pointer;" title="виж преводите"
{include file="_href.tpl" LINK=$elem.view}> {$ARCOUN[$elem.id]}
*}
<td align=center> {$padata.coun}
		{/if}
{*
					{if $elem.idpack==0}
<td align=center> не
									{assign var=txstat value=""}
					{else}
									{assign var=txstat value=$ARPACKTEXT[$elem.idstat]}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idstat]}" title="{$txstat}">
{$elem.idpack}
					{/if}
<td> {$txstat}
*}
{*---- списък описи ----*}
<td> 
		{if count($ARINVE[$elem.id])==0}
&nbsp;
		{else}
				{foreach from=$ARINVE[$elem.id] item=inveelem key=idinve}
<nobr>
&nbsp;
<span class="toin" style="background-color:wheat" {include file="_href.tpl" LINK=$inveelem.view} 
title="виж {$inveelem.coun} превода от описа за &quot;{$inveelem.accodesc}&quot;"> 
{$idinve} 
</span>
</nobr>
				{/foreach}
		{/if}
{*---- преводи извън описи ----*}
							{assign var=oudata value=$ARCOUN2[$elem.id]}
		{if $oudata.coun==0}
<td>&nbsp;
		{else}
<td align=center bgcolor=wheat style="cursor:pointer;" title="виж преводите"
{include file="_href.tpl" LINK=$ARLINK2[$elem.id]}> {$oudata.coun}
		{/if}
{*---- брой, сума ----*}
<td align=center> {$padata.countota}
<td align=right> {$padata.sumatota|tomo3}
{*---- файл ----*}

					{if $elem.idstat==0 or $padata.coun==0}
<td> &nbsp;
					{else}
<td align=center bgcolor=wheat style="cursor:pointer;" title="генерирай файла за банката" {include file="_href.tpl" LINK=$elem.filegene}">
{$ARBANKPAYMSUFF[$elem.idbank]}
					{/if}
{*---- отпечатване ----*}
					{if $elem.idstat==0 or $padata.coun==0}
<td> &nbsp;
					{else}
<td align=center>
<img src="images/print.gif" title="отпечати всички преводи от пакета" style="cursor:pointer" onclick="fuprin('{$elem.linkprnt}');">
					{/if}
{*---- описите ----*}
<td>
					{if $elem.idstat==0 or $padata.coun==0}
					{else}
		{if count($ARINVE[$elem.id])==0}
&nbsp;
		{else}
				{foreach from=$ARINVE[$elem.id] item=inveelem key=idinve}
<nobr>
&nbsp;
<span style="cursor:pointer" onclick="fuprin('{$inveelem.gene}'); return false;"
title="генерирай документ по опис {$idinve} за &quot;{$inveelem.accodesc}&quot;"> 
{$idinve}<img src="images/excel.gif"> 
</span>
</nobr>
				{/foreach}
		{/if}
					{/if}
{/foreach}
{include file="_tab2pagi.tpl"}

					</table>

<script>
function goto1(paid,link,bank){ldelim}
	if(confirm(
"ВНИМАНИЕ."
+"\\n\\nДосегашния статус на пакет #"+paid+" като ПРИКЛЮЧЕН означаваше,"
+"\\nче всички преводи и описи, включени в него,"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\nи се считаха за ПРИКЛЮЧЕНИ."
+"\\n\\nНовото състояние на пакета като ЗАКЛЮЧЕН"
+"\\nдава възможност да се промени в АКТИВЕН,"
+"\\nслед което от него да бъдат изключени преводи и описи"
+"\\nили към него да се включат нови преводи и описи."
+"\\n\\nПреценете ВНИМАТЕЛНО кои точно преводи и описи от пакета"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\n\\nПотвърди или Откажи маркирането на пакета като ЗАКЛЮЧЕН"
	)) window.location.href=link;
{rdelim}
function goto2(paid,link,bank){ldelim}
	if(confirm(
"ВНИМАНИЕ."
+"\\n\\nМаркирането на пакет #"+paid+" като ПРИКЛЮЧЕН означава,"
+"\\nче всички преводи и описи, включени в него,"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\nи ще се считат за ПРИКЛЮЧЕНИ."
+"\\n\\nПотвърди или Откажи"
	)) window.location.href=link;
{rdelim}
</script>
