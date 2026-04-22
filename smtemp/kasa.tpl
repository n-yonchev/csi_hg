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
.addnew {ldelim}font: normal 7pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
*}
body {ldelim}margin:0px 10px;{rdelim}
.dateinvo {ldelim}font:normal 7pt verdana;border:0px solid black; color:black;{rdelim}
</style>
						{/if}
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък на касови приходи и разходи {$TEXTHEAD}
						{if $FLPRIN}
						{else}
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fuprin('{$CURINT}');"><img src="images/excel.gif" title="изход Excel" border=0></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="dateinvo">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
</span>
						{/if}
		<tr class='head2'>
<td align=right> приход
<td align=right> разход
<td> дата
<td> документ
<td> номер
<td> тип
<td> вносител/получател
<td> основание
<td> дело
<td> деловодител
<td> касиер
{*
<td> &nbsp;
*}
{foreach from=$LIST item=elem key=ekey}
				<tr>
{*
					{if $elem.typesuma==3}
<td> &nbsp;
<td align=right> {$elem.suma|tomoney2}
					{else}
<td align=right> {$elem.suma|tomoney2}
<td> &nbsp;
					{/if}
*}
					{if $FLPRIN}
						{assign var=mysuma value=$elem.suma|tomoex}
					{else}
						{assign var=mysuma value=$elem.suma|tomoney2}
					{/if}
					{if $elem.typesuma==9}
<td> &nbsp;
<td align=right> {$mysuma}
					{else}
<td align=right> {$mysuma}
<td> &nbsp;
					{/if}
<td> {$elem.cashdate|date_format:"%d.%m.%Y"} &nbsp;
<td> {$ARC2DOCU[$elem.typesuma]}
<td> {$elem.cashserial}/{$elem.cashyear} &nbsp;
<td> {$ARC2TYPE[$elem.typesuma]}
<td> {$elem.cashname}
<td> {$elem.descrip}
<td>
			{if empty($elem.idcase)}
&nbsp;
			{else}
{$elem.caseseri}/{$elem.caseyear} &nbsp;
			{/if}
<td> {$elem.username}
<td> {$elem.cashuser}
{*
<td>
<a href="#" onclick="fuprin('{$elem.prin}');return false;"><img src="images/print.gif" title="отпечати документа"></a>
*}
{/foreach}
		<tr class='head2'>
{*
<td align=right> {$ARSUMA.suma1|tomoney2}
<td align=right> {$ARSUMA.suma2|tomoney2}
*}
					{if $FLPRIN}
						{assign var=mysuma1 value=$ARSUMA.suma1|tomoex}
						{assign var=mysuma2 value=$ARSUMA.suma2|tomoex}
					{else}
						{assign var=mysuma1 value=$ARSUMA.suma1|tomoney2}
						{assign var=mysuma2 value=$ARSUMA.suma2|tomoney2}
					{/if}
<td align=right> {$mysuma1}
<td align=right> {$mysuma2}
<td colspan=20> общо за периода

						{if $FLPRIN}
						{else}
{include file="_tab2pagi.tpl"}
						{/if}

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
