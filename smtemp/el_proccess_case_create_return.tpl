{assign var="myheadcode" value="
<script type='text/javascript' src='autocomp/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='autocomp/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='autocomp/thickbox-compressed.js'></script>
<script type='text/javascript' src='autocomp/jquery.autocomplete.js'></script>
<link rel='stylesheet' type='text/css' href='autocomp/jquery.autocomplete.css' />
<link rel='stylesheet' type='text/css' href='autocomp/thickbox.css' />
<script type='text/javascript' src='js/_docuedit.js'></script>
"}

{literal}
<style>
    .error {
        background-color: #fc796d;
        border: 2px solid #ff0d00;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .success {
        background-color: #a5fc77;
        border: 2px solid #5eff00;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .link-back {
        color: blue; 
        text-decoration:underline; 
        cursor: pointer;
    }

    .link-back:hover {
        text-decoration:none;
    }

</style>
{/literal}

{include file="_ajax.header.tpl"}

{assign var="_title" value='отговор на образуваните дела с ел партида'}

{include file='_window.header.tpl' TITLE=$_title TABS=$TABS}

<table>
    {foreach from=$KEY_MESSAGES item=msg}
        <tr>
            <td>
                <div class="{$msg.type}">{$msg.message}</div>
            </td>
        </tr>
    {/foreach}

    <tr>
        <td style="text-align: center; padding-top: 20px; padding-bottom: 10px">
            <span class="link-back" onclick='document.location.href="{$BACK_URL}"'>< образуване дела с ел. партида</span>
        </td>
    </tr>
</table>



{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}