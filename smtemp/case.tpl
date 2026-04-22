<style>
.user1 {ldelim}background-color:wheat;{rdelim}
.user2 {ldelim}background-color:gold;color:red{rdelim}
</style>
{include file="_tabslist.tpl"}

							{if isset($FLAGACTI)}
					{if $FLAGACTI}
			{assign var='textacti' value='активни'}
					{else}
			{assign var='textacti' value='прекратени'}
					{/if}
	{if $FILT=="all"}
{assign var='_tmp' value='списък на всички '|cat:$textacti|cat:' дела'}
	{else}
{assign var='_tmp' value='списък на '|cat:$textacti|cat:'те дела по филтър'}
	{/if}
							{else}
	{if $FILT=="all"}
{assign var='_tmp' value='списък на всички дела'}
	{else}
{assign var='_tmp' value='списък на всички дела по филтър'}
	{/if}
							{/if}

<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
		<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
				<tr>
	{if $VIEWUSERNAME}
				<td class='d_table_title' colspan='10'>{$_tmp}
{*----
{include file="newcseri.tpl"}
----*}
				</td>
{*----
				<td class='d_table_title' colspan='6'>{$_tmp}</td>
				<td class='d_table_title' colspan='4'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
				</td>
----*}
<td colspan='12' align=right>
				{*---- 07.04.2010 специално за НЕделоводители по филтър ----*}
				{if $FLAGBACK}
				{else}
						{if $NOPERMUSER}
						{else}
деловодител за назначаване 
{include file="_select.tpl" FROM=$USERLIST ID="ownerid" C1="input7" C2="inputer" ONCH="document.forms['myseleform'].submit();"}
						{/if}
				{/if}
</td>
</tr>
	{else}
				<td class='d_table_title' colspan='22'>{$_tmp}
{*----
{include file="newcseri.tpl"}
----*}
				</td>
	{/if}
				</tr>
				<tr>
				<td colspan='200'>
<table width=100%>
					{include file="_filtvisu.tpl" GROUP=1 TEXT="изпълнително дело"}
					{include file="_filtvisu.tpl" GROUP=2 TEXT="съдебно дело"}
{*----
					{include file="_filtvisu.tpl" GROUP=3 TEXT="страни"}
ВНИМАНИЕ. 06.04.2010 - Софрониев 
Вече има отделни полета за взискател и длъжник 
----*}
{include file="_filtvisu.tpl" GROUP=3 TEXT="взискател"}
{include file="_filtvisu.tpl" GROUP=4 TEXT="длъжник"}
{*--------*}
					<td class='d_table_button' colspan='200'>
						{if isset($FILTYES)}
							{if $FILT=="all"}
								{assign var='_tmp' value='въведи филтър'}
							{else}
								{assign var='_tmp' value='корегирай филтъра'}
							{/if}
							
{*----
{include file='_button.tpl' HREF=$FILTYES CLASS='nyroModal' TARGET='_blank' TITLE="<img src='images/view.png' title='всички дела' /> $_tmp"}
----*}
{include file='_button.tpl' HREF=$FILTYES CLASS='nyroModal' TARGET='_blank' TITLE="<img src='images/view.png' title='$_tmp' /> $_tmp"}
						{else}
						{/if}
						
						{if isset($FILTALL)}
{*----
{include file='_button.tpl' HREF=$FILTALL TITLE='<img src="images/all.gif" title="всички дела" /> всички дела'}
----*}
{include file='_button.tpl' ONCLICK="document.location.href='$FILTALL';" TITLE='<img src="images/all.gif" title="всички дела" /> всички дела'}
						{else}
						{/if}
</table>
					</td>
				</tr>
			</thead>
				<tr class='header'>
					<td><span> номер </span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> описание</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> идва от</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> създадено</span></td>
					<td class='sep'>&nbsp;</td>
					<td><span> посл.промяна</span></td>
							{if $VIEWUSERNAME}
					<td class='sep'>&nbsp;</td>
					<td><span> деловодител </span></td>
