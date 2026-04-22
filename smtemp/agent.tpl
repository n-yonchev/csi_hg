<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на представителите
						{if empty($FILT)}
						{else}
							с "{$FILT}" в името
						{/if}
		</td>
	</tr>
	<tr>
		<td class='d_table_button' colspan='200'>
{*---- autocomplete само бройката ----*}
			<form name="myagform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
търси 
<input type="text" class="inp7bold" name="filtag" id="filtag" size=16 onkeyup="autoagsubm(event,'filtag');" value="{$FILT}">
+enter
			</form>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
		</td>
	</tr>
</thead>
{*---- съдържание ----------------------*}

		<tr class='header'>
<td> име </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td> дела </td>
		<td class='sep'>&nbsp;</td>
<td> прирав </td>
</tr>

{foreach from=$LIST item=elem key=ekey}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
					{if $ARCOUN[$elem.id]==0}
<td align=center>
<a href="{$elem.dele}" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий представителя">
</a>
					{else}
<td align=center>
<a href="{$elem.listcase}" class="nyroModal" target="_blank">
<span class="finahist" title="виж списъка">
{$ARCOUN[$elem.id]}
</span>
</a>
					{/if}
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.makeeq}" class="nyroModal" target="_blank">
<img src="images/makeeq.gif" title="приравни към друг">
</a>
	</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>

<script type="text/javascript">
	$('#filtag').autocomplete("agentautocoun.ajax.php",{ldelim}matchContains:false, cacheLength:4, selectFirst:false{rdelim});
function autoagsubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
document.forms['myagform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>


