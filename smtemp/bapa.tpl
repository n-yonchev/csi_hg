<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />

<table class="d_table" width='800px;' cellspacing='0' cellpadding='0' align=center>
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
		<tr class='header'>
			<td colspan=7> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td colspan=7 align=center> нови постъпления </td>
		</tr>
		<tr class='header'>
			<td> от дата </td>
			<td class='sep'>&nbsp;</td>
			<td> от дата </td>
			<td class='sep'>&nbsp;</td>
			<td> обработено </td>
			<td class='sep'>&nbsp;</td>
			<td> &nbsp; </td>
			<td class='sep'>&nbsp;</td>
			<td> общо </td>
			<td class='sep'>&nbsp;</td>
			<td> насочени </td>
			<td class='sep'>&nbsp;</td>
			<td> маркирани </td>
			<td class='sep'>&nbsp;</td>
			<td> ненасочени </td>
			
		</tr>
		{foreach from=$LIST item=elem key=ekey}
		<tr  onmouseover='this.className="tr_hover";this.style.cursor="pointer";' onmouseout='this.className="";this.style.cursor="default";' onclick="document.location.href='{$elem.bapaelem}';">
			<td > {$elem.date1} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.date2} </td>
			<td class='sep'>&nbsp;</td>
			<td > {$elem.created|date_format:"%d.%m.%Y"} </td>
						{assign var="myid" value=$elem.id}
			<td class='sep'>&nbsp;</td>
			<td > <img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация"></td>
			<td class='sep'>&nbsp;</td>
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
		

{*---- съдържание на доп.информация ----*}
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
		</tr>
		{/foreach}
{include file="_pagina.tr.tpl"}
			</table>
<br>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 270, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
