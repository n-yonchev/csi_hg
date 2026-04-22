
	<table class="base" align=center>

{*---- заглавна част ----------------------*}
			<tr>
<td class="none" align=right colspan=10> 
{include file="_button.tpl" HREF=$PAGEBACKLINK TITLE="към стр. $PAGEBACK от извлеченията" }

			<tr>
<td class="none" align=left colspan=10> 
</table>

<table class='d_table' align=center cellpadding=0 cellspacing=0>
	<thead>
	<tr>
		<td class="d_table_title" colspan=10> <b> банково извлечение </b>
	<tr>
	</thead>
<td class="t8"> обработено &nbsp;&nbsp;
<td class="t8"> <b> {$HEADDATA.created|date_format:"%d.%m.%Y"} </b>
	<tr>
<td class="t8"> начална дата &nbsp;&nbsp;
<td class="t8"> <b> {$HEADDATA.date1} </b>
<td class="t8" width=20>
<td class="t8"> начално салдо &nbsp;&nbsp;
<td class="t8"> <b> {$HEADDATA.balance1} </b>
	<tr>
<td class="t8"> крайна дата &nbsp;&nbsp;
<td class="t8"> <b> {$HEADDATA.date2} </b>
<td class="t8" width=20>
<td class="t8"> крайно салдо &nbsp;&nbsp;
<td class="t8"> <b> {$HEADDATA.balance2} </b>
	</table>
<br />
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>постъпления</td>
		</tr>
	</thead>
		
{*---- съдържание ----------------------*}

		<tr class='header'>
			<td> дата </td>
			<td class='sep'>&nbsp;</td>
			<td> час </td>
			<td class='sep'>&nbsp;</td>
			<td> сума </td>
			<td class='sep'>&nbsp;</td>
			<td> описание </td>
			<td class='sep'>&nbsp;</td>
			<td> име </td>
			<td class='sep'>&nbsp;</td>
			<td> забележка </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td colspan=2> дело и взискател </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
		</tr>
	{foreach from=$DATA item=elem key=ekey}
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
			<td > {$elem.POST_DATE} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.TIME} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.AMOUNT_C} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.TR_NAME} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.NAME_R} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.REM_I}; {$elem.REM_II} </td>
			<td class='sep'>&nbsp;</td>
				{*---- фоновете - да съвпадат с тези в bapa.tpl --------------------*}
				{if $elem.idclaimer==-1}
					{assign var="mycolo" value="#ffeedd"}
					{assign var="mytext" value="марк"}
					{assign var="mytitl" value="маркиран"}
				{elseif $elem.idclaimer==0}
					{assign var="mycolo" value="#ffaaaa"}
					{assign var="mytext" value="не"}
					{assign var="mytitl" value="ненасочен"}
				{else}
					{assign var="mycolo" value="#ddffdd"}
					{assign var="mytext" value="ОК"}
					{assign var="mytitl" value="насочен"}
				{/if}
			<td title="{$mytitl}" bgcolor="{$mycolo}" style="cursor:help"> {$mytext} </td>
			

				{if $elem.idclaimer>0}
<td class='sep'>&nbsp;</td>
<td valign=top class="t8bord"> {$elem.caseseri}/{$elem.caseyear} {$elem.clainame}</td>
<td align=center valign=top class="t8bord"> <a href="{$elem.editpaym}" class="nyroModal" target="_blank"><img src="images/edit.png" title="данни за плащането"></a></td>
				{elseif $elem.idclaimer==-1}
<td class='sep'>&nbsp;</td>
<td class="t8bord" colspan=2> &nbsp;</td>
				{else}
<td class='sep'>&nbsp;</td>
<td align=center colspan=2> <a href="{$elem.direcase}" class="nyroModal" target="_blank"><img src="images/dire.gif" title="насочи към дело"></a></td>
				{/if}
				
				{if $elem.idclaimer==0}
<td class='sep'>&nbsp;</td>
<td  align=center valign=middle title="маркирай" bgcolor="#ffeedd" style="cursor:pointer" onclick="document.location.href='{$elem.mark}';"> &nbsp;М&nbsp; </td>
				{else}
<td class='sep'>&nbsp;</td>
<td > &nbsp;</td>
				{/if}
				
				{if $elem.idclaimer==0}
<td class='sep'>&nbsp;</td>
<td class="t8bord"> &nbsp;</td>
				{else}
<td class='sep'>&nbsp;</td>
<td align=center valign=middle title="освободи" bgcolor="#ffaaaa" style="cursor:pointer" onclick="document.location.href='{$elem.free}';"> &nbsp;О&nbsp;</td>
				{/if}
			</tr>
	{/foreach}

{include file="_pagina.tr.tpl"}
			</table>
<br>
