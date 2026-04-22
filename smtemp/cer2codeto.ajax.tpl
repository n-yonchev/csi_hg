{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="обработка на искане" WIDTH=400}
{include file="_erform.tpl"}
<style>
.aspec {ldelim}font:normal 8pt verdana;padding:2px 12px 2px 12px;background-color:khaki;{rdelim}
.tose {ldelim}font:normal 8pt verdana;color:red;{rdelim}
.data {ldelim}font:normal 8pt verdana;{rdelim}
.dloc {ldelim}font:normal 8pt verdana;color:blue;{rdelim}
.h2 {ldelim}font:bold 7pt verdana;background-color:lightcyan;{rdelim}
.h3 {ldelim}font:normal 7pt verdana;background-color:moccasin;{rdelim}
</style>

{if $ISLO}<b>ЛОКАЛНО</b> {else}{/if}
искане номер <b>{$CODE}</b>
<br>

											{if $VARI==1}
{*
въведи номер-искане
<br>
<input type="text" name="codeto" id="codeto" size=20 {include file="_erelem.tpl" ID="codeto" C1="input" C2="inputer"}>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='готово' NAME='entercode' ID='entercode'}
					{if isset($ERTX)}
					{else}
					{/if}
*}
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
{*---- данни от сървъра ----*}
{***
<span class="tose">сървъра върна следните данни</span>
												<table align=center cellspacing=2>
												<tr>
<td class="data"> поле
<td class="data"> данни от сървъра
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> локални данни
		{else}
		{/if}
												<tr>
<td colspan=4 class="h2" align=center> иска справката
												<tr>
<td class="data"> име
<td class="data"> {$ARSERV.payeename}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.name}
		{else}
		{/if}
												<tr>
<td class="data"> тип
<td class="data"> {if $ARSERV.payeetype==1}физическо лице{elseif $ARSERV.payeetype==2}юридическо лице{else}??????{/if}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {if $ROC2.idtype==1}физическо лице{elseif $ROC2.idtype==2}юридическо лице{else}??????{/if}
		{else}
		{/if}
												<tr>
<td class="data"> ЕГН/ЕИК
<td class="data"> {$ARSERV.payeeegneik}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.egneik}
		{else}
		{/if}
												<tr>
<td colspan=4 class="h2" align=center> справката е за 
												<tr>
<td class="data"> име
<td class="data"> {$ARSERV.querypersonname}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.name2}
		{else}
		{/if}
												<tr>
<td class="data"> тип
<td class="data"> {if $ARSERV.querypersonforeignperson==1}чуждестранно лице{else}НЕчуждестранно лице{/if}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {if $ROC2.idtype==1}физическо лице{elseif $ROC2.idtype==2}юридическо лице{elseif $ROC2.idtype==3}чуждестранно лице{else}??????{/if}
		{else}
		{/if}
												<tr>
<td class="data"> ЕГН/ЕИК
<td class="data"> {$ARSERV.querypersonegneik}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.param}
		{else}
		{/if}
						{if $ISINVO}
												<tr>
<td colspan=4 class="h2" align=center> данни за фактурата
												<tr>
<td class="data"> ДДС №
<td class="data"> {$ARSERV.payeeevatnumber}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invovat}
		{else}
		{/if}
												<tr>
<td class="data"> град
<td class="data"> {$ARSERV.payeeecity}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invocity}
		{else}
		{/if}
												<tr>
<td class="data"> адрес
<td class="data"> {$ARSERV.payeeeaddress}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invoaddr}
		{else}
		{/if}
												<tr>
<td class="data"> МОЛ
<td class="data"> {$ARSERV.payeeemol}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invomol}
		{else}
		{/if}
						{else}
						{/if}
												</table>
***}
											{elseif $VARI==4}

{*---- данни от сървъра ----*}
<span class="tose">сървъра върна следните данни</span>
												<table align=center cellspacing=2>
												<tr>
<td class="data"> поле
<td class="data"> данни от сървъра
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> локални данни
		{else}
		{/if}
												<tr>
<td colspan=4 class="h2" align=center> иска справката
												<tr>
