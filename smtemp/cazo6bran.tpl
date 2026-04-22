{*
	отгоре: $ARBRAN $COUNTPERCOL
*}

<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
href="#" onclick="checkon();return false;"> <nobr>всички да</nobr> </a>
&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="#" onclick="checkoff();return false;"> <nobr>всички не</nobr> </a>
<br>
<script type="text/javascript" src="js/jq.checkbox.js"></script>
<script>
function checkon(){ldelim}
//	$("input[@type='checkbox']").check("on");
	$("input[@rela='mycblist']").check("on");
				putsuma();
{rdelim}
function checkoff(){ldelim}
//	$("input[@type='checkbox']").check("off");
	$("input[@rela='mycblist']").check("off");
				putsuma();
{rdelim}
$(document.forms[0]).bind("submit",function(){ldelim}
{*
				var couyes= 0;
	$("input[@rela='mycblist']").each(function(){ldelim}
		if (this.checked){ldelim}
				couyes ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim});
//alert(couyes);
*}
			couyes= getchecked();
	if (couyes==0){ldelim}
alert("няма избран елемент от списъка");
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim});
function getchecked(){ldelim}
				var couyes= 0;
	$("input[@rela='mycblist']").each(function(){ldelim}
		if (this.checked){ldelim}
				couyes ++;
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim});
//alert(couyes);
return couyes;
{rdelim}
function putsuma(){ldelim}
				{if $ISREGITAX}
	couyes= getchecked();
//alert('putsuma='+couyes);
		var re= new RegExp(tempmark,"g")
		var myco= retext.replace(re,couyes);
	$("#regitext").attr("value",myco);
		var mytax= couyes*retax;
		mytax= mytax.toFixed(2);
	$("#regitax").attr("value",mytax);
				{else}
				{/if}
{rdelim}
</script>
					<table>
					<tr>
						{counter start=$COUNTPERCOL assign=mycoun}
	{foreach from=$ARBRAN item="branname" key="branid"}
						{counter assign=mycoun}
						{if $mycoun<=$COUNTPERCOL}
						{else}
							{counter start=1 assign=mycoun}
					<td valign=top>
						{/if}
<nobr>
<input type="checkbox" class="input" name="branlist[]" value="{$branid}" label="{$branname}" rela="mycblist" onclick="putsuma();">
</nobr>
<br/>
	{/foreach}
					</table>
