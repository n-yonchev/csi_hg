						{if $FLPRIN}
<style>
td {ldelim}font:normal 8pt verdana; border-bottom: 1px solid silver; padding-left:4px; border-right: 1px solid silver;{rdelim}
tr.head1 td {ldelim}font:bold 10pt verdana; background-color: #dddddd;{rdelim}
tr.head2 td {ldelim}font:bold 10pt verdana; background-color: #dddddd;{rdelim}
</style>
						{else}
{include file="_tab2.tpl"}
<style>
{*
.over {ldelim}background-color:silver;{rdelim}
.caselink {ldelim}font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
*}
.addnew {ldelim}font: normal 7pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
body {ldelim}margin:0px 10px;{rdelim}
.dateinvo {ldelim}font:normal 7pt verdana;border:0px solid black; color:black;{rdelim}
</style>
						{/if}
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък разходни касови ордери {$TEXTHEAD}
						{if $FLPRIN}
						{else}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fuprin('{$CURINT}');"><img src="images/excel.gif" title="изход Excel" border=0></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="dateinvo">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$ADDNEW}" class="nyroModal addnew" target="_blank">добави РКО</a>
						{/if}
		<tr class='head2'>
<td align=right> сума
<td> дата
<td> номер
<td> изплатена на
<td> основание
<td> дело
<td> деловодител
<td> касиер
<td> &nbsp;
<td> &nbsp;
{foreach from=$LIST item=elem key=ekey}
				<tr>
{*
<td align=right> {$elem.amount|tomoney2}
*}
					{if $FLPRIN}
						{assign var=mysuma value=$elem.amount|tomoex}
					{else}
						{assign var=mysuma value=$elem.amount|tomoney2}
					{/if}
<td align=right> {$mysuma}
<td> {$elem.cashdate|date_format:"%d.%m.%Y"}
<td> {$elem.cashserial}/{$elem.cashyear} &nbsp;
<td> {$elem.cashname}
<td> {$elem.descrip}
<td>
			{if empty($elem.idcase)}
&nbsp;
			{else}
{$elem.caseri}/{$elem.cayear} &nbsp;
			{/if}
<td> {$elem.username}
<td> {$elem.cashier}
						{if $FLPRIN}
						{else}
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="#" onclick="dele('{$elem.dele}'); return false;"><img src="images/free.gif" title="изтрий"></a>
<td>
<a href="#" onclick="fuprin('{$elem.prin}');return false;"><img src="images/print.gif" title="отпечати РКО"></a>
						{/if}
{/foreach}
		<tr class='head2'>
					{if $FLPRIN}
						{assign var=mysuma1 value=$ARSUMA.suma1|tomoex}
					{else}
						{assign var=mysuma1 value=$ARSUMA.suma1|tomoney2}
					{/if}
<td align=right> {$mysuma1}
<td colspan=20> общо за периода

						{if $FLPRIN}
						{else}
{include file="_tab2pagi.tpl"}
						{/if}

<script>
function dele(link){ldelim}
	if(confirm('потвърди изтриването на РКО')) window.location.href=link;
{rdelim}
</script>

<script>
function autosubminvo(event,obinpu){ldelim}
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
		if (obinpu.value==""){ldelim}
		{rdelim}else{ldelim}
			lipara= {ldelim}date:obinpu.value,modeel:"{$MODEEL}"{rdelim};
			jQuery.ajax({ldelim}
				url: "finainvodate.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			{rdelim})
		{rdelim}
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
function fusucc(data){ldelim}
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){ldelim}
		$("#error").text("");
document.location.href= arresu[1];
	{rdelim}else{ldelim}
		$("#error").text(arresu[1]);
	{rdelim}
{rdelim}
</script>
