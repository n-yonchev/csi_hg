<style>
    {*
    .head {ldelim}font: normal 16pt verdana;{rdelim}
    .text {ldelim}font: normal 12pt verdana;{rdelim}
    .cont {ldelim}font: bold 12pt verdana; padding-left: 20px;{rdelim}
    *}
    .head {
        ldelim} font: normal 10pt verdana;
    {rdelim
    }

    .text {
        ldelim} font: normal 8pt verdana;
        margin-top: 8px;
    {rdelim
    }

    .cont {
        ldelim} font: bold 8pt verdana;
        padding: 4px;
        letter-spacing: 4pt;
        border: 1px solid black;
    {rdelim
    }

    {***
    .head {ldelim}font: normal 22px verdana;{rdelim}
    .text {ldelim}font: normal 18px verdana; margin-top:8px;{rdelim}
    .cont {ldelim}font: bold 18px verdana; padding:4px; letter-spacing:8px; border:1px solid black;{rdelim}
    ***}
</style>

{*
				<div style="height:120mm;vertical-align:middle;display:inline-block;">
*}
<div style="height:120mm;">
    <table height=100%>
        <tr>
            <td>
                <div class="text" align=right>
                    изп.дело <b>{$ROCASE.serial}/{$ROCASE.year}</b>
                    &nbsp;&nbsp;
                    деловодител <b>{$ROCASEUSER.name}</b>
                </div>
                {*
                <center>
                <div class="head"> ПОСТЪПЛЕНИЕ </div>
                <div class="text"> {$ARTYPE[$ROFINA.idtype]} </div>
                </center>
                *}
                <div style="padding: 0px 0px 0px 10px; margin: 2px 0px 2px 80px;">
                    <div class="text">
                        ПРЕВОД {$ARTYPE[$ROFINA.idtype]}
                        <br>
                        {*
                        извлечение <b>{$ROBANK.idfinabank}</b>
                        от банка <b>{$ARBANK[$ROFIBA.codebank]}</b>
                        *}
                        {*
                        извлечение <b>{$ROBANK.idfinabank}/{$ARBANK[$ROFIBA.codebank]}</b>
                        създадено <b>{$ROFINA.time|date_format:'%d.%m.%Y %H:%M:%S'}</b> от <b>{$ROUSER.name}</b>
                        *}
                    </div>
                </div>
                {*
                <div style="border: 1px solid black; padding: 10px 10px 10px 10px; margin: 10px 0px 10px 80px;">
                *}
                <div style="padding: 10px 10px 10px 10px; margin: 10px 0px 10px 80px;">
                    <div class="text"> получател</div>
                    <div class="cont"> {$ROFINA.clainame} </div>
                    {*---- ----*}
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="text"> IBAN на получателя</div>
                                <div class="cont"> {$ROFINA.iban} </div>
                            <td width=20>
                            <td>
                                <div class="text"> BIC на получателя</div>
                                <div class="cont"> {$ROFINA.bic} </div>
                    </table>
                    <div class="text"> банка на наредителя</div>
                    <div class="cont"> {$ROFINA.bankname} </div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="text"> сума</div>
                                <div class="cont"> {$ROFINA.amount|tomoney2} </div>
                            <td width=20>
                            <td>
                                <div class="text"> време</div>
                                <div class="cont"> {$ROFINA.statmodi} </div>
                    </table>
                    {*
                    <div class="text"> описание </div>
                    <div class="cont"> {$ROFINA.descrip} </div>
                    *}

                    <div class="text"> основание</div>
                    <div class="cont"> {$ROFINA.text} </div>

                    {*----
                    <div class="text"> референция </div>
                    <div class="cont"> {$ROBANK.reference} </div>
                    ----*}
                    {***
                                    <table>
                                    <tr>
                                    <td>
                    <div class="text"> извлечение </div>
                    <div class="cont" style="letter-spacing:1px"> {$ROBANK.idfinabank} </div>
                                    <td width=20>
                                    <td>
                    <div class="text"> създадено </div>
                    <div class="cont" style="letter-spacing:1px"> {$ROFINA.time|date_format:'%d.%m.%Y %H:%M:%S'} от {$ROUSER.name} </div>
                                    </table>
                    ***}
                    {*
                            {if isset($ROBANK)}
                    <br>
                    <div class="text"> информация от извлечение № <b>{$ROBANK.idfinabank}</b> </div>
                    <br>
                    <div class="text"> време </div>
                    <div class="cont"> {$ROBANK.date} {$ROBANK.hour} </div>
                    <div class="text"> референция </div>
                    <div class="cont"> {$ROBANK.reference} </div>
                            {else}
                            {/if}
                    *}

                </div>
    </table>
</div>
{if $FIRST==1}
    <br>
    <hr>
    <br>
{elseif $FIRST==2}
    <br style="page-break-after: always;">
{else}
{/if}
