<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
</style>
				<table border=1>
				<tr>
<td colspan=5> <b>
{*
ОПИС {$ROINVE.id}/{$INVEDATE} включен в пакет {$ROINVE.idpack}
*}
ОПИС {$ROINVE.id} включен в пакет {$ROINVE.idpack}
<br>
на суми преведени на {$ROINVE.desc} 
<br>
по сметка {$ROINVE.iban}
<br>
от ЧСИ {$CSINUMB} {$CSINAME}
<br>
създаден {$ROINVE.created|date_format:"%d.%m.%Y %H:%M:%S"} от {$ROINVE.usernameinve}
</b>
				<tr>
<td class="hetext"> №
		{if $ISUSER}
		{else}
<td class="hetext"> име
<td class="hetext"> ЕГН
		{/if}
<td class="hetext"> изп.дело
		{if $ISUSER}
<td class="hetext"> деловодител
		{else}
		{/if}
<td class="hetext"> сума
							{counter start=0 print=false}
							{assign var=suma value=0}
		{foreach from=$LIST item=elem}
				<tr>
<td align=right> {counter}
		{if $ISUSER}
		{else}
<td> {$elem.debtname} {if $elem.isfull}ПЪЛНО{else}{/if}
<td> {if empty($elem.debtegn)}ЕИК={$elem.debtbul}{else}{$elem.debtegn}{/if}
		{/if}
<td> {$elem.caseseri}/{$elem.caseyear}
		{if $ISUSER}
<td> {$elem.username}
		{else}
		{/if}
<td align=right> {$elem.amount|tomoex}
							{math equation="a+b" a=$suma b=$elem.amount assign="suma"}
		{/foreach}
				<tr>
		{if $ISUSER}
<td colspan=2>
		{else}
<td colspan=3>
		{/if}
<td class="hetext"> ОБЩО
<td class="hetext"> {$suma|tomoex}
				</table>
				