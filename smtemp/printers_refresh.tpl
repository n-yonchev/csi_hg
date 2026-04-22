{if $REFRESH_MESSAGE}
    <div style="display: flex; justify-content: center;">
        <div style="
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px 20px;
            margin: 20px 0;"
        >
            {$REFRESH_MESSAGE}
        </div>
    </div>
{/if}
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100>QR принтери</td>
        </tr>
	</thead>
	<tbody>
        {foreach from=$PRINTERS item="value" key="key"}
            <tr>
                <td style="font-size: 14px; padding: 5px 10px;">{$value.name}</td>
                <td>
                    {include file='_button.tpl' HREF=$value.refresh_url TITLE='изчисти опашката'}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>