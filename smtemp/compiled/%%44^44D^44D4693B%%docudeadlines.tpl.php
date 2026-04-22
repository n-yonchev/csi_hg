<?php /* Smarty version 2.6.9, created on 2020-10-06 10:52:58
         compiled from docudeadlines.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'docudeadlines.tpl', 83, false),array('modifier', 'replace', 'docudeadlines.tpl', 110, false),)), $this); ?>
<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>

    <thead>

    <tr>
        <td class='d_table_title' colspan='200'>списък срокове за отговор на входящи документи</td>
    </tr>

    <tr>
        <td class='d_table_title' colspan="200" style="padding: 10px;">
            <?php $_from = $this->_tpl_vars['LINKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['linkname'] => $this->_tpl_vars['link']):
?>
                <a class="<?php if ($this->_tpl_vars['TYPE'] == $this->_tpl_vars['linkname']): ?>culink<?php else: ?>link<?php endif; ?>"
                   onclick="document.location.href='<?php echo $this->_tpl_vars['link']['url']; ?>
'; return false;"><?php echo $this->_tpl_vars['link']['name']; ?>
</a>
                &nbsp;
            <?php endforeach; endif; unset($_from); ?>
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


        <?php if ($this->_tpl_vars['TYPE'] == 'done'): ?>
            <td><span style="font-weight: bold"> изпълнено на </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> от </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> коментар </span></td>
            <td class='sep'>&nbsp;</td>
        <?php elseif ($this->_tpl_vars['TYPE'] == 'discard'): ?>
            <td><span style="font-weight: bold"> отхвърлено на </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> от </span></td>
            <td class='sep'>&nbsp;</td>
            <td><span style="font-weight: bold"> коментар </span></td>
            <td class='sep'>&nbsp;</td>
        <?php else: ?>
            <td><span style="font-weight: bold"> оставащи дни </span></td>
            <td class='sep'>&nbsp;</td>
        <?php endif; ?>

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
    <?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
                <tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";'
            onclick="trclic(this);">
            <?php if ($this->_tpl_vars['TYPE'] == 'active' || $this->_tpl_vars['TYPE'] == 'expired'): ?>
                <td class="decision-wrapper">
                    <a href="<?php echo $this->_tpl_vars['elem']['linkdone']; ?>
" class="decision decision-green nyroModal" target="_blank">
                        <i class="fas fa-check"></i> <span class="decision-info"><i
                                    class="fas fa-check"></i> изпълни</span>
                    </a>
                </td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
            <td class='sep'>&nbsp;</td>
            <td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>
            <td class='sep'>&nbsp;</td>
            <td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_docucase.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <td class='sep'>&nbsp;</td>
            <?php if ($this->_tpl_vars['TYPE'] == 'done' || $this->_tpl_vars['TYPE'] == 'discard'): ?>
                <td align="center"> <?php echo $this->_tpl_vars['elem']['date']; ?>
</td>
                <td class='sep'>&nbsp;</td>
                <td align="center"> <?php echo $this->_tpl_vars['elem']['ddu_name']; ?>
</td>
                <td class='sep'>&nbsp;</td>
                <td align="left"> <?php echo $this->_tpl_vars['elem']['dd_comment']; ?>
</td>
                <td class='sep'>&nbsp;</td>
            <?php else: ?>
                <td align="center" style="font-size: 12px; font-weight: bold"> <?php echo $this->_tpl_vars['elem']['remaining_days']; ?>
</td>
                <td class='sep'>&nbsp;</td>
            <?php endif; ?>

            <td> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
            <td class='sep'>&nbsp;</td>
            <td> <?php echo $this->_tpl_vars['elem']['from']; ?>
</td>
            <td class='sep'>&nbsp;</td>
                        <td align=center>
                <?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
                    &nbsp;
                <?php else: ?>
                    <img src="images/view.png" title='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
'>
                <?php endif; ?>
            <td class='sep'>&nbsp;</td>
            <td> <?php echo $this->_tpl_vars['elem']['u2name']; ?>
 </td>

            <td class='sep'>&nbsp;</td>
            <td align=left>
                <?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
                <?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
                <?php if ($this->_tpl_vars['scancoun'] == 0): ?>
                    &nbsp;
                <?php else: ?>
                    <img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение"
                         onclick="w2=window.open('<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
                    <?php if ($this->_tpl_vars['scancoun'] == 1): ?>
                    <?php else: ?>
                        <sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
            <td class="sep"></td>
            <?php if ($this->_tpl_vars['TYPE'] == 'active' || $this->_tpl_vars['TYPE'] == 'expired'): ?>
                <td class="decision-wrapper">
                    <a href="<?php echo $this->_tpl_vars['elem']['linkdiscard']; ?>
" class="decision decision-red nyroModal" target="_blank">
                        <i class="fas fa-times"></i> <span class="decision-info"><i
                                    class="fas fa-times"></i> отхвърли</span>
                    </a>
                </td>
            <?php else: ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
    </tbody>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css"/>
<script type="text/javascript">
    <?php echo '
    $(document).ready(function () {
        $(\'.caselist\').cluetip({width: 240, local: true, cursor: \'pointer\'});
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

    '; ?>

</script>


<style>
    <?php echo '
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

    '; ?>

</style>