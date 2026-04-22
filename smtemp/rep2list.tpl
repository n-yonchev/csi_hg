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
<td class='d_table_title' colspan='200'> отчет раздел 2 за {$txperi}</td>
	</tr>
</thead>

{*----
<tr>
<td>
<center>
<h2>формиране</h2>
</center>
----*}
				<tr>
<td>
						<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
{foreach from=$ARVARI item=elem key=ekey}
	<span class="{if $ekey==$VARI}curr{else}vari{/if}" {include file="_href.tpl" LINK=$elem.link}> {$elem.text} </span>
{/foreach}
			{if $VARI=="resu"}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
виж дело ном/год 
<input style="font: bold 7pt verdana;background-color:#dddddd; border: 0px solid black;" autocomplete=off
type="text" name="rep2case" id="rep2case" size=14 onkeyup="autosubm(event);" onfocus="this.value='';">
+enter
			{else}
			{/if}
						</form>
				<tr>
<td> 
<br> &nbsp;
{$REP2CONT}
<br> &nbsp;

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
