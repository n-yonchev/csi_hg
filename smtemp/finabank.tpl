<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

<style>
.head {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-top: 1px solid #cdcdcd;{rdelim}
.head2 {ldelim}font:normal 8pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd;{rdelim}
td {ldelim}font:normal 8pt verdana;{rdelim}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>банкови извлечения</td>
		</tr>
		<tr>
			<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
			</td>
		</tr>
	</thead>
		<tr >
<td class="head2" colspan=8> &nbsp; </td>
<td class="head2" colspan=8 align=center> брой редове </td>
		</tr>
		<tr>
<td class="head"> № </td>
<td class="head"> банка </td>
<td class="head"> от дата </td>
<td class="head"> до дата </td>
<td class="head"> нач.салдо </td>
<td class="head"> кр.салдо </td>
<td class="head"> обработено </td>
<td class="head"> &nbsp; </td>
<td class="head" align=center width=60> общо </td>
<td class="head" align=center width=60> разход </td>
<td class="head" align=center width=60> дублир.<br>постъпл. </td>
<td class="head" align=center width=60> нови<br>постъпл. </td>
<td class="head"> &nbsp; </td>
		</tr>
		{foreach from=$LIST item=elem key=ekey}
{*----
		<tr  onmouseover='this.className="tr_hover";this.style.cursor="pointer";' onmouseout='this.className="";this.style.cursor="default";' onclick="document.location.href='{$elem.bapaelem}';">
----*}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> {$elem.id} </td>
<td > {$BANKLIST[$elem.codebank]} </td>
<td > {$elem.date1} </td>
<td > {$elem.date2} </td>
<td align=right> {$elem.balance1} </td>
<td align=right> {$elem.balance2} </td>
<td > {$elem.created|date_format:"%d.%m.%Y %H:%M:%S"} </td>
						{assign var="myid" value=$elem.id}
{*----
<td > <img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация"></td>
						{assign var="COTOTA" value=$ARCOUN.tota.$myid}
						{assign var="COINPU" value=$ARCOUN.inpu.$myid}
						{assign var="CONEWW" value=$ARCOUN.neww.$myid}
						{assign var="COFREE" value=$ARCOUN.free.$myid}
						{assign var="CONOTD" value=$ARCOUN.notd.$myid}
			{include file="_bapatd.tpl" DATA=$CONEWW COLO=""}
			<td class='sep'>&nbsp;</td>
			{include file="_bapatd.tpl" DATA=$CONEWW-$COFREE-$CONOTD COLO="#ddffdd"}
			<td class='sep'>&nbsp;</td>
			{include file="_bapatd.tpl" DATA=$COFREE COLO="#ffeedd"}
			<td class='sep'>&nbsp;</td>
			{include file="_bapatd.tpl" DATA=$CONOTD COLO="#ffaaaa"}
----*}		
{*--------
<td > <img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация" style="cursor:help;"></td>
<td align=center> {$elem.cotot} </td>
<td align=center> {$elem.cotot-$elem.coinp} </td>
<td align=center> {$elem.codub} </td>
<td align=center> {$elem.conew} </td>
--------*}
<td > <img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация" style="cursor:help;"></td>
<td align=right> {$elem.cotot} &nbsp;&nbsp;</td>
<td align=right> {$elem.cotot-$elem.coinp} &nbsp;&nbsp;</td>
<td align=right bgcolor="{if $elem.codub==0}salmon{else}{/if}"> {$elem.codub} &nbsp;&nbsp;</td>
<td align=right> {$elem.conew} &nbsp;&nbsp;</td>
<td > 
<a href="{$elem.viewrows}" class="nyroModal" target="_blank"><img src="images/view.png" title="виж редовете"></a>
</td>

{*---- съдържание на доп.информация ----*}
{*----
<span id="cont{$myid}" style="display: none">
начално салдо  : <b>{$elem.balance1}</b>
<br>
крайно салдо  : <b>{$elem.balance2}</b>
<br>
архивен файл : <b>{$elem.filename}</b>
<br>
<br>
брой извлечения : 
<br>
<b>{$COTOTA+0}</b> &nbsp; общо
<br> &nbsp;&nbsp;&nbsp;
	<b>{$COTOTA-$COINPU+0}</b> &nbsp; разходни
<br> &nbsp;&nbsp;&nbsp;
	<b>{$COINPU+0}</b> &nbsp; приходни
<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>{$COINPU-$CONEWW+0}</b> &nbsp; дублирани
<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>{$CONEWW+0}</b> &nbsp; нови
<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>{$CONEWW-$COFREE-$CONOTD+0}</b> &nbsp; насочени
<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>{$COFREE+0}</b> &nbsp; маркирани
<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>{$CONOTD+0}</b> &nbsp; ненасочени
</span>
----*}
<span id="cont{$myid}" style="display: none">
сметка IBAN : <b>{$elem.iban}</b>
<br>
архивен файл :
<br>
<b>{$elem.filename}</b>
<br>
</span>
		</tr>
		{/foreach}
{include file="_pagina.tr.tpl"}
			</table>
<br>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 360, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
