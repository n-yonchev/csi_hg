<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>
			<table>
{*
			<tr>
<td class="head" colspan=20 align=right> добави ред
*}
			<tr>
<td class="head"> описание
<td class="head"> мярка
<td class="head"> колич
<td class="head"> ед.цена
									{if $NOSERI}
<td class="head" align=center> 
<a href="{$ADDNEW}" class="nyroModal" target="_blank"><img src="images/clone.gif" title="добави ред"></a>
									{else}
									{/if}
		{foreach from=$LIST item=elem}
			<tr>
<td class="cell"> {$elem.descrip}
<td class="cell"> {$elem.meas}
<td class="cell" align=right> {$elem.quan}
<td class="cell" align=right> {$elem.price}
									{if $NOSERI}
<td class="cell"> 
<nobr>
<a href="{$elem.rowedit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай реда"></a>
{*
<a href="{$elem.rowdele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий реда"></a>
*}
<a href="#" onclick="dele2('{$elem.id}','{$elem.idbill}'  ,'{$elem.descrip}','{$elem.quan}','{$elem.meas}','{$elem.price}'); return false;">
<img src="images/free.gif" title="изтрий реда"></a>
</nobr>
									{else}
									{/if}
{*
<nobr>
<img src="images/edit.png" title="корегирай" 
onclick="$.nyroModalManual({ldelim}url:'{$elem.rowedit}',forceType:'iframe'{rdelim});">
<img src="images/free.gif" title="изтрий"
onclick="$.nyroModalManual({ldelim}url:'{$elem.rowdele}',forceType:'iframe'{rdelim});">
</nobr>
*}
		{/foreach}
			</table>

<script>
function dele2(pid,pinvo  ,pdes,pqua,pmea,pice){ldelim}
	if(confirm('потвърди изтриването на реда'+String.fromCharCode(10)+String.fromCharCode(10)+pdes
	+String.fromCharCode(10)+pqua+' '+pmea+' по '+pice+' €'))
	jQuery.ajax({ldelim}
		url: "finainvoelemdele.ajax.php?p="+pid+"&i="+pinvo
		,success: succ5
		{rdelim});
{rdelim}
function succ5(data){ldelim}
	var arre= data.split("^");
	var ok= arre[0];
	var idinvo= arre[1];
	if (ok=="ok"){ldelim}
		refresh(idinvo);
		refrow(idinvo);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
