				{if $EDIT==0}
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
	<tr>
<td class='d_table_title' colspan=100> проба за банков превод
	</thead>
	<tbody>
	<tr>
	<td>
<br>
моля спуснете в зелената зона копираните няколко реда от банковото извлечение
<br>
след което натиснете бутона "запиши"
<br>
<textarea name="content" id="content" rows=16 cols=120 style="background-color:lightgreen; border: 0px solid black;"></textarea>
<br/>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
</table>
</form>
				{else}
<br>
<center style="font: bold 10pt verdana">
данните са записани, благодаря
</center>
				{/if}
