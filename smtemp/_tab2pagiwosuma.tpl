					{assign var=mypref value="css/blue/table/"}
					{assign var=mystyl value="style='cursor:pointer'"}
<tr class='pagi'>

<td class='' colspan='160'>
		<table width=100% cellpadding=0 cellspacing=0>
		<tr>
					{if count($PAGIPARA.PAGELIST)<2}
					{else}
<td align=left style="border:0px solid green;">
						{if $PAGIPARA.PAGENO==1}
						{else}
<div style="float:left;">
<img src="{$mypref}button_first_active.gif" {$mystyl} onclick="document.location.href='{$PAGIPARA.ONFIRST}'; return false;" title="първа">
<img src="{$mypref}button_prev_active.gif" {$mystyl} onclick="document.location.href='{$PAGIPARA.ONPREV}'; return false;" title="предишна">
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
						{/if}
<div style="float:left;margin-top:4px;">
стр. <input type='text' name="pageform" id="pageform" value='{$PAGIPARA.PAGENO}' style="width:40px;font:bold 7pt verdana; border:0px solid red"
onkeyup="return myautosubm(event,this.form);" autocomplete=off>
&nbsp;&nbsp;
от {$PAGIPARA.TOTPAG|tointe} 
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
						{if $PAGIPARA.PAGENO == $PAGIPARA.TOTPAG}
						{else}
<div style="float:left;">
<img src="{$mypref}button_next_active.gif" {$mystyl} onclick="document.location.href='{$PAGIPARA.ONNEXT}'; return false;" title="следваща">
<img src="{$mypref}button_last_active.gif" {$mystyl} onclick="document.location.href='{$PAGIPARA.ONLAST}'; return false;" title="последна">
</div>
						{/if}
					{/if}
<td align=right style="border:0px solid green;">
общо {$PAGIPARA.TOTREC|tointe} реда 
		</table>
<script>
function myautosubm(event,obform){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//alert("code="+code);
	if (code==13){ldelim}
//			lipara= {ldelim}href:document.location.href,page:$("#pageform").attr("value"){rdelim};
lipara= {ldelim}panoname:"{$PAGIPARA.PANONAME}",href:document.location.href,page:$("#pageform").attr("value"){rdelim};
			jQuery.ajax({ldelim}
				url: "pagi.ajax.php"
				,data: lipara
				,type: "post"
				,success: function(data){ldelim}
//alert(data);
document.location.href= data;
				{rdelim}
			{rdelim});
return false;
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
