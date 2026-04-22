<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
{*
<input type="hidden" name="submtype" id="submtype" value="" meta:dynamic="submit submitsuit">
*}
<style>
td {ldelim}font: normal 8pt verdana{rdelim}
.mess {ldelim}font: normal 8pt verdana; letter-spacing: 2;{rdelim}
</style>

{*---- зона 1 филтър ----*}
						<table align=center>
				{if isset($PAGEBACKLINK)}
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> {$PAGEBACKTEXT} </a>
				{else}
				{/if}
				{if isset($PAGEBACKLINK2)}
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK2}> {$PAGEBACKTEXT2} </a>
				{else}
				{/if}
<tr><td align=left>
<br>
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='10'> добави дело/дела към списъка на наблюдател {$ROVIEW.name}
{*
<span align=right>
{include file='_button.tpl' HREF="$ADDCAS" TITLE='добави'}
</span>
*}
			</thead>

			<tr>
<td colspan='10'> 
{*
{include file="_erform.tpl"}
*}
								<table>
								<tr>
					<td colspan=3>
добави директно дело/год &nbsp;
<input type="text" name="casenumb" id="casenumb" size=12 {include file="_erelem.tpl" ID="casenumb" C1="input" C2="inputer"}
style="font:bold 7pt verdana;" onkeyup="autosu(event);">
+enter
{*
<td>
{include file='_but2.tpl' TYPE='submit' TITLE='добави' NAME='submitsuit' ID='submitsuit'}
*}
								<tr>
					<td colspan=2>
<br>
или търси за добавяне група дела по филтър
								<tr>
					<td>
име или част от него за взискател
					<td>
<input type="text" name="claitext" id="claitext" size=20 {include file="_erelem.tpl" ID="claitext" C1="input" C2="inputer"}
style="font:bold 7pt verdana;">
								<tr>
					<td>
име или част от него за представител
					<td>
<input type="text" name="agentext" id="agentext" size=20 {include file="_erelem.tpl" ID="agentext" C1="input" C2="inputer"}
style="font:bold 7pt verdana;">
					<td>
{include file='_but2.tpl' TYPE='submit' TITLE='търси' NAME='submit' ID='submit'}
								</table>


{*
			<tr class='header'>
<td> номер </td>
			<td class='sep'>&nbsp;</td>
<td> описание </td>
			<td class='sep'>&nbsp;</td>
<td> идва от </td>
			<td class='sep'>&nbsp;</td>
<td> създадено </td>
			<td class='sep'>&nbsp;</td>
<td> посл.промяна </td>

{foreach from=$CASELIST item=elem key=ekey}
			<tr onclick="document.location.href='{$elem.edit}';"
onmouseover='this.style.backgroundColor="#dddddd";this.style.cursor="pointer";' 
onmouseout='this.style.backgroundColor="";this.style.cursor="default";'
>
<td> {$elem.serial}/{$elem.year}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.text}
				{assign var="arindx" value=$elem.idcofrom} </td>
			<td class='sep'>&nbsp;</td>
<td> {$ARFROM[$elem.idcofrom]}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"}</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.lastdocu|date_format:"%d.%m.%Y %H:%M"}</td>
				{assign var="myid" value=$elem.id}
{/foreach}
*}
			</table>
						</table>

{*---- зона 2 съобщение или списък ----*}
<br>
								{if !empty($ERMESS)}
<center class="mess">
<font color=red>{$ERMESS}</font>
</center>
								{elseif !empty($INFOMESS)}
<center class="mess">
{$INFOMESS}
</center>
								{elseif !empty($FILTTEXT)}
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='10'> намерени дела с {$FILTTEXT}
			</thead>
			</table>
								{else}
								{/if}

</form>

{*
<script>
function autosubm(event,idbutt){ldelim}
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
//alert(idbutt);
		$("#submtype").attr("value",idbutt);
$("#casenumb").attr("value","269");
//alert(idbutt+'/'+$("#submtype").attr("value"));
		document.forms["myseleform"].submit();
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
*}
<script>
function autosubm(event){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
			document.forms["myseleform"].submit();
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>

					{*---- forcing nyroModal ----*}
					{if isset($NYROLINK)}
<a id="link" href="v1addclist.ajax.php{$NYROLINK}" class="nyroModal" target="_blank" style="display:none">link</a>
<script type="text/javascript">
	$(function() {ldelim}
		$('#link').click();
		return false;
	{rdelim});
</script>
					{else}
					{/if}
					{*---- скрит линк за чист рефреш без forcing nyroModal ----*}
<a id="linkrelo" href="{$LINKRELO}" style="display:none;"></a>
{*
<a id="linkrelo" href="{$LINKRELO}">LINKRELO</a>
*}
