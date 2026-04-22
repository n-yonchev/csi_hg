<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
{*---- избор на дата/период ----*}
<br>
избери месец
				{foreach from=$MONTLIST item=mont key=montid}
<a href="#"
onclick="window.location.href='{$LINKMONT[$montid]}';"
> {$mont}
</a>
				{/foreach}
<br>
<br>
или въведи период
{*----
<span class="clperi" style="background-color:#dddddd;cursor:help;padding:4px;" rel="stdate.ajax.php" title="въведи период"> 
дата/период </span>
----*}
					{if empty($TXER)}
						{assign var=bord value=""}
						{assign var=tier value=""}
					{else}
						{assign var=bord value="border:1px solid red;"}
						{assign var=tier value=$TXER}
					{/if}
<input style="font: normal 8pt verdana;{$bord}" type=text name="period" id="period" size=26 onkeyup="autosubm(event);" title="{$tier}">
+enter
</form>
<script>
function autosubm(event){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
document.forms['myform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
{*---- ----*}
