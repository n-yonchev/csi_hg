						<table>
				{if $V1}
						<tr>
<td class="tdtext"> иска справката
<td>
{$ROC2.name}
<br>
{if $ROC2.idtype==1}физическо лице{elseif $ROC2.idtype==2}юридическо лице{else}??????{/if}
<br>
ЕГН/ЕИК {$ROC2.egneik}
								{if isset($DOCU)}
<br>
вх.номер {$DOCU}
								{else}
								{/if}
				{else}
				{/if}
				{if $V2}
						<tr>
<td class="tdtext"> справката е за
<td>
{$ROC2.name2}
<br>
{if $ROC2.idtype2==1}физическо лице{elseif $ROC2.idtype2==2}юридическо лице{elseif $ROC2.idtype2==3}чуждестранно лице{else}??????{/if}
<br>
ЕГН/ЕИК {$ROC2.param}
								{if isset($DOUT)}
<br>
изх.номер {$DOUT}
								{else}
								{/if}
				{else}
				{/if}
				{if $INVO}
						<tr>
<td class="tdtext"> данни за фактурата
<td>
ДДС № <b>{$INVO.invovat}</b>
<br>
град <b>{$INVO.invocity}</b>
<br>
адрес <b>{$INVO.invoaddr}</b>
<br>
МОЛ <b>{$INVO.invomol}</b>
				{else}
				{/if}
						</table>

