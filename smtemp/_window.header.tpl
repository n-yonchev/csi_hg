{if isset($WIDTH)}
	{assign var='tmp' value="style='width:$WIDTH"}
{/if}
<table class='window_table' {if isset($WIDTH)}{$tmp|cat:"px';"}{/if} style='' id='nyroWindow' cellspacing='0' cellpadding='0'>
<tr>
	<td class='window_top_left'></td>
	<td class='window_top_middle'></td>
	<td class='window_top_right'></td>
</tr>
<tr>
	<td class='window_title_left'></td>
	<td class='window_title'><span>{$TITLE} &nbsp;</span>
	<div class='wclose_normal' onMouseOver="eff_window_close_button(this);" onMouseOut="eff_window_close_button(this);" 
{*----
onclick="parent.$.nyroModalRemove();" ></div>
----*}
onclick="nyremo();" >
	</div>
{*-----------------------------------------
<div style="float:right;">
TIMETO
</div>
-----------------------------------------*}
	</td>
	<td class='window_title_right'></td>
</tr>
<tr>
	<td class='window_middle_left'></td>
	<td class='window_middle_middle'>
	{if isset($TABS)}
		<div class='tabs_line'>
			<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
				<tr>
					{foreach from=$TABS item=elem key=ekey}
						<td class='tabs_sep'>&nbsp;</td> 
						{if $elem.selected}
							<td class='tabs_left_selected'></td>
							<td class='tabs_middle_selected'><span>{$elem.name}</span></td>
							<td class='tabs_right_selected'></td>
						{else}
							<td onclick='document.location.href="{$elem.url}"' class='tabs_left'></td>
							<td onclick='document.location.href="{$elem.url}"' class='tabs_middle'><span>{$elem.name}</span></td>
							<td onclick='document.location.href="{$elem.url}"' class='tabs_right'></td>
						{/if}
					{/foreach}
				</tr>
			</table>
		</div>
	{/if}
	<div style='border: 1px solid #a3bae9;margin: 2px;'>
	<div class='window_border' id='divscroll'>
	<div id='divnotscroll'>
<script>
var inte= 0;
function nyremo(){ldelim}
	{if isset($NYREMO)}
$("#"+"{$NYREMO.idzone}").load(encodeURI('finaunlock.ajax.php?idfina='+'{$NYREMO.idfina}'));
inte= setInterval("interemo()",200);
	{else}
parent.$.nyroModalRemove();
	{/if}
{rdelim}
	{if isset($NYREMO)}
function interemo(){ldelim}
	if ($("#"+"{$NYREMO.idzone}").text()=="OK"){ldelim}
clearInterval(inte);
parent.$.nyroModalRemove();
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
	{else}
	{/if}
</script>
