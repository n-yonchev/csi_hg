{include file="_base.header.tpl"}

<table align=center width=100%  cellspacing=0 cellpadding=0 border=0 >
<tr class="mainhead" >
	<td align=center style='padding-left:10px;' style='height:33px' >
		{$HEADTEXT}
{*
&nbsp;&nbsp;
&nbsp;&nbsp;
посл.входящ <b>{$LASTDOCU.serial}/{$LASTDOCU.year}</b>
&nbsp;
посл.дело <b>{$LASTCASE.serial}/{$LASTCASE.year}</b>
			{if $EVENCOUN<=0}
			{else}
&nbsp;
<a href='{$EVENLINK}' target='_blank' class='nyroModal' 
style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: gold; color:black; border-bottom: 0px solid black;">
{$EVENCOUN} </a> &nbsp; {if $EVENCOUN==1}предстоящо събитие{else}предстоящи събития{/if}
			{/if}
*}
	</td>
		{if isset($USNAME)}
	<td align=right  style='padding-right:10px;' width=300px height=33px >
	потребител {$USNAME} [ <a href='{$MAINMENU.exit.link}'>{$MAINMENU.exit.text}</a> ]
	</td>
		{else}
		{/if}
</tr>
</table>
{*--------------------------------------*}
{foreach from=$MAINGROUP item=mitem key=mkey}
		{if is_array($mitem)}
			<div class='tabs_submenu' onmouseover='show_submenu("sub_{$mkey}")' onmouseout='hide_submenu("sub_{$mkey}")' style='display:none;' id='sub_{$mkey}' >
			{foreach from=$mitem item=subitem key=subkey}
				{if is_int($subkey)}
								{*---- 07.04.2010 - за да не излизат празни елементи на подменюто ----*}
								{if empty($MAINMENU.$subitem.text)}
								{else}
					<a href="{$MAINMENU.$subitem.link}">{$MAINMENU.$subitem.text}</a>
								{/if}
				{/if}
			{/foreach}
			</div>
		{else}
		{/if}
{/foreach}

{*
<div style="font: normal 10pt arial; background-color: #dfe8f6; padding: 6px; margin: 0px 0px 4px 0px; height:16px;">
*}
							<table align=center width=40%>
							<tr><td align=center>
<div style="font: normal 10pt arial; padding: 6px; margin: 0px 0px 4px 0px; height:16px; width:30%;">
									{counter start=1 assign=mycoun}
	{foreach from=$MAINGROUP item=mitem key=mkey}
		{if is_array($mitem)}
			<div id='tab_{$mkey}_l' class='atabs_left'>&nbsp;</div>
			<div id='tab_{$mkey}_m' class='atabs_middle' 
onmouseover="show_submenu('sub_{$mkey}',this);" 
onmouseout="hide_submenu('sub_{$mkey}');"
			>{$mitem.title}</div>
			<div id='tab_{$mkey}_r' class='atabs_right'>&nbsp;</div>
			{foreach from=$mitem item=subitem key=subkey}
				{if $subkey==="title"}
				{else}
					{if $subitem==$MODE}
						<script>					
							document.getElementById('tab_{$mkey}_l').className = 'atabs_left_selected';
							document.getElementById('tab_{$mkey}_m').className = 'atabs_middle_selected';
							document.getElementById('tab_{$mkey}_r').className = 'atabs_right_selected';
						</script>
					{/if}
				{/if}
			{/foreach}
		{else}
			{if $mitem==$MODE}
				<div class='atabs_left_selected'>&nbsp;</div>
				<div class='atabs_middle_selected' 
onmouseover="this.className='atabs_middle_selected_red';" onmouseout="this.className='atabs_middle_selected';"
onclick='document.location.href="{$MAINMENU.$mitem.link}"'
				>{$MAINMENU.$mitem.text}</div>
				<div class='atabs_right_selected'>&nbsp;</div>
			{else}
				<div class='atabs_left' onclick='document.location.href="{$MAINMENU.$mitem.link}"'>&nbsp;</div>
				<div class='atabs_middle' onclick='document.location.href="{$MAINMENU.$mitem.link}"'>{$MAINMENU.$mitem.text}</div>
				<div class='atabs_right' onclick='document.location.href="{$MAINMENU.$mitem.link}"'>&nbsp;</div>
			{/if}
		{/if}
									{counter assign=mycoun}
									{if $mycoun<=count($MAINGROUP)}
<div class="atabs_sepa">&nbsp;</div>
									{else}
									{/if}
	{/foreach}
{*----
			{assign var=myaction value=$MAINMENU.fino.link}
			<form name="mymainform" method=post enctype="multipart/form-data" action="{$myaction}"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
номер дело от-до +enter
<input type="text" class="inp7bold" name="textnome" id="textnome" size=16 onkeyup="automainsubm(event,'textnome');" value="">
			</form>
----*}
{**}
</div>
							</table>
{**}

{*---------- 17.06.2009 - за финансиста - заради насочване на постъпление към дело --------*}
{include file="_dire.tpl"}
					
					{$CONTENT}

{*---- за автоматично отпечатване ----*}
{*
<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprin(p1){ldelim}
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
{rdelim}
</script>
*}
<script>
function automainsubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
//obfi.value= foid+obfi.value;
document.forms['mymainform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>

{include file="_base.footer.tpl"}
