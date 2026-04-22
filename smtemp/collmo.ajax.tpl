{*
	източници : finaca.tpl _fina.tpl 
*}
								<table align=center>
								<tr>
<td align=right bgcolor="#eeeeee"> постъп<br>ление
<td align=left bgcolor="#eeeeee"> тип
<td align=left bgcolor="#eeeeee"> постъпило
<td align=left bgcolor="#eeeeee"> посл.корек
<td align=left bgcolor="#eeeeee"> за взискателите
<td align=left bgcolor="#eeeeee" colspan=2> за ЧСИ
<td align=left bgcolor="#eeeeee"> нераз<br>пред
<td align=left bgcolor="#eeeeee"> приключ
<td align=left bgcolor="#eeeeee"> на дата
<td align=left bgcolor="#eeeeee"> дата погас
			{foreach from=$DATA item=elem}
								<tr>
<td align=right> {$elem.inco|tomoney2}
<td align=left> {$ARTYPE[$elem.idtype]}
<td align=left> 
						{if $elem.idtype==1}
{*
{$elem.bankdate} {$elem.bankhour}
*}
{$elem.bankdate}
						{elseif $elem.idtype==2}
{$elem.cashdate}
						{else}
&nbsp;
						{/if}
<td align=left> {$elem.finatime|date_format:"%d.%m.%Y"}
<td align=left> 
		{foreach from=$elem.unseclai item=claiamou}
{$claiamou|tomoney2}&nbsp;&nbsp;
		{/foreach}
<td align=right><font color="{if $elem.mark}red{else}{/if}"> {$elem.separa|tomoney2} </font>
<td align=right><font color="{if $elem.mark}red{else}{/if}"> {$elem.separa2|tomoney2} </font>
<td align=right> {$elem.rest|tomoney2} 
<td align=center> {if $elem.isclosed==1}да{else}-{/if}
<td align=left> {$elem.finaclos|date_format:"%d.%m.%Y"}
<td align=left> {$elem.datebala|date_format:"%d.%m.%Y"}
			{/foreach}
								</table>
