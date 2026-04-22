<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	{foreach from=$YEARLIST item=elem key=ekey}
		<td class='tabs_sep'>&nbsp;</td> 
		{if $YEAR==$ekey}
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span>{$ekey}</span></td>
			<td class='tabs_right_selected'></td>
		{else}	
			<td onclick='document.location.href="{$elem}"' class='tabs_left'></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_middle'><span>{$ekey}</span></td>
			<td onclick='document.location.href="{$elem}"' class='tabs_right'></td>
		{/if}
	{/foreach}
	</tr>
	</table>
</div>


<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
{*----
		<td class='d_table_title' colspan='8'>списък на свободните дела</td>
		<td class='d_table_button_center' colspan='6'>
филтър
<input type="text" class="inp7bold" name="textfilt" id="textfilt" size=20>
+enter
			<td class='d_table_button_center' colspan='4'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			</td>
----*}
		<td class='d_table_title' colspan='18'>
<div style="float:left;">
списък на свободните дела
</div>
<div style="float:right;">
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
		</td>
{*--------*}
	</tr>
	<tr>
{*----
<td colspan=60> към дело номер 
		{foreach from=$NAVILIST item=elem key=ekey}
			{if $ekey==$CURRSERI}
				{if $PAGIPARA.PAGENO==1}
				{else}
<span style="cursor:pointer;color:blue" onclick="document.location.href='{$PAGIPARA.ONPREV}'; return false;"> <b>&lt;</b> </span>
				{/if}
&nbsp;
<b>{$ekey}</b>
				{if $PAGIPARA.PAGENO==$PAGIPARA.TOTPAG}
				{else}
<span style="cursor:pointer;color:blue" onclick="document.location.href='{$PAGIPARA.ONNEXT}'; return false;"> <b>&gt;</b> </span>
				{/if}
			{else}
<span style="cursor:pointer;color:blue" onclick="document.location.href='{$elem}'; return false;"> {$ekey} </span>
			{/if}
		{/foreach}
----*}
		<td class='d_table_button_center' colspan='18'>
въведи за търсене
&nbsp;&nbsp;&nbsp;&nbsp;
текст +enter
<input type="text" class="inp7bold" name="textfilt" id="textfilt" size=16 onkeyup="autosubm(event,'textfilt');">
&nbsp;&nbsp;&nbsp;&nbsp;
номер дело от-до +enter
<input type="text" class="inp7bold" name="freeserifilt" id="freeserifilt" size=16 onkeyup="autosubm(event,'freeserifilt');">
		</td>
{*--------*}
	</tr>

</thead>
	<tr class='header'>
<td colspan=9 align=center><span> <b>дело</b> </span></td>
		<td class='sep'>&nbsp;</td>	
<td colspan=9 align=center><span> <b>документи по делото</b> </span></td>
	<tr class='header'>
<td><span> &nbsp; </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> номер </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> образувано </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> вземи</span></td>
		<td class='sep'>&nbsp;</td>	
<td style="cursor:pointer">
<img src="images/change.gif" title="вземи всички маркирани дела" onclick="document.forms['myform'].submit();">
</td>
		<td class='sep'>&nbsp;</td>	
<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> описание</span></td>	
		<td class='sep'>&nbsp;</td>
<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> бележки</span></td>
	</tr>
<tbody>

{foreach from=$LIST item=elem key=ekey}
			{foreach from=$elem.listdocu item=elemdocu key=dkey}
				{if $dkey==0}
<tr><td colspan=40 class="hr"> <hr>
				{else}
				{/if}
<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
				{if $dkey==0}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right>
{$elem.serial}/{$elem.year} </td>
		<td class='sep'>&nbsp;</td>
<td>
{$elem.created|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if isset($elem.newcase)}
<a href="caseeditzone.php{$elem.newcase}" class="nyroModal" target="_blank">
<img src="images/change.gif" title="Вземи Делото"></a></td>
	{else}
<a href="#" onclick='document.location.href="{$elem.getcase}"'>
<img src="images/change.gif" title="вземи делото"></a></td>
	{/if}
		<td class='sep'>&nbsp;</td>
<td align=center>
<input type=checkbox name="{$PREFMULT}{$elem.id}">
		<td class='sep'>&nbsp;</td>
				{else}
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
				{/if}
<td> 
	{if empty($elemdocu.serial) and empty($elemdocu.year)}
<font color=red> няма </font>
	{else}
{$elemdocu.serial}/{$elemdocu.year}
	{/if}
</td>
		<td class='sep'>&nbsp;</td>
<td> {$elemdocu.text} </td>
		<td class='sep'>&nbsp;</td>
<td> {$elemdocu.from}</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if empty($elemdocu.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elemdocu.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
</td>
			{/foreach}
	</tr>
{/foreach}
</form>

</tbody>
	{include file="_pagina.tr.tpl"}
</table>

<script>
function autosubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
obfi.value= foid+obfi.value;
document.forms['myform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
