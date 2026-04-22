{literal}
    <style>
        .d_table {
            border: none;
        }

        .select-type {
            border: 1px solid #9698a5;
        }

        .button-container {
            text-align: center;
            margin-top: 10px;
        }

        .subject-row {
            padding: 3px 0;
        }
    </style>
{/literal}
<form method="POST" action="{$FORM_URL}">
    <table class="d_table" cellspacing='0' cellpadding='0' align=center>
        <thead>
            <tr>
                <td class='d_table_title' colspan='200'>Уеднаквяване на типовете на предмета на изпълнение</td>
            </tr>
        </thead>
        <tr class='header'>
            <td> 
                име на типа в системата ЕПЕП
            </td>
            <td style="padding-left: 15px">
                тип на предмета на изпълнение
            </td>
        </tr>
        <tbody>
            {foreach from=$TYPES item=item key=key}
                <tr>
                    <td class="subject-row">{$item.epep_name}</td>
                    <td style="padding-left: 15px" class="subject-row">
                        <select class="select-type" name="subject[{$item.id}]">
                            {foreach from=$SUBJECT_TYPES item=s_item key=s_key}
                                <option value="{$s_key}" {if $s_key == $item.type}selected{/if}>{$s_item}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <div class="button-container">
        {include file='_button.tpl' TYPE='submit' TITLE='запиши' NAME='submit' ID='submit'}
    </div>
</form>