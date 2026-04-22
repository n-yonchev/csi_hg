
</div>
    {if $LOG.request_success}
        {if $LOG.data_success}
            {$LOG.success_message|truncate:3000:"...":true}
        {else}
            {$LOG.error_message}
        {/if}
    {else}
        Неуспешно изпълнена заявка.
    {/if}
</div>