<td class='sep'>&nbsp;</td>
{*----
<td> id </td>
<td class='sep'>&nbsp;</td>
----*}
<td> вход.док. </td>
							{else}
					<td class='sep'>&nbsp;</td>
					<td></td>
							{/if}
					<td class='sep'>&nbsp;</td>
					<td></td>
					<td class='sep'>&nbsp;</td>
					<td></td>
<td class='sep'>&nbsp;</td>
<td colspan=2>статус</td>
				{*---- статуса за основ.данни - брояч ----*}
				{if $ISBASESTATUS and !$VIEWUSERNAME}
<td class='sep'>&nbsp;
<td></td>
				{else}
				{/if}
									{*---- 12.04.2010 архива ----*}
									{if $FLAGARCHIVE}
<td class='sep'>&nbsp;</td>
<td>
{*
<a id="garch" href="#" class="nyroModal" target="_blank">
*}
{***
<a href="casearch.ajax.php{$LINKARCHIVE}" class="nyroModal" target="_blank">
<img src="images/archive.gif" title="архивирай всички маркирани" onclick="grouparch();"></a>
архив
***}
</td>
									{else}
									{/if}
				</tr>
			<tbody>
			{foreach from=$CASELIST item=elem key=ekey}
		{if $elem.flagstat==1}
			{assign var=bgco value="#ffddaa"}
		{elseif $elem.flagstat==2}
			{assign var=bgco value="#ffaadd"}
		{else}
			{assign var=bgco value=""}
		{/if}
<tr onclick="document.location.href='{$elem.edit}';"
{*----
onmouseover='this.className="tr_hover";this.style.cursor="pointer";' onmouseout='this.className="";this.style.cursor="default";'>
----*}
bgcolor="{$bgco}"
onmouseover='this.style.backgroundColor="#dddddd";this.style.cursor="pointer";' 
onmouseout='this.style.backgroundColor="{$bgco}";this.style.cursor="default";'
>
				<td> {$elem.serial}/{$elem.year}</td>
				<td class='sep'>&nbsp;</td>
				<td> {$elem.text}
				{assign var="arindx" value=$elem.idcofrom} </td>
				<td class='sep'>&nbsp;</td>
				<td> {$ARFROM.$arindx}</td>
				<td class='sep'>&nbsp;</td>
				<td> {$elem.created|date_format:"%d.%m.%Y"}</td>
				<td class='sep'>&nbsp;</td>
				<td> {$elem.lastdocu|date_format:"%d.%m.%Y %H:%M"}</td>
{assign var="myid" value=$elem.id}
							{if $VIEWUSERNAME}
			<td class='sep'>&nbsp;</td>
{*----
			<td id="w{$elem.id}" onmouseover="this.style.backgroundColor='#ffee99';" onmouseout="this.style.backgroundColor='';"
----*}
<td id="w{$elem.id}" class="user1" onmouseover="this.className='user2';" onmouseout="this.className='user1';"
{*--------*}
						{if $NOPERMUSER}
						{else}
			title="назначи {if empty($OWNAME)}без деловодител{else}{$OWNAME}{/if}" 
			onclick="getowner(event,'w{$elem.id}',{$elem.id});"
						{/if}
			> {$elem.username} </td>
<td class='sep'>&nbsp;</td>
{*----
<td bgcolor=#ddffdd> {$elem.id} </td>
<td class='sep'>&nbsp;</td>
----*}
<td bgcolor=#ddffdd> 
				{if empty($elem.listdocu)}
