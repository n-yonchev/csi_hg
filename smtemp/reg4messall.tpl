{include file="_tab2.tpl"}
<style>
.caselink {ldelim}font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
</style>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> брой дела с грешки от ЦРД-2014 по деловодители
		<tr class='head2'>
<td> деловодител
<td> общо<br>дела
<td> грешни<br>дела
<td> &nbsp;
{foreach from=$USERLIST item=username key=iduser}
						{if $ARCASE[$iduser]==0 and $ARMESS[$iduser]==0}
						{else}
				<tr>
<td title="{$iduser}"> 
		{if empty($username)}
			{if $iduser==0}
<font color=red>без деловодител</font>
			{else}
<font color=red>липсва деловодител [{$iduser}]</font>
			{/if}
		{else}
{$username}
		{/if}
<td align=right> {$ARCASE[$iduser]}
							{if $ARMESS[$iduser]==0}
<td> &nbsp;
							{else}
<td align=right class="caselink" {include file="_href.tpl" LINK=$ARLINK[$iduser].view}> {$ARMESS[$iduser]}
							{/if}
<td align=center> 
&nbsp;
<a href="#" onclick="tose('u_{$iduser}'); return false;">
<img src="images/admin.gif" title="предай ВСИЧКИ {$ARCASE[$iduser]} дела към ЦРД-2014"></a>
&nbsp;
						{/if}
{/foreach}

{include file="_tab2pagi.tpl"}

<script>
function tose(p1){ldelim}
		jQuery.ajax({ldelim}
			url: "cazo1tose.ajax.php?e="+p1
			,success: cazo1succ
			{rdelim});
{rdelim}
function cazo1succ(data){ldelim}
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
