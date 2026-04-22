									{if $FLPRIN}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
</style>
				<table align=center border=1>
				<tr>
<td class="hetext" colspan=2> &nbsp; представители и брой дела &nbsp;
<br>
образувани през 
		{if !empty($MONT)}
месец {$MONT}-{$YEAR}
		{else}
периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}
		{/if}
				<tr>
<td class="hetext" align=center> представител
<td class="hetext" align=center> дела
		{foreach from=$LIST item=elem key=ukey}
				<tr>
<td class="sttext"> {if empty($elem.agname)}<font color=red>няма представител</font>{else}{$elem.agname}{/if}
<td class="sttext" align=right> {$elem.coun}
		{/foreach}
				</table>
									{else}
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
{*
<thead>
	<tr>
<td class='d_table_title' colspan='200'> представители и дела
	</tr>
</thead>
*}
	<tr>
<td>
<center>
<h2>формиране</h2>
</center>
</table>

<iframe id="frarep" width=800 height=400 frameborder=0 style="visibility:visible"></iframe>
<script>
	document.getElementById("frarep").src= "{$URLCREATE}";
</script>
									{/if}
