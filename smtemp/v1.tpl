							{if isset($smarty.session.v1post)}
<script>
$(document).ready(function(){ldelim}
	fuprin('v1prin.php');
{rdelim});
</script>
							{else}
							{/if}
		
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>
{if $FLAGALL==0}списък на активните наблюдатели{else}списък на всички наблюдатели{/if}
{if empty($FILTNAME)}{else} съдържащи "{$FILTNAME}"{/if}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$LINKALTE}" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">
{if $FLAGALL==0}покажи и неактивните{else}покажи само активните{/if}</a>
		</tr>
		<tr>
<td class='d_table_button' colspan='200' align=right>
{*---- autocomplete само бройката ----*}
			<form name="mynameform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
търси 
{*
<input type="text" class="inp7bold" name="filtag" id="filtag" size=16 onkeyup="autoagsubm(event,'filtag');" value="{$FILT}">
*}
<input type="text" class="inp7bold" name="filtname" id="filtname" size=16 onkeyup="autonamesubm(event,'filtname');" value="{$FILTNAME}">
+enter
			</form>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE="добави"}
</td>
		</tr>
		</thead>
		<tr class='header'>
<td> име </td>
			<td class='sep'>&nbsp;</td>
<td align=center> активен </td>
			<td class='sep'>&nbsp;</td>
<td align=center>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
<td align=center>дела</td>
		</tr>
		<tbody>
		{foreach from=$USERLIST item=elem key=ekey}
{*
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
*}
		<tr>
<td> {$elem.name} </td>
			<td class='sep'>&nbsp;</td>
<td align=center> 
					{if $elem.inactive==0}
<a href="{$elem.inac}"><img src='css/checkbox_checked.gif' alt='' /></a>
					{else}
<a href="{$elem.acti}"><img src='css/checkbox.gif' alt='' /></a>
					{/if}
</td>
			<td class='sep'>&nbsp;</td>
<td class="none" align=center> 
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
</td>
			<td class='sep'>&nbsp;</td>
{*
<td align=right bgcolor="#ddffdd"> 
<a href="{$elem.viewer}" title="списъка">
					{if $ARCOUN[$elem.id]==0}
няма
					{else}
{$ARCOUN[$elem.id]} 
					{/if}
&nbsp;
</a>
*}
<td align=right bgcolor="#aaccff" onclick="document.location.href='{$elem.viewer}';" style="cursor:pointer" title="списъка с дела"> 
					{if $ARCOUN[$elem.id]==0}
няма
					{else}
{$ARCOUN[$elem.id]} 
					{/if}
&nbsp;
		</tr>

		{/foreach}
		</tbody>
{include file="_pagina.tr.tpl"}
		</table>

<script type="text/javascript">
	$('#filtname').autocomplete("v1autocoun.ajax.php",{ldelim}matchContains:false, cacheLength:4, selectFirst:false{rdelim});
function autonamesubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
document.forms['mynameform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
