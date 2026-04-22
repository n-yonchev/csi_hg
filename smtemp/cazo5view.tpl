<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

{*----
<table class="d_table" width='100%' cellspacing='0' cellpadding='0' align=center>
----*}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
<thead>
	<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">входящи документи
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
			{/if}
	</tr>
	
</thead>
	<tr class='header'>
		<td><span> вх.номер</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> дата </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бел</span></td>
		<td class='sep'>&nbsp;</td>
<td>образ
							{if empty($USERPRIN) or $FLAGNOCHANGE}
							{else}
		<td class='sep'>&nbsp;</td>
<td id="scanwaitcoun" align=center style="background:gold;cursor:pointer;font:bold 8pt verdana;" onclick="scanclic(1);">&nbsp;
							{/if}
	</tr>
<tbody>
	{foreach from=$LIST item=elem key=ekey}		
	<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
		<td> {$elem.serial}/{$elem.year}</td>			
			<td class='sep'>&nbsp;</td>	
			<td> {$elem.created|date_format:"%d.%m.%Y"}</td>
		<td class='sep'>&nbsp;</td>			
		<td> {$elem.text}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.from}</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if empty($elem.notes)}
&nbsp;
	{else}
<img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
	{/if}
		<td class='sep'>&nbsp;</td>
<td align=left>
<nobr>
<a href="caseeditzone.php{$elem.scanuplo}" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
					{assign var=iddocu value=$elem.id}
					{assign var=scancoun value=$ARSCANCOUN[$iddocu]}
		{if $scancoun==0}
&nbsp;
		{else}
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('caseeditzone.php{$elem.scanview}','win2');w2.focus();">
			{if $scancoun==1}
			{else}
<sup>{$ARSCANCOUN[$iddocu]}</sup>
			{/if}
		{/if}
</nobr>
							{if empty($USERPRIN) or $FLAGNOCHANGE}
							{else}
		<td class='sep'>&nbsp;</td>
								{if $elem.iduser==$smarty.session.iduser}
<td align=center>
<img src="images/print.gif" title="отпечати етикет" style="cursor:pointer" onclick="plabel('{$elem.id}');">
								{else}
<td>&nbsp;
								{/if}
							{/if}
	</tr>
	{/foreach}
</tbody>
</table>
<script type="text/javascript">
												{if isset($LINKDOCUUPLO)}
	setTimeout("$.nyroModalManual({ldelim}forceType:'iframe', url:'caseeditzone.php{$LINKDOCUUPLO}'{rdelim})",1000);
												{else}
												{/if}
							{if empty($USERPRIN) or $FLAGNOCHANGE}
							{else}
						scanclic(0);
function scanclic(isfull){ldelim}
window.fullacti= isfull;
window.countext= $("#scanwaitcoun").text();
	$("#scanwaitcoun").html("<img src='ajaxload.gif'>");
	jQuery.ajax({ldelim}
		url: "scan.inc.php?u={$smarty.session.iduser}"
		,success: scansu
		{rdelim});
{rdelim}
function scansu(data){ldelim}
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
		var coun= arre[1];
		if (coun=="0"){ldelim}
			$("#scanwaitcoun").text("").attr("title","провери за сканирани документи");
		{rdelim}else{ldelim}
			$("#scanwaitcoun").text(coun).attr("title","виж списъка със сканираните документи");
			if (window.fullacti==1 && window.countext!=""){ldelim}
				$.nyroModalManual({ldelim}forceType:'iframe', url:'caseeditzone.php{$SCANMASSLINK}'{rdelim});
			{rdelim}else{ldelim}
			{rdelim}
		{rdelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
							{/if}
</script>

<script>
function s4call(p1){ldelim}
		jQuery.ajax({ldelim}
			url: "cazo5scanview.ajax.php?"+p1
			,success: s4succ
			{rdelim});
{rdelim}
function s4succ(data){ldelim}
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
$('#t5link').click();
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

function plabel(iddo){ldelim}
	jQuery.ajax({ldelim}
		url: "scan.inc.php?d="+iddo
		,success: plabsu
		{rdelim});
{rdelim}
function plabsu(data){ldelim}
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

</script>
