	<table class="d_table" cellspacing='0' cellpadding='0' align=center border='0'>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> 
списък на банковите и други постъпления
				{if isset($FILTTEXT)}
&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font: bold 7pt verdana; color: black;">
{$FILTTEXT}
</span>
&nbsp;&nbsp;&nbsp;&nbsp;
{*----
{include file='_button.tpl' HREF="$FILTTOALL" TITLE='без филтър'}
----*}
<a href="{$FILTTOALL}" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">без филтър</a>
				{else}
				{/if}
						<span style="float:right;">
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
						</span>
	</td>
	<tr>
{*----
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
----*}
	<td colspan='200'>
{include file="_finaexfilt.tpl"}
	</td>
	</tr>

	</thead>
{*---- съдържание ----------------------*}

{include file="_fina.tpl" HIST=false}

{include file="_pagina.tr.tpl"}
	</table>



