<style>
.d_table .head {ldelim}font:normal 8pt verdana; background-color:silver; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;{rdelim}
.d_table .cell {ldelim}font:normal 8pt verdana; background-color:#dedede;{rdelim}
</style>
		<table class="d_table" cellspacing='1' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>собственици и техните банкови сметки
						{if empty($FILT)}
						{else}
							с "{$FILT}" в името
						{/if}
</td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200' height=30>
{*---- autocomplete само бройката ----*}
			<form name="myagform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
търси 
<input type="text" class="inp7bold" name="filtag" id="filtag" size=16 onkeyup="autoagsubm(event,'filtag');" value="{$FILT}">
+enter
			</form>
</td>
		</tr>
		</thead>
{*---- съдържание ----------------------*}

		<tr>
<td class='head'> име </td>
<td class='head'> тип </td>
<td class='head'> булстат </td>
<td class='head'> ЕГН </td>
<td class='head'> 
<td class='head'> iban </td>
<td class='head'> bic </td>
<td class='head'> описание </td>
<td class='head'> 
{*
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td> дела </td>
		<td class='sep'>&nbsp;</td>
<td> прирав </td>
*}
</tr>

{foreach from=$LIST item=elem key=ekey}
		<tr>
<td class="cell" rowspan={$elem.counac}> {$elem.name}</td>
<td class="cell" rowspan={$elem.counac}> {$ARTYPE[$elem.idtype]}</td>
<td class="cell" rowspan={$elem.counac}> {$elem.bulstat}</td>
<td class="cell" rowspan={$elem.counac}> {$elem.egn}</td>
<td rowspan={$elem.counac}>
<a href="{$elem.adda}" class="nyroModal" target="_blank"><img src="images/adda.gif" title="добави сметка за {$elem.name|escape:'html'}"></a>

			{foreach from=$elem.listac item=elac key=akey}
<td class="cell"> {$elac.iban}</td>
<td class="cell"> {$elac.bic}</td>
<td class="cell"> {$elac.descrip}</td>
<td align=center>
<a href="{$elac.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="{$elac.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</td>
		<tr>
			{/foreach}
{*
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
*}
	</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>

<script type="text/javascript">
	$('#filtag').autocomplete("finaacautocoun.ajax.php",{ldelim}matchContains:false, cacheLength:4, selectFirst:false{rdelim});
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


