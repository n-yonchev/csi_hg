			{if $ISLIST}
			{else}
{include file="delicasebase.tpl"}
			{/if}

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
			{if $ISLIST}
<div style="float:left">Списък на изходени документи</div>
<div style="float:right" class="doinpu">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{*
<a style="cursor:pointer;border-bottom:1px solid black;" href="{$LINKDELELIST}"> изчисти списъка </a>
*}
<a style="cursor:pointer;border-bottom:1px solid black;" href="#" onclick="delelist('{$LINKDELELIST}');"> изчисти списъка </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div style="float:right" class="doinpu">
					<form method="post"
					style="float:right;margin:0px 0px 0px 6px;padding:0px;width:auto;white-space:nowrap;">
добави изх.номер/год
<input type="text" name="doutinpu" id="doutinpu" size=16 autocomplete=off
style="font:bold 7pt verdana; border: 0px solid green;background-color:silver;" onkeydown="autosubm8(event,this.form);">
+enter
					{if isset($ERDOUT)}
<font color=red>{$ERDOUT}</font>
					{else}
					{/if}
					</form>
			{else}
<div style="float:left">Списък на изходените документи по делото
			{/if}
</div>
				<tr class='head2'>
<td> изходен
<td> изходящ
<td> тип
			{if $ISLIST}
<td> дело
<td> деловодител
			{else}
<td> метод
<td> банков
			{/if}
<td> адресат
<td> адрес
<td> метод
			{if $ISLIST}
			{else}
<td class="wait"> &nbsp;
			{/if}
<td class="head3"> призовкар
<td class="head3"> взет
<td class="head3"> връчен
<td class="head3"> върнат
<td class="head3"> статус
			{if $ISLIST}
<td class="head3"> &nbsp;
			{else}
			{/if}

{foreach from=$ARDOUT item=elem key=iddout}
				<tr>
									{assign var=cosp value="rowspan="|cat:$elem.coun}
									{if empty($elem.coun)}
										{assign var=cosp value="rowspan=1"}
{*
									{elseif $elem.d2posttype==9 or $elem.isbank<>0}
*}
									{elseif ($elem.d2posttype==9 or $elem.isbank<>0) and !$ISLIST}
										{assign var=cosp value="rowspan=1"}
									{else}
									{/if}
{*
<td {$cosp} class="fon7 mark" title="от {$elem.d2userregi}"> {$elem.d2regi|date_format:"%d.%m.%Y %H:%M:%S"}
*}
<td {$cosp} class="mark fon7" title="от {$elem.d2userregi}"> {$elem.d2regi|date_format:"%d.%m.%Y"} <sub>[{$elem.d2regi|date_format:"%H:%M:%S"}]</sub>
<td {$cosp} class="spec" title="{$elem.iddout}" onclick="fuprin('{$elem.doutfilename}');"> {$elem.d2seri}/{$elem.d2year}
{*
[{$cosp}][{$elem.coun}][{$iddout}]
*}
<td {$cosp} class="spec fon7"> {$elem.d2text}&nbsp;
			{if $ISLIST}
<td {$cosp} class="spec fon7 case" {include file="_href.tpl" LINK=$elem.tocase} title="виж документите по делото"> {$elem.caseseri}/{$elem.caseyear}
<td {$cosp} class="spec fon7"> {$elem.username}
			{else}
<td {$cosp} class="spec fon7"> {$ARPOSTTYPE_2[$elem.d2posttype]}&nbsp;
<td {$cosp} class="spec fon7"> {if $elem.isbank==0}&nbsp;{else}банков({$elem.coun}){/if}
			{/if}
{*
						{if $elem.d2posttype==9 or $elem.isbank<>0}
*}
						{if ($elem.d2posttype==9 or $elem.isbank<>0) and !$ISLIST}
<td {$cosp} class="mark fon7" colspan=10> &nbsp;
						{else}
							{assign var=first value=true}
			{foreach from=$ARDELI[$iddout] item=elemdeli key=iddeli}
							{if $first}
								{assign var=first value=false}
							{else}
								<tr>
							{/if}
<td class=""> {$elemdeli.adresat}
<td class=""> {$elemdeli.address}&nbsp;
{*
<td class="fon7 mark2 cmet" title="промени метода на доставка" rel="deliintecmet.ajax.php?para={$elem.id}"> {$ARPOSTTYPE_2[$elemdeli.idposttype]}&nbsp;
*}
<td class="fon7"> {$ARPOSTTYPE_2[$elemdeli.idposttype]}&nbsp;
{*
<td class="wait"> {if $elemdeli.iswait==0}&nbsp;{else}чакащ{/if}
*}
						{if $ISLIST}
						{else}
<td class="wait"> 
			{if $elemdeli.iswait==0}
				{if $elemdeli.idposttype==2}
<a href="{$elemdeli.deliedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				{else}
&nbsp;
				{/if}
			{else}
чакащ
<nobr>
<img src="images/topaym.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elemdeli.waittonorm} title="прехвърли в норм.списък"> 
<a href="{$elemdeli.deliwaitedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
				{if $elemdeli.isdubl==0}
<img src="images/change.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elemdeli.deliwaitdubl} title="дублирай документа"> 
				{else}
<img src="images/free.gif" style="cursor:pointer;" {include file="_href.tpl" LINK=$elemdeli.deliwaitdele} title="изтрий дублирания документ"> 
				{/if}
</nobr>
			{/if}
						{/if}
<td class=""> {$elemdeli.pouser}&nbsp;
<td class="fon7"> {$elemdeli.date1|date_format:"%d.%m.%Y"}&nbsp;
<td class="fon7"> {$elemdeli.date2|date_format:"%d.%m.%Y"}&nbsp;
<td class="fon7"> {$elemdeli.date3|date_format:"%d.%m.%Y"}&nbsp;
<td class=""> {$elemdeli.postat}&nbsp;
						{if $ISLIST}
					{if $elemdeli.idposttype==2}
<td align=center>
<input class="cbox" type=checkbox name="cbdeli[]" value="{$elemdeli.tana}^{$elemdeli.taid}" id="{$elemdeli.tana}^{$elemdeli.taid}">
					{else}
<td class="mark fon7"> &nbsp;
					{/if}
						{else}
						{/if}
			{/foreach}
						{/if}
{/foreach}
{include file="_tab2pagi.tpl"}
{**}
						{if $ISLIST}
				<tr>
<td colspan=20>
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKEDIT}');"> корегирай полета </button>
<br>
в маркираните документи
	</div>
	<div style="float:right">
&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="float:right">
<button class="butt" onclick="fubegi('{$LINKCLEAR}');"> изчисти полета </button>
<br>
в маркираните документи
	</div>
						{else}
						{/if}
{**}
				</table>
{include file="deli.inc.tpl"}

<script>
$(document).ready(function() {ldelim}
	$("#doutinpu").focus();
{rdelim});
function delelist(link){ldelim}
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на целия списък');
	if (resu){ldelim}
		document.location.href= link;
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
function autosubm8(event,form){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
form.submit();
	{rdelim}else if(code==17 || code==74){ldelim}
		event.preventDefault();
	{rdelim}else{ldelim}
	{rdelim}
{rdelim}
</script>
