{include file="_tabslist.tpl"}

	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> СПИСЪК НА ПОСТЪПЛЕНИЯТА за месец {$MONT}
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
	</tr>
	<tr>
<td class='d_table_button' colspan='200'>
{*----
{include file='_button.tpl' HREF="$COPYFROM" CLASS='nyroModal' TARGET='_blank' TITLE='копирай'}
----*}
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
	</tr>
	</thead>
{*---- съдържание ----------------------*}

{include file="_fina2.tpl" HIST=false}

{include file="_pagina.tr.tpl"}
	</table>