<td class="data"> име
<td class="data"> {$ARSERV.payeename}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.name}
		{else}
		{/if}
												<tr>
<td class="data"> тип
<td class="data"> {if $ARSERV.payeetype==1}физическо лице{elseif $ARSERV.payeetype==2}юридическо лице{else}??????{/if}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {if $ROC2.idtype==1}физическо лице{elseif $ROC2.idtype==2}юридическо лице{else}??????{/if}
		{else}
		{/if}
												<tr>
<td class="data"> ЕГН/ЕИК
<td class="data"> {$ARSERV.payeeegneik}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.egneik}
		{else}
		{/if}
												<tr>
<td colspan=4 class="h2" align=center> справката е за 
												<tr>
<td class="data"> име
<td class="data"> {$ARSERV.querypersonname}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.name2}
		{else}
		{/if}
												<tr>
<td class="data"> тип
<td class="data"> {if $ARSERV.querypersonforeignperson==1}чуждестранно лице{else}НЕчуждестранно лице{/if}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {if $ROC2.idtype==1}физическо лице{elseif $ROC2.idtype==2}юридическо лице{elseif $ROC2.idtype==3}чуждестранно лице{else}??????{/if}
		{else}
		{/if}
												<tr>
<td class="data"> ЕГН/ЕИК
<td class="data"> {$ARSERV.querypersonegneik}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$ROC2.param}
		{else}
		{/if}
						{if $ISINVO}
												<tr>
<td colspan=4 class="h2" align=center> данни за фактурата
												<tr>
<td class="data"> ДДС №
<td class="data"> {$ARSERV.payeeevatnumber}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invovat}
		{else}
		{/if}
												<tr>
<td class="data"> град
<td class="data"> {$ARSERV.payeeecity}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invocity}
		{else}
		{/if}
												<tr>
<td class="data"> адрес
<td class="data"> {$ARSERV.payeeeaddress}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invoaddr}
		{else}
		{/if}
												<tr>
<td class="data"> МОЛ
<td class="data"> {$ARSERV.payeeemol}
		{if $ISLO}
<td width=10> &nbsp;
<td class="dloc"> {$INVO.invomol}
		{else}
		{/if}
						{else}
						{/if}
												</table>

{*---- данни за входящ/изходящ документ ----*}
<br>
							<table>
			<tr>
<td class="h3" align=center colspan=2> данни за нов входящ документ
			<tr>
<td> подател
<td>
<input type="text" name="from" id="from" size=50 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>
			<tr>
<td> описание
<td>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
			<tr>
<td class="h3" align=center colspan=2> данни за нов изходящ документ
			<tr>
<td> <nobr>адресат</nobr>
<td>
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>описание</nobr>
<td>
<input type="text" name="descrip" id="descrip" size=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
							</table>
{include file='_button.tpl' TYPE='submit' TITLE='създай' NAME='createdoc' ID='createdoc'}
&nbsp;
<span class="contcase">входящ и изходящ документ за справката</span>

{*
												<table>
												<tr>
<td>
		<fieldset class="filtgr">
		<legend align=right> за нов входящ документ </legend>
			<table>
			<tr>
<td> подател
<td>
<input type="text" name="from" id="from" size=40 {include file="_erelem.tpl" ID="from" C1="input" C2="inputer"}>
			<tr>
<td> описание
<td>
<input type="text" name="text" id="text" size=50 {include file="_erelem.tpl" ID="text" C1="input" C2="inputer"}>
			</table>
		</fieldset>
												<tr>
<td>
		<fieldset class="filtgr">
		<legend align=right> за нов изходящ документ </legend>
			<table>
			<tr>
<td> <nobr>адресат</nobr>
<td>
<input type="text" name="adresat" id="adresat" size=50 {include file="_erelem.tpl" ID="adresat" C1="input" C2="inputer"}>
			<tr>
<td> <nobr>описание</nobr>
<td>
<input type="text" name="descrip" id="descrip" size=50 {include file="_erelem.tpl" ID="descrip" C1="input" C2="inputer"}>
			</table>
		</fieldset>
												</table>
*}
											{else}
											{/if}


{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
