{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="друг деловодител на делото"}

<nobr>
		{if empty($OWNENAME)}
това дело няма назначен деловодител
		{else}
деловодител на това дело е <b>{$OWNENAME}</b>
		{/if}
</nobr>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
