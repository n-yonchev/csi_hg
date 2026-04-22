<style>
.vari {ldelim}font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer{rdelim}
.curr {ldelim}font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer; background-color:#dddddd; padding: 1px 10px;{rdelim}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
					{assign var=txperi value=$ARPERI[0]|cat:" год."}
					{if empty($ARPERI[1])}
					{else}
						{assign var=txperi value=$txperi|cat:" полугодие "|cat:$ARPERI[1]}
					{/if}
	<tr>
<td class='d_table_title' colspan='200'> отчет ВСС за {$txperi}</td>
	</tr>
</thead>

								{if $ISWARN}
				<tr>
<td style="font:normal 10pt verdana;color:red;padding:20px;">
ВНИМАНИЕ.
<br>
Трябва да са извършени изчисленията за отчета 
<br>
по раздел 1 и по раздел 2 за избрания период.
								{else}

				<tr>
<td>
<br>&nbsp;
						<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
{foreach from=$ARVARI item=elem key=ekey}
	<span class="{if $ekey==$VARI}curr{else}vari{/if}" {include file="_href.tpl" LINK=$elem.link}> {$elem.text} </span>
{/foreach}
						</form>
				<tr>
<td> 
<br> &nbsp;
{$REP3CONT}
<br> &nbsp;

								{/if}
</table>

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

{*----
<iframe id="frarep" width=1 height=1 style="visibility:hidden"></iframe>
----*}
<br>
<br>
<br>
<br>
<br>
<br>
<center>
<iframe id="frarep" width=800 height=400 frameborder=0 style="visibility:visible"></iframe>
</center>
{*--------*}
<script>
//function fuprin(p1){ldelim}
//alert("{$URLCREATE}");
//+++++++++++++++	document.getElementById("frarep").src= "{$URLCREATE}";
//{rdelim}
</script>
