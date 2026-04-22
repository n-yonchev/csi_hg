<table class="d_table" width='600px;' cellspacing='0' cellpadding='0' align=center>
<thead><tr>
<td class='d_table_title' colspan='200'>касови пакети</td></tr><tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE="добави"}
</td></tr>
</thead><tr class='header'>
<td><span> номер </span></td>
<td class='sep'>&nbsp;</td>
<td> сума </td>
<td class='sep'>&nbsp;</td>
<td > създаден</td>
<td class='sep'>&nbsp;</td>
<td >&nbsp; </td>
<td class='sep'>&nbsp;</td>
<td > приключен</td>
<td class='sep'>&nbsp;</td>
<td >&nbsp; </td>
<td class='sep'>&nbsp;</td>
<td >&nbsp; </td>
</tr>
<tbody>
{foreach from=$LIST item=elem key=ekey}<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.serial} </td>
<td class='sep'>&nbsp;</td>
<td> {$elem.amount|tomoney} </td>
<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"} </td>
<td class='sep'>&nbsp;</td>
{if $elem.idstatus==0}
<td class="none">&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td class="none">&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td class="none" align=center>
<a href="{$elem.fini}" class="nyroModal" target="_blank"><img src="images/finish.gif" title="приключи"></a></td>
<td class='sep'>&nbsp;</td>
<td class="none" align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
{else}
<td style="cursor:pointer"> <a href="{$elem.view}" class="nyroModal" target="_blank"><img src="images/view.png" title="виж съдържанието"></a></td>
<td class='sep'>&nbsp;</td>
<td> {$elem.finished|date_format:"%d.%m.%Y"}</td>
<td class='sep'>&nbsp;</td>
<td>&nbsp;&nbsp;</td>
<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
{/if}
</tr>
{/foreach}
{include file="_pagina.tr.tpl"}
</table>
<br>


