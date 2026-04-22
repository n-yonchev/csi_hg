		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> грешки в предадените данни
		</thead>
		<tr>
<td colspan='200'>

<div style="width:760px;height:400px;overflow:auto">
				<table width=100%>
				<tr>
<td class="head"> №
<td class="head"> грешка
<td class="head"> дело
<td class="head"> деловодител
										{counter start=0 assign=mycoun}
			{foreach from=$ARMIST item=elem}
										{counter assign=mycoun}
				<tr>
<td align=right> {$mycoun}
<td> {$elem[0]|wordwrap:70:"<br>":true}
<td style="background:#dddddd;cursor:pointer;" onclick="document.location.href='{$elem[3]}';"
title="корегирай делото"> {$elem[1]}
<td> {$elem[2]}
			{/foreach}
				</table>
</div>

			</table>
