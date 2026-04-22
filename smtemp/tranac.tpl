{include file="_tab2.tpl"}
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'> списък на специалните сметки за превод
<div style="float:right">
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
							{if empty($ARMESS)}
							{else}
{foreach from=$ARMESS item=elem key=ekey}
<br>
<span class="ermess" style="padding-left:20px;"> липсва сметка {$ARACCOTYPE[$elem]}
{/foreach}
							{/if}
				<tr class='head2'>
<td> IBAN
<td> BIC
<td> тип
{*
<td> взискател/бенефициент
*}
<td> описание
<td> &nbsp;

{foreach from=$LIST item=elem key=ekey}
		{include file="_tab2tr.tpl"}
<td> {$elem.iban}
<td> {$elem.bic}
<td> {$ARACCOTYPE[$elem.code]}
<td> {$elem.desc}
<td>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
{*
<a href="{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
*}
<a href="#" onclick="dele2('{$elem.id}','{$elem.iban}','{$ARACCOTYPE[$elem.code]}'); return false;">
<img src="images/free.gif" title="изтрий"></a>
{/foreach}

{*
{include file="_tab2pagi.tpl"}
*}
				</table>

<script>
function dele2(pid,piban,ptype){ldelim}
	if(confirm('потвърди изтриването на сметка'+String.fromCharCode(10)+piban
	+String.fromCharCode(10)+ptype))
	jQuery.ajax({ldelim}
		url: "tranacdele.ajax.php?p="+pid
		,success: succ2
		{rdelim});
{rdelim}
function succ2(data){ldelim}
	if (data=="ok"){ldelim}
parent.location.href= "{$RELURL}";
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
