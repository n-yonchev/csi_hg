<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
					{assign var=txperi value=$ARPERI[0]|cat:" год."}
					{if empty($ARPERI[1])}
					{else}
						{assign var=txperi value=$txperi|cat:" полугодие "|cat:$ARPERI[1]}
					{/if}
	<tr>
<td class='d_table_title' colspan='200'> отчет раздел 1 за {$txperi}</td>
	</tr>
</thead>

<tr>
<td>
<center>
<h2>формиране</h2>
</center>

</table>

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
	document.getElementById("frarep").src= "{$URLCREATE}";
//{rdelim}
</script>
