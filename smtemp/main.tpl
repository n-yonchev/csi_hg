{include file="_base.header.tpl"}

<table align=center width=100%  cellspacing=0 cellpadding=0 border=0 >
<tr class="mainhead" >
	<td align=left style='padding-left:10px;' style='height:33px' >
		{$HEADTEXT}
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
			{*---- ЦРД-2014 -----------------------------------------------------*}
			{if $REG4USERCOUN1>0 or $REG4COUNALL>0}
&nbsp;&nbsp;
<img src="images/admin.gif"> 
			{else}
			{/if}
			{if $REG4USERCOUN1<=0}
			{else}
&nbsp;
<a href='{$REG4USERLINK1}' style="border-bottom: 0px solid black;" title="{$REG4USERCOUN1} дела на {$USNAME} с грешки от ЦРД-2014">
<sup>
<span style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: red; color:white;">
{$REG4USERCOUN1} 
</sup></span></a> 
			{/if}
			{if $REG4COUNALL<=0}
			{else}
&nbsp;
<a href='{$REG4LINKALL}' style="border-bottom: 0px solid black;" title="{$REG4COUNALL} всички дела с грешки от ЦРД-2014">
<sup>
<span style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: red; color:white;">
{$REG4COUNALL} 
</sup></span></a> 
			{/if}
						{*---- 16.12.2014 - евент.грешки при обръщение към ЦРД-2014 ----*}
						{if isset($ARREG4)}
&nbsp;
<img src="images/dire.gif" id="reg4er" rel="#reg4ermess" title="последни грешки при предаване към ЦРД-2014">
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<span id="reg4ermess" style="display: none">
		<table>
{foreach from=$ARREG4 item=r4el}
		<tr>
<td> [{$r4el.id}]
<td> {$r4el.time}
<td> {$r4el.idcase}
<td> {$r4el.texter|truncate:60:"...":true}
{/foreach}
		</table>
</span>
<script type="text/javascript">
	$('#reg4er').cluetip({ldelim} width: 600, local:true, cursor:'help' {rdelim});
</script>
						{else}
						{/if}

&nbsp;&nbsp;&nbsp;<i class="fas fa-file-import"></i> <a href="{$DOCUDEADLINES_LINK}" title="входящи документа очакващи отговор">{$DOCUDEADLINES_COUNT}</a>
			{*---- --------------------------------------------------------------*}
	</td>
		{if isset($USNAME)}
<td align=right  style='padding-right:10px;' width=300px height=33px >
{*
	потребител {$USNAME} [ <a href='{$MAINMENU.exit.link}'>{$MAINMENU.exit.text}</a> ]
*}
				{if $ISMAINPLAN}
<a href='userprof.ajax.php' target='_blank' class='nyroModal'>
потребител {$USNAME} 
</a>
				{else}
потребител {$USNAME} 
				{/if}
[ <a href='{$MAINMENU.exit.link}'>{$MAINMENU.exit.text}</a> ]
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

{*---
	<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
----*}
<div style="font: normal 10pt arial; background-color: #dfe8f6; padding: 6px; margin: 0px 0px 4px 0px; height:16px;">
									{counter start=1 assign=mycoun}
	{foreach from=$MAINGROUP item=mitem key=mkey}
{*---
		<td class='tabs_sep'>&nbsp;</td> 
----*}
		{if is_array($mitem)}
			<div id='tab_{$mkey}_l' class='atabs_left'>&nbsp;</div>
			<div id='tab_{$mkey}_m' class='atabs_middle' 
{*----
onmouseover="this.className='atabs_middle_selected_red';show_submenu('sub_{$mkey}',this);" 
onmouseout="this.className='atabs_middle_selected';hide_submenu('sub_{$mkey}');"
----*}
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
{*----
				<td class='tabs_sep'>&nbsp;</td> 
----*}
				<div class='atabs_left_selected'>&nbsp;</div>
				<div class='atabs_middle_selected' 
onmouseover="this.className='atabs_middle_selected_red';" onmouseout="this.className='atabs_middle_selected';"
onclick='document.location.href="{$MAINMENU.$mitem.link}"'
				>{$MAINMENU.$mitem.text}</div>
				<div class='atabs_right_selected'>&nbsp;</div>
			{else}
{*---
				<td class='tabs_sep'>&nbsp;</td> 
----*}
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
{*---- 08.09.2009 Софрониев източник : newcseri.tpl с промени ----*}
{*----
<td>
		{if $LOGGEDISADMIN}
			{assign var=myaction value=$MAINMENU.allc.link}
		{else}
			{assign var=myaction value=$MAINMENU.cas1.link}
		{/if}
			<form name="mymainform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data" action="{$myaction}">
<span style="font: normal 7pt verdana">
&nbsp;&nbsp;&nbsp;&nbsp;
номер дело от-до +enter
<input type="text" class="inp7bold" name="textnome" id="textnome" size=16 onkeyup="automainsubm(event,'textnome');" value="">
</span>
			</form>
----*}
			{assign var=myaction value=$MAINMENU.fino.link}
			<form name="mymainform" method=post enctype="multipart/form-data" action="{$myaction}"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
номер дело от-до +enter
<input type="text" class="inp7bold" name="textnome" id="textnome" size=16 onkeyup="automainsubm(event,'textnome');" value="">
			</form>
</div>
{*----
</td>
	</tr>
	</table>
</div>
----*}

{*---------- 17.06.2009 - за финансиста - заради насочване на постъпление към дело --------*}
{include file="_dire.tpl"}
					
					{$CONTENT}

{*---- за автоматично отпечатване ----*}
<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
{*
<iframe id="idprin" width=500 height=340 frameborder=0 style="display:block"></iframe>
*}
<script>
function fuprin(p1){ldelim}
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
{rdelim}
</script>

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
