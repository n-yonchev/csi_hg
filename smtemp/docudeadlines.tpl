<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>

    <thead>

    <tr>
        <td class='d_table_title' colspan='200'>списък срокове за отговор на входящи документи</td>
    </tr>

    <tr>
        <td class='d_table_title' colspan="200" style="padding: 10px;">
            {foreach from=$LINKS key=linkname item=link}
                <a class="{if $TYPE==$linkname}culink{else}link{/if}"
                   onclick="document.location.href='{$link.url}'; return false;">{$link.name}</a>
                &nbsp;
            {/foreach}
        </td>
    </tr>
    </thead>
    <tr class='header'>
        <td></td>
        <td class='sep'>&nbsp;</td>
        <td><span> вх.номер </span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> кога </span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> към дело</span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> деловодител</span></td>
        <td class='sep'>&nbsp;</td>


        {if $TYPE == 'done'}
            <td><span style="font-weight: bold"> изпълнено на </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> от </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> коментар </span></td>
            <td class='sep'>&nbsp;</td>
        {elseif $TYPE == 'discard'}
            <td><span style="font-weight: bold"> отхвърлено на </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> от </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> коментар </span></td>
            <td class='sep'>&nbsp;</td>
        {else}
            <td><span style="font-weight: bold"> оставащи дни </span></td>
            <td class='sep'>&nbsp;</td>
        {/if}

        <td><span> описание</span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> подател</span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> бележки</span></td>
        <td class='sep'>&nbsp;</td>
        <td><span> въвел </span></td>
        <td class='sep'>&nbsp;</td>
        <td>образ</td>
        <td class='sep'>&nbsp;</td>
        <td></td>
    </tr>
    <tbody>
    {foreach from=$LIST item=elem key=ekey}
        {*----
            <tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
        ----*}
        <tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";'
            onclick="trclic(this);">
            {if $TYPE == 'active' || $TYPE == 'expired'}
                <td class="decision-wrapper">
                    <a href="{$elem.linkdone}" class="decision decision-green nyroModal" target="_blank">
                        <i class="fas fa-check"></i> <span class="decision-info"><i
                                    class="fas fa-check"></i> изпълни</span>
                    </a>
                </td>
            {else}
                <td>&nbsp;</td>
            {/if}
            <td class='sep'>&nbsp;</td>
            <td align=right> {$elem.serial}/{$elem.year}</td>
            <td class='sep'>&nbsp;</td>
            <td> {$elem.created|date_format:"%d.%m.%Y"}
            {*<td class='sep'>&nbsp;</td>*}
            {include file="_docucase.tpl"}
            <td class='sep'>&nbsp;</td>
            {if $TYPE == 'done' || $TYPE == 'discard'}
                <td align="center"> {$elem.date}</td>
                <td class='sep'>&nbsp;</td>
                <td align="center"> {$elem.ddu_name}</td>
                <td class='sep'>&nbsp;</td>
                <td align="left"> {$elem.dd_comment}</td>
                <td class='sep'>&nbsp;</td>
            {else}
                <td align="center" style="font-size: 12px; font-weight: bold"> {$elem.remaining_days}</td>
                <td class='sep'>&nbsp;</td>
            {/if}

            <td> {$elem.text}</td>
            <td class='sep'>&nbsp;</td>
            <td> {$elem.from}</td>
            <td class='sep'>&nbsp;</td>
            {*----
            <td> {$elem.notes|replace:";":"; "}
            ----*}
            <td align=center>
                {if empty($elem.notes)}
                    &nbsp;
                {else}
                    <img src="images/view.png" title='{$elem.notes|replace:";":"; "|replace:",":", "}'>
                {/if}
            <td class='sep'>&nbsp;</td>
            <td> {$elem.u2name} </td>

            <td class='sep'>&nbsp;</td>
            <td align=left>
                {assign var=iddocu value=$elem.id}
                {assign var=scancoun value=$ARSCANCOUN[$iddocu]}
                {if $scancoun==0}
                    &nbsp;
                {else}
                    <img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение"
                         onclick="w2=window.open('{$elem.scanview}','win2');w2.focus();">
                    {if $scancoun==1}
                    {else}
                        <sup>{$ARSCANCOUN[$iddocu]}</sup>
                    {/if}
                {/if}
            </td>
            <td class="sep"></td>
            {if $TYPE == 'active' || $TYPE == 'expired'}
                <td class="decision-wrapper">
                    <a href="{$elem.linkdiscard}" class="decision decision-red nyroModal" target="_blank">
                        <i class="fas fa-times"></i> <span class="decision-info"><i
                                    class="fas fa-times"></i> отхвърли</span>
                    </a>
                </td>
            {else}
                <td>&nbsp;</td>
            {/if}
        </tr>
    {/foreach}
    </tbody>

    {include file="_pagina.tr.tpl"}

</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css"/>
<script type="text/javascript">
    {literal}
    $(document).ready(function () {
        $('.caselist').cluetip({width: 240, local: true, cursor: 'pointer'});
    });
    var trcurr;

    function trclic(obje) {
        if (trcurr) {
            trcurr.className = "";
        } else {

        }

        obje.className = "trdocu";
        trcurr = obje;
    }

    {/literal}
</script>

{* include file='_frame.footer.tpl' *}
{ *include file="_pagina.tpl" *}

<style>
    {
        literal
    }
    .decision-wrapper {
        padding: 0px !important;
    }

    .decision {
        /*padding: 5px 5px;*/
        /*height: 30px;*/
        padding: 0px;
        height: 22px;
        width: 90px;
        display: block;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .decision-info {
        display: inline-block;
        text-align: center;
        position: absolute;
        right: -200px;
        top: 4px;
        left: 0;
        font-weight: bold;
    }

    .decision:hover > a {
        color: #ffffff;
    }

    .decision > i {
        margin-top: 4px;
    }

    .decision:hover > i {
        display: none;
    }

    .decision:hover .decision-info {
        transition: 0.15s;
        right: 0px;
    }

    .decision-green {
        color: #008000;
    }

    .decision-green:hover {
        background-color: #008000;
        color: #ffffff;
    }

    .decision-red {
        color: #8B0000;
    }

    .decision-red:hover {
        background-color: #8B0000;
        color: #ffffff;
    }

    .link {
        font: normal 8pt verdana;
        cursor: pointer;
        border-bottom: 1px solid black;
    }

    .culink {
        font: normal 8pt verdana;
        cursor: pointer;
        padding: 1px 6px;
        border-bottom: 1px solid brown;
        color: brown;
        background-color: khaki;
    }

    .poin {
        cursor: pointer;
    }

    {/literal}
</style>