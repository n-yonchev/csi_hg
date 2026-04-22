				{if empty($FICONT)}
					{assign var="FICONT" value="<font size=+1 color=red>няма протокол</font>"}
				{else}
				{/if}
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> пълно съдържание на протокола
		</thead>
		<tr>
<td colspan='200'>

<div style="width:760px;height:400px;overflow:auto">
{$FICONT}
</div>

			</table>
