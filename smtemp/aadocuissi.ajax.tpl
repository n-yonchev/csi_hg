{include file="_ajax.header.tpl"}
{if $EDIT==0}
	{assign var='_title' value='въведи нов тип'}
{else}
	{assign var='_title' value='корегирай тип ИССИ'}
{/if}
{include file="_window.header.tpl" TITLE=$_title}
{include file="_erform.tpl"}

<br>
Тип на документа спрямо ИССИ
<br>
<select name="id_doc_sub_category">
{foreach from=$ISSI_CAT item=cat_elem key=cat_ekey}
	{if !empty($ISSI_SUB_CAT_GROUPED[$cat_elem.id])}
		<optgroup label="{$cat_elem.name}">
		{foreach from=$ISSI_SUB_CAT_GROUPED[$cat_elem.id] item=elem key=ekey}
			<option {if $smarty.post.id_doc_sub_category == $elem.id}selected{/if} value="{$elem.id}">{$elem.name}</option>
		{/foreach}
		</optgroup>
	{/if}
{/foreach}
</select>
	{*
<input type="checkbox" name="iscrea" id="iscrea" label="за образуване на дело">
*}

<br>
<br>
{include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
