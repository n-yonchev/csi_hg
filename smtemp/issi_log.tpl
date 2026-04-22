<table  class="d_table" cellspacing='0' cellpadding='0' align=center>
    <thead>
    <tr>
        <td class='d_table_title' colspan='200'>ИССИ логове</td>
    </tr>
    </thead>
    <tr class='header'>
        <td> дата на регистрите&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> успешно изпратена&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> успешно обработена&nbsp;</td>
        <td class='sep'>&nbsp;</td>
        <td> съобщение от ИССИ&nbsp;</td>
    </tr>

    {foreach from=$LIST item=element}
        <tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
    <td {if !$element.request_success || !$element.data_success}style="background-color: #fa6e61"{/if} align="center">{$element.data_date}</td>
            <td class='sep'>&nbsp;</td>
            <td align="center">
                {if $element.request_success}
                    да
                {else}
                    не
                {/if}
            </td>
            <td class='sep'>&nbsp;</td>
            <td align="center">
                {if $element.data_success}
                    да
                {else}
                    не
                {/if}
            </td>
            <td class='sep'>&nbsp;</td>
            <td {if ($element.success_message|strlen > 150) || ($element.error_message|strlen > 150)}class="deliinfo issi-message" rel="issilogmsg.ajax.php?log={$element.id}" title="Съобщение"{/if}>
                {if $element.request_success}
                    {if $element.data_success}
                        {$element.success_message|truncate:150:"...":true}
                    {else}
                        {$element.error_message|truncate:150:"...":true}
                    {/if}
                {else}
                    Неуспешно изпълнена заявка.
                {/if}
            </td>
        </tr>
    {/foreach}
    {include file="_pagina.tr.tpl"}
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script>
$(document).ready(function() {ldelim}
	$('.deliinfo').cluetip({ldelim} width: 660, cursor:'help' {rdelim});
{rdelim});
</script>