<font color=red><b>
няма вход.докум.
</b></font>
				{else}
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="документите подробно">
&nbsp;
{foreach from=$elem.listdocu item=eldocu key=docukey}
		{if $docukey<=1}
	{$eldocu.serial}/{$eldocu.year} &nbsp;
		{else}
	+
		{/if}
{/foreach}
{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
	<table class="ct" align=center>
	<thead>
	<tr>
<td> <b>вх.номер</b>
<td> <b>дата</b>
<td> <b>подател</b>
<td> <b>описание</b>
<td> <b>бележки</b>
	</thead>
	<tbody>
{foreach from=$elem.listdocu item=eldocu}
	<tr valign=top>
<td> {$eldocu.serial}/{$eldocu.year}
<td> {$eldocu.created|date_format:"%d.%m.%Y"}
<td> {$eldocu.from}
<td> {$eldocu.text}
<td> {$eldocu.notes|truncate:30:"...":true}
{/foreach}
	</tbody>
	</table>
</span>
				{/if}
</td>
							{else}
				<td class='sep'>&nbsp;</td>
				<td align=center> 
						{if $elem.last2==0}
				<img src="images/notviewed.gif" border="0" title="отвори">
						{else}
				&nbsp;
						{/if}
				</td>
							{/if}
				<td class='sep'>&nbsp;</td>
<td align=center>
<nobr>
						{if empty($elem.lockname)}
				&nbsp;
						{else}
<img src="images/locked.gif" border="0" title="заключено от {$elem.lockname}" style="cursor:help;">
						{/if}
						{if empty($elem.gounlock)}
				&nbsp;
						{else}
{*----
<img src="images/lock3.gif" border="0" title="ОТКЛЮЧИ." onclick="event.cancelBubble=true;document.location.href='{$elem.unlock}';">
----*}
<a href="{$elem.gounlock}" class="nyroModal" target="_blank">
<img src="images/lock3.gif" border="0" title="ОТКЛЮЧИ.">
</a>
						{/if}
</nobr>
				<td class='sep'>&nbsp;</td>
<td align=center onclick="event.cancelBubble=true;document.location.href='{$elem.lockmy}';">
						{if empty($elem.lockmy)}
				&nbsp;
						{else}
{*
<img src="images/lock2.gif" border="0" title="заключено от мене. ОТКЛЮЧИ.">
*}
&nbsp;
						{/if}
				</td>
<td class='sep'>&nbsp;</td>
<td> 
	{if empty($elem.hist)}
&nbsp;
	{else}
<img src="images/view.png" class="hist" rel="#hist{$myid}" title="история на статусите">

{*---- съдържание на историята на статусите ----*}
<span id="hist{$myid}" style="display: none">
	<table class="ct" align=center>
	<thead>
	<tr>
<td> <b>време</b>
<td> <b>променил</b>
<td> <b>статус</b>
	</thead>
	<tbody>
{foreach from=$elem.hist item=eldocu}
	<tr valign=top>
<td> {$eldocu.time|date_format:"%d.%m.%Y %H:%M"}
<td> {$eldocu.username}
	{assign var='indxstat' value=$eldocu.idstat}
<td> {$ARSTAT.$indxstat}
{/foreach}
	</tbody>
	</table>
</span>
</td>
	{/if}
	{assign var='indxstat' value=$elem.idstat}
<td> {$ARSTAT.$indxstat} &nbsp;
				{*---- статуса за основ.данни - брояч ----*}
				{if $ISBASESTATUS and !$VIEWUSERNAME}
<td class='sep'>&nbsp;</td>
	{if $elem.basecoun=="0"}
<td class="red7bg" align=right> {$elem.basecoun} </td>
	{else}
<td class="red7" align=right> {$elem.basecoun} </td>
	{/if}
				{else}
				{/if}
									{*---- 12.04.2010 архива ----*}
									{if $FLAGARCHIVE}
<td class='sep'>&nbsp;</td>
										{if empty($elem.archive)}
											{if $elem.notclosed >1}
<td>
&nbsp;
											{else}
<td align=left>
{*
<input type=checkbox name="toarchive[]" value="{$elem.id}" onclick="event.cancelBubble=true;">
*}
{*----
<a href="casearch.ajax.php{$elem.toarch}" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<span title="архивирай" style="font:normal 8pt verdana; background-color:wheat; padding: 1px 6px;">a</span>
</a>
----*}
											{/if}
										{else}
<td align=center>
<a href="casearch.ajax.php{$elem.editarch}" class="nyroModal" target="_blank" onclick="event.cancelBubble=true;">
<img src="images/archive.gif" class="arch" rel="#arch{$myid}" title="данни за архива"></a>
{*---- съдържание на данните за архива ----*}
<span id="arch{$myid}" style="display: none">
последна корекция от <b>{$elem.archive.username}</b>
<br>
на <b>{$elem.archive.time|date_format:"%d.%m.%Y %H:%M"}</b>
{*
	<table align=center>
	<tr>
<td align=left>номер/дата <td> <b>{$elem.archive.serial}/{$elem.archive.date|date_format:"%d.%m.%Y"}</b>
	<tr>
<td align=left>връзка № <td> <b>{$elem.archive.packet}</b>
	<tr>
<td align=left>протокол <td> <b>{$elem.archive.protocol}</b>
	<tr>
<td align=left>документи <td> <b>{$elem.archive.documents}</b>
	<tr>
<td align=left>том/година <td> <b>{$elem.archive.volume}/{$elem.archive.year}</b>
	<tr>
<td align=left>забележка <td> <b>{$elem.archive.notes}</b>
	</table>
*}
	<table align=center>
	<tr>
<td align=left>арх.номер <td> <b>{$elem.archive.serial}</b> от <b>{$elem.archive.year}</b> год.
	<tr>
<td align=left>архивиран <td> <b>{$elem.archive.date|date_format:"%d.%m.%Y"}</b>
	<tr>
<td align=left>протокол <td> <b>{$elem.archive.protocol}</b> от <b>{$elem.archive.protdate|date_format:"%d.%m.%Y"}</b>
	<tr>
<td align=left>забележка <td> <b>{$elem.archive.notes}</b>
	</table>
</span>
										{/if}
</td>
									{else}
									{/if}
			</tr>
		{/foreach}
		</tbody>
		{include file="_pagina.tr.tpl"}
		</table>
<br> &nbsp;
</form>

	{if isset($LINKLOCK)}
<span style="visibility: hidden">
<a id="lock" href="caselocked.ajax.php{$LINKLOCK}" class="nyroModal" target="_blank"> lock </a>
</span>
	{else}
	{/if}
	{if isset($LINKOWNE)}
<span style="visibility: hidden">
<a id="owne" href="casenotowner.ajax.php{$LINKOWNE}" class="nyroModal" target="_blank"> notowner </a>
</span>
	{else}
	{/if}

<script>
function getowner(event,tdid,caid){ldelim}
	event.cancelBubble=true; 
	$("#"+tdid).html("<img src='ajaxload.gif'>");
	$("#"+tdid).load(encodeURI('caseowne.ajax.php?caid='+caid));
{rdelim}
</script>

<style>
table.ct thead tr td {ldelim} background-color: silver {rdelim}
table.ct tbody tr td {ldelim} border-bottom: 1px solid black {rdelim}
</style>
							{if $VIEWUSERNAME}
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 540, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
							{else}
							{/if}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$('.hist').cluetip({ldelim} width: 360, local:true, cursor:'pointer' {rdelim});
									{*---- 12.04.2010 архива ----*}
									$('.arch').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>

{*
<script type="text/javascript">
function grouparch(){ldelim}
			var lire= "";
	$(":checked").each(function(){ldelim}
			lire += ","+this.value;
	{rdelim});
//			if (lire==""){ldelim}
//alert("няма избрани дела");
//			{rdelim}else{ldelim}
	lire= lire.substr(1);
	lipara= {ldelim}listarch:lire{rdelim};
	jQuery.ajax({ldelim}
		url: "casearchsess.ajax.php"
		,data: lipara
		,type: "post"
//		,success: fusucc
		{rdelim});
//			{rdelim}
{rdelim}
function fusucc(data){ldelim}
alert(data);
{rdelim}
</script>
*}
