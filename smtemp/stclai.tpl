									{if $FLPRIN}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:center;{rdelim}
</style>
				<table align=center border=1>
				<tr>
<td class="hetext" colspan=5> &nbsp; взискатели и брой дела &nbsp;
<br>
образувани през 
		{if !empty($MONT)}
месец {$MONT}-{$YEAR}
		{else}
периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}
		{/if}
				<tr>
<td class="hetext" align=center> взискател
<td class="hetext" align=center> тип
<td class="hetext" align=center> булстат
<td class="hetext" align=center> егн
<td class="hetext" align=center> дела
		{foreach from=$LIST item=elem key=ukey}
				<tr>
<td class="sttext"> {if empty($elem.name)}<font color=red>няма взискател</font>{else}{$elem.name}{/if}
<td class="sttext"> 
				{if $elem.idtype==1}
юрид
				{elseif $elem.idtype==2}
физ
				{else}
др
				{/if}
<td class="sttext"> {$elem.bulstat}&nbsp;
<td class="sttext"> {$elem.egn}&nbsp;
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
