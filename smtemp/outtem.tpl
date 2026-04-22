<style>
.doso {ldelim}background-color:khaki;cursor:pointer;{rdelim}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на шаблоните за изходящи документи</td>
		</tr>
		<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</td>
		</tr>
	</thead>
	<tr class='header'>
<td> описание </td>
		<td class='sep'>&nbsp;</td>
<td> адресат </td>
							{if $ISREGITAX}
		<td class='sep'>&nbsp;</td>
<td> такса </td>
		<td class='sep'>&nbsp;</td>
<td> предмет </td>
							{else}
							{/if}
		<td class='sep'>&nbsp;</td>
<td> създаден </td>
		<td class='sep'>&nbsp;</td>
<td> файл </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td align=center> акт </td>
		<td class='sep'>&nbsp;</td>
{*
<td align=center> брой<br>изх.док </td>
*}
							{if $ONLYCOUN==0}
								{assign var=mylink value=$LINKONLY1}
							{else}
								{assign var=mylink value=$LINKONLY0}
							{/if}
<td align=center> <span style="cursor:pointer;" {include file="_href.tpl" LINK=$mylink}>&diams;</span>
брой<br>изх.док 
{***
		<td class='sep'>&nbsp;</td>
<td align=center> та<br>гове </td>
***}
								{*---- връчване ----*}
								{if $ISPOST}
		<td class='sep'>&nbsp;</td>
<td align=center> връчване </td>
								{else}
								{/if}
		<td class='sep'>&nbsp;</td>
<td align=center> под<br>режд </td>
	</tr>
	<tbody>
{foreach from=$LIST item=elem key=ekey}
								{*---- само с ненулев брой изх.документи ---- *}
								{if $ONLYCOUN<>0 and $ARCOUN[$elem.id]==0}
								{else}
				{if $elem.ishidden==0}
					{assign var=mycl value=""}
				{else}
					{assign var=mycl value="trdocu"}
				{/if}
	<tr class="{$mycl}" onmouseover='this.className="tr_hover";' onmouseout='this.className="{$mycl}";'>
<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.adresat}&nbsp;</td>
							{if $ISREGITAX}
<font color=blue>
		<td class='sep'>&nbsp;</td>
<td><font color=blue> {$elem.regitax} </font></td>
		<td class='sep'>&nbsp;</td>
<td><font color=blue> {$elem.regitext} </font></td>
							{else}
							{/if}
		<td class='sep'>&nbsp;</td>
<td> {$elem.created|date_format:"%d.%m.%Y"} &nbsp;
		<td class='sep'>&nbsp;</td>
<td title="{$elem.filename}" style="cursor:help;">
							{if $elem.suff=="html"}
{$elem.suff}
							{else}
<font color=red> {$elem.suff} </font>
							{/if}
		<td class='sep'>&nbsp;</td>
<td  align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай данните"></a></td>
		<td class='sep'>&nbsp;</td>
<td {if $elem.isassigned}class="issigreen"{/if}  align=center><a href="{$elem.issi}" class="nyroModal" target="_blank" style="font-size: 9px">[ИССИ]</a></td>
		<td class='sep'>&nbsp;</td>
<td  align=center><a href="{$elem.clon}" class="nyroModal" target="_blank"><img src="images/clone.gif" title="клонирай шаблона"></a></td>
		<td class='sep'>&nbsp;</td>
							{if $elem.suff=="html"}
<td  align=left><a href="{$elem.html}" class="nyroModal" target="_blank"><img src="images/editcont.gif" title="корегирай съдържанието"></a></td>
							{else}
<td  align=left>
<a href='file:///{$LETEDI}:/{$elem.filename}' target='_blank'><img src='images/word.gif' title='Корегирай в WORD'></a>
<a href="{$elem.uplo}" class="nyroModal" target="_blank"><img src="images/get.gif" title="смени файла"></a>
</td>
							{/if}
		<td class='sep'>&nbsp;</td>
				{if $elem.ishidden==0}
					{assign var=mytx value="да"}
					{assign var=myti value="скрий"}
					{assign var=mycl value=$elem.hidd}
				{else}
					{assign var=mytx value="<font color=red>не</font>"}
					{assign var=myti value="покажи"}
					{assign var=mycl value=$elem.acti}
				{/if}
<td align=center>
<span class="finahist" title="{$myti}" onclick="document.location.href='{$mycl}'; return false;">
{$mytx} </span>
</td>
{*---- брой изх.документи ----*}
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARCOUN[$elem.id]}
{*---- особени тагове ----*}
{***
		<td class='sep'>&nbsp;</td>
<td align=center> 
					{if $elem.artags===false}
<span style="color:red;cursor:help;" title="липсва файла">лф</span>
					{elseif empty($elem.artags)}
&nbsp;
					{else}
<img src="images/view2.gif" class="ttag" rel="#ctag{$elem.id}" title="тагове" style="cursor:help;">
					{/if}
<span id="ctag{$elem.id}" style="display: none">
{foreach from=$elem.artags item=taelem}
	{$taelem}<br>
{/foreach}
</span>
***}
{*---- връчване ----*}
								{if $ISPOST}
		<td class='sep'>&nbsp;</td>
<td> 
<nobr>
{$ARPOSTTYPE_2[$elem.idposttype]}
										{if empty($elem.postadresat) and empty($elem.postaddress)}
										{else}
<img src="images/view.png" class="tpos" rel="#cpos{$elem.id}" title="информация за връчването" style="cursor:help;">
										{/if}
								{else}
								{/if}
<span id="cpos{$elem.id}" style="display: none">
<table>
<tr>
<td> метод <td><b>{$ARPOSTTYPE[$elem.idposttype]}</b>
<tr>
<td> адресат <td><b>{$elem.postadresat}</b>
<tr>
<td> адрес <td><b>{$elem.postaddress}</b>
</table>
</span>
</nobr>
{*
{$elem.ismult}
*}
{*---- подреждане ----*}
		<td class='sep'>&nbsp;</td>
<td align=center class="case" title="подреждане" 
onmouseover="$(this).addClass('doso');" onmouseout="$(this).removeClass('doso');"
onclick="$.nyroModalManual({ldelim}url:'{$elem.sort}',forceType:'iframe'{rdelim});"
> П
	</tr>
								{*---- край : само с ненулев брой изх.документи ---- *}
								{/if}
{/foreach}
		</tbody>
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttag').cluetip({ldelim} width: 260, local:true, cursor:'pointer' {rdelim});
	$('.tpos').cluetip({ldelim} width: 360, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
