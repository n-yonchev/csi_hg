{include file="_tab2.tpl"}

			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'> {$HEPERE}
<br> маркирай САМО ТЕЗИ, които са свързани с перемирането
	{foreach from=$ARDATA item=elem key=id}
			<tr>
<td id="{$id}" class="poin" onclick="clic({$id});"> {$elem}
	{/foreach}
{*
{include file="_tab2pagi.tpl"}
*}
			</table>

<script>
$(document).ready(function() {ldelim}
	{foreach from=$ARDATA item=elem key=id}
		{if array_search($id,$ARID)===false}
			idoff({$id});
		{else}
			idon({$id});
		{/if}
	{/foreach}
{rdelim});

function acti(paid){ldelim}
alert(paid);
{rdelim}

function idon(paid){ldelim}
	$("#"+paid).addClass("mark").attr("title","ДЕмаркирай");
{rdelim}
function idoff(paid){ldelim}
	$("#"+paid).removeClass("mark").attr("title","маркирай");
{rdelim}

function clic(paid){ldelim}
	jQuery.ajax({ldelim}
		url: "pere1.php?v={$VARI}&i="+paid
		,success: clicresu
		{rdelim});
{rdelim}

function clicresu(data){ldelim}
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
		var paid= arre[1];
		var dire= arre[2];
		var coun= arre[3];
		if (dire=="0"){ldelim}
			idoff(paid);
		{rdelim}else{ldelim}
			idon(paid);
		{rdelim}
		$("#coun{$VARI}").text(coun);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
