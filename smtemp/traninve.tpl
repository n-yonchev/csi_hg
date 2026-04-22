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
<td colspan='200'>списък на описите с преводи
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
<td colspan=3 align=center> номер
<td> статус
<td colspan=2> създаден
<td> описание
<td> банка
<td> iban
<td> брой<br>прев
<td align=right> сума
<td colspan=3 align=center> включен в пакет
<td> включи към пакет

{foreach from=$LIST item=elem key=ekey}
		{include file="_tab2tr.tpl"}
									{assign var=txstatinve value=$ARPACKTEXT[$elem.idstatinve]}
									{assign var=sudata value=$ARCOUN[$elem.id]}
					{if $elem.idstatinve==0}
<td align=center class="pa{$elem.idstatinve}">&nbsp;{$elem.id}&nbsp;
					{elseif $elem.idstatinve==1}
						{if $elem.idstat==0}
<td align=center>
<span class="to0" title="активирай" {include file="_href.tpl" LINK=$elem.tostat0}><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						{else}
<td> &nbsp;
						{/if}
					{elseif $elem.idstatinve==2}
<td> &nbsp;
					{else}
<td> ??????
					{/if}
					{if $elem.idstatinve==0}
						{if $sudata.coun==0}
<td>&nbsp;
						{else}
<td align=center>
<span class="to1" title="заключи" {include file="_href.tpl" LINK=$elem.tostat1}><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						{/if}
					{elseif $elem.idstatinve==1}
<td align=center class="pa{$elem.idstatinve}">&nbsp;{$elem.id}&nbsp;
					{elseif $elem.idstatinve==2}
<td> &nbsp;
					{else}
<td> ??????
					{/if}
					{if $elem.idstatinve==0}
<td> &nbsp;
					{elseif $elem.idstatinve==1}
<td> &nbsp;
					{elseif $elem.idstatinve==2}
<td align=center class="pa{$elem.idstatinve}">&nbsp;{$elem.id}&nbsp;
					{else}
<td> ??????
					{/if}
<td> {$txstatinve}
<td> {$elem.created|date_format:"%d.%m.%Y"} 
<td> {$elem.usernameinve}
<td> {$elem.desc}
<td> {$ARBANKPAYM[$elem.idbank]}
<td> {$elem.iban}
		{if $sudata.coun==0}
<td>&nbsp;
		{else}
<td align=center bgcolor=wheat style="cursor:pointer;" title="виж преводите"
{include file="_href.tpl" LINK=$elem.view}> {$sudata.coun}
		{/if}
<td align=right> {$sudata.suma|tomo3}
					{if $elem.idpack==0}
<td align=center> не
									{assign var=txstat value=""}
					{else}
									{assign var=txstat value=$ARPACKTEXT[$elem.idstat]}
<td align=center bgcolor="{$ARPACKCOLO[$elem.idstat]}" title="{$txstat}">
{$elem.idpack}
					{/if}
<td> {$txstat} &nbsp;
<td> 
			{if $elem.idpack==0}
&nbsp;
			{else}
				{if $elem.idstat==0}
<img src="images/exclude.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elem.exde} title="изключи описа от пакета"> 
				{else}
&nbsp;
				{/if}
			{/if}
{*---- пакети за назначаване ----*}
			{if $elem.idpack==0}
<td>
{*
								{if isset($ARPACKLINK[$elem.id]) and $ARCOUN[$elem.id]<>0}
*}
								{if $elem.idstatinve==1 and $sudata.coun<>0 and isset($ARPACKLINK[$elem.id])}
				{foreach from=$ARPACKLINK[$elem.id] item=elem key=ekey}
&nbsp;
					{if $ekey==0}
<span class="toin" {include file="_href.tpl" LINK=$elem.link}> 
нов </span>
					{else}
<span class="toin" {include file="_href.tpl" LINK=$elem.link} title="{$ARBANKPAYM[$elem.idbank]} {if isset($elem.coun)}{$elem.coun}{else}0{/if} превода"> 
{$ekey} </span>
					{/if}
{*
					{if $ekey==0}
<a href="#" onclick="indepack('новия ПАКЕТ','{$elem.link}'); return false;"> 
&nbsp;
<span class="toin"> 
нов </span>
</a>
					{else}
<a href="#" bank="{$elem.idbank}" onclick="indepack('ПАКЕТ {$ekey}','{$elem.link}',{$elem.idbank}); return false;"> 
&nbsp;
<span class="toin" title="{$ARBANKPAYM[$elem.idbank]} {if isset($elem.coun)}{$elem.coun}{else}0{/if} превода"> 
{$ekey} </span>
</a>
					{/if}
*}
				{/foreach}
						{if isset($PACKER)}
&nbsp;&nbsp;
<font color=red>{$PACKER}</font>
						{else}
						{/if}
								{else}
&nbsp;
								{/if}
			{else}
<td>&nbsp;
			{/if}




{/foreach}
{include file="_tab2pagi.tpl"}

					</table>
