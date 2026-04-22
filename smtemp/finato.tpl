		<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> списък на взискателите с разпределени суми
</td>
		</tr>
		</thead>
		<tr class='header'>
<td> взискател </td>
		<td class='sep'>&nbsp;</td>
<td> iban </td>
		<td class='sep'>&nbsp;</td>
<td> bic </td>
		<td class='sep'>&nbsp;</td>
<td> обща сума </td>
		</tr>
		<tbody>
{foreach from=$LIST item=elem key=ekey}
		<tr bgcolor="lightblue" onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.name} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.iban} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.bic} </td>
		<td class='sep'>&nbsp;</td>
<td align=right><font size=+1><b> {$elem.sumamo|tomo3} </b></font>
				{*---- детайлните редове постъпления ----*}
		<tr>
		<td colspan=20>
				<table align=right>
				<tr>
			<td> длъжник 
			<td> егн 
			<td> булстат 
			<td> дело 
			<td> сума 
		{foreach from=$elem.ardeta item=eldeta key=detkey}
				<tr bgcolor="wheat">
			<td> {$eldeta.debtname}
			<td> {$eldeta.egn}
			<td> {$eldeta.bulstat}
			<td> {$eldeta.caseseri}/{$eldeta.caseyear}
			<td align=right> {$eldeta.amount|tomo3}
		{/foreach}
				</table>
{/foreach}
		</tbody>

{include file="_pagina.tr.tpl"}
		
		</table>
