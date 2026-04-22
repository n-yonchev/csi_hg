{* параметри :
	$TABSLIST
	$EDIT
*}
						{if $smarty.session.VIEWFLAG_NOTABS}
						{else}

<div style="clear:left; width:98%;">
<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0'>
<tr>
										{if $ONLYTABS}
											{assign var=CURREDIT value=$EDIT}
											{assign var=EDIT value=$MONT}
<td> &nbsp;&nbsp;
										{else}
<td valign="top" width=70>
<div class="atabs_cont">
	{if isset($EDIT)}
<div {include file="_href.tpl" LINK=$PAGEBACKLINK} class='atabs_left'>&nbsp;</div>
<div {include file="_href.tpl" LINK=$PAGEBACKLINK} class='atabs_middle'
	oncontextmenu="goout('?outall'); return false;"
	rel="tabs.ajax.php" title="<span class='contcase'>десен клик - <b>затвори ВСИЧКИ дела</b></span>"
> Всички </div>
<div {include file="_href.tpl" LINK=$PAGEBACKLINK} class='atabs_right'>&nbsp;</div>
	{else}
<div class='atabs_left_selected'>&nbsp;</div>
<div class='atabs_middle_selected' id="allsele"
	oncontextmenu="goout('?outall'); return false;"
	rel="tabs.ajax.php" title="<span class='contcase'>десен клик - <b>затвори ВСИЧКИ дела</b></span>"
> Всички </div>
<div class='atabs_right_selected'>&nbsp;</div>
	{/if}
</div>
</td>
										{/if}

<td>
												{counter start=1 assign=mycoun}
	{foreach from=$TABSLIST item=taitem key=taid}
								{if $taitem.mark}
									{assign var="foco" value="red"}
								{else}
									{assign var="foco" value=""}
								{/if}
<div class="atabs_cont">
			{if $taid==$EDIT}
	 			<div class='atabs_left_selected'>&nbsp;</div>
				<div class='atabs_middle_selected'>
{$taitem.text}
										{if $ONLYTABS}
										{else}
{*
<img style="cursor:pointer" src="images/tabs_close_selected_normal.gif" onclick="document.location.href='{$LINK}';">
*}
<img style="cursor:pointer" src="images/tabs_close_selected_normal.gif" onclick="gooutlist('{$taitem.goout}');">
										{/if}
				</div>
				<div class='atabs_right_selected'>&nbsp;</div>
			{else}
				<div {include file="_href.tpl" LINK=$taitem.link} class='atabs_left'>&nbsp;</div>	
										{if $ONLYTABS}
				<div {include file="_href.tpl" LINK=$taitem.link} class='atabs_middle'>
				{$taitem.text}
				</div>
										{else}
				<div {include file="_href.tpl" LINK=$taitem.link} class='atabs_middle'
oncontextmenu="goout('{$taitem.goout}'); return false;"
{*----
oncontextmenu="document.location.href='{$taitem.goout}'; return false;"
----*}
rel="tabs.ajax.php{$taitem.link}" title="<span class='contcase'>изп.дело <b>{$taitem.text}</b><br/>десен клик - <b>затвори делото</b></span>">
<font color="{$foco}"> {$taitem.text} </font>
				</div>
										{/if}
				<div {include file="_href.tpl" LINK=$taitem.link} class='atabs_right'>&nbsp;</div>
			{/if}
</div>
												{counter assign=mycoun}
												{if $mycoun<=count($TABSLIST)}
<div class="atabs_sepa">&nbsp;</div>
												{else}
												{/if}
	{/foreach}
{*---- линк за смяна общия план на зоните ----*}
				{if isset($EDIT)}
<div style="float:left;cursor:pointer;padding-left:10px;" 
{*----
onclick="$('#mapa').load('casemainplan.ajax.php?para={$EDIT}');" title="смени общия план">
----*}
onclick="chplan();" title="смени общия план">
<img src="images/hist.gif">
</div>
<span id="mapa"></span>
				{else}
				{/if}

</td>
	</tr>
</table>
</div>
										{if $ONLYTABS}
											{assign var=EDIT value=$CURREDIT}
										{else}
										{/if}

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
$('.atabs_middle').cluetip({ldelim}
	cluetipClass: 'jtip', 
	positionBy: 'bottomTop',
//	positionBy: 'fixed',
	topOffset: 30,
//	leftOffset: 10,
//	showTitle: false,
//	arrows: true, 
	width: 240
	{rdelim});
$('#allsele').cluetip({ldelim}
	cluetipClass: 'jtip', 
	positionBy: 'bottomTop',
	topOffset: 30,
	width: 240
	{rdelim});
{rdelim});

function chplan(){ldelim}
	jQuery.ajax({ldelim}
		url: "casemainplan.ajax.php?para={$EDIT}&plan={$MAINPLAN}",
		success: function(data){ldelim}
//alert(data);
document.location.href= "{$RELURL}";
		{rdelim}
	{rdelim});
{rdelim}

{*---- затваряне на нетекущ таб с десен бутон - връщане към същия URL ----*}
function goout(p1){ldelim}
//alert('goout');
	jQuery.ajax({ldelim}
		url: "casegoout.ajax.php"+p1,
		success: function(data){ldelim}
//alert(data);
	if (data=="0"){ldelim}
document.location.href= "{$PAGEBACKLINK}";
	{rdelim}else{ldelim}
document.location.reload();
	{rdelim}
		{rdelim}
	{rdelim});
{rdelim}
{*---- затваряне на текущия таб с кръста - връщане към списъка Всички ----*}
function gooutlist(p1){ldelim}
//alert('goout');
	jQuery.ajax({ldelim}
		url: "casegoout.ajax.php"+p1,
		success: function(data){ldelim}
//alert(data);
document.location.href= "{$PAGEBACKLINK}";
		{rdelim}
	{rdelim});
{rdelim}
</script>

						{/if}
