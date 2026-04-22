{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE='Внимание'}
{include file="_erform.tpl"}

Документ,
<br />
<table class="table-info">
    <tr>
        <td>входящ номер / година</td>
        <td>{$DOCU.serial} / {$DOCU.year}</td>
    </tr>
    <tr>
        <td>входиран на</td>
        <td>{$DOCU.created}</td>
    </tr>
    <tr>
        <td>от</td>
        <td>{$DOCU.from}</td>
    </tr>
    <tr>
        <td>описание на документа</td>
        <td>{$DOCU.text}</td>
    </tr>
</table>

<br /><br />

Следният документ ще бъде маркиран като
{if $ACTION == 'done'}<span class="done">ИЗПЪЛНЕН</span>{else}<span class="discard">НЕ ЗА ИЗПЪЛНЕНИЕ</span>{/if}

<br />
<br />
коментар
<br>
<textarea name="comment" id="comment" rows=3 cols=60></textarea>
<br>
<span class="desc">Пример: изходящ документ номер, причина за отхвърляне и т.н.</span>
<br>
<br>
{include file='_but2.tpl' TYPE='submit' TITLE='продължи' NAME='submyes' ID='submyes'}
&nbsp;&nbsp;
{include file='_but2.tpl' TYPE='submit' TITLE='отказ' NAME='submno' ID='submno'}

<style>
{literal}
.table-info tr td:first-child {
    text-align: right;
    border-right: 1px solid #99bbe8;
    font-weight: normal;
}
.table-info tr td {
    padding: 3px ;
    border-bottom: 1px solid #99bbe8;
    font-weight: bold;
}

.done {
    color: #008000;
    font-weight: bold;
}

.discard {
    color: #8B0000;
    font-weight: bold;
}


.desc {
    font-size: 10px;
    color: #808080;
}
{/literal}
</style>

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
