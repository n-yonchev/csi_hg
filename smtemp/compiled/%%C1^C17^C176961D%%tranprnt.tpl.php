<?php /* Smarty version 2.6.9, created on 2020-03-27 15:51:20
         compiled from tranprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'tranprnt.tpl', 82, false),)), $this); ?>
<style>
        .head { font: normal 10pt verdana;
    }

    .text { font: normal 8pt verdana;
        margin-top: 8px;
    }

    .cont { font: bold 8pt verdana;
        padding: 4px;
        letter-spacing: 4pt;
        border: 1px solid black;
    }

    </style>

<div style="height:120mm;">
    <table height=100%>
        <tr>
            <td>
                <div class="text" align=right>
                    изп.дело <b><?php echo $this->_tpl_vars['ROCASE']['serial']; ?>
/<?php echo $this->_tpl_vars['ROCASE']['year']; ?>
</b>
                    &nbsp;&nbsp;
                    деловодител <b><?php echo $this->_tpl_vars['ROCASEUSER']['name']; ?>
</b>
                </div>
                                <div style="padding: 0px 0px 0px 10px; margin: 2px 0px 2px 80px;">
                    <div class="text">
                        ПРЕВОД <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['ROFINA']['idtype']]; ?>

                        <br>
                                                                    </div>
                </div>
                                <div style="padding: 10px 10px 10px 10px; margin: 10px 0px 10px 80px;">
                    <div class="text"> получател</div>
                    <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['clainame']; ?>
 </div>
                                        <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="text"> IBAN на получателя</div>
                                <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['iban']; ?>
 </div>
                            <td width=20>
                            <td>
                                <div class="text"> BIC на получателя</div>
                                <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['bic']; ?>
 </div>
                    </table>
                    <div class="text"> банка на наредителя</div>
                    <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['bankname']; ?>
 </div>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td>
                                <div class="text"> сума</div>
                                <div class="cont"> <?php echo ((is_array($_tmp=$this->_tpl_vars['ROFINA']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </div>
                            <td width=20>
                            <td>
                                <div class="text"> време</div>
                                <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['statmodi']; ?>
 </div>
                    </table>
                    
                    <div class="text"> основание</div>
                    <div class="cont"> <?php echo $this->_tpl_vars['ROFINA']['text']; ?>
 </div>

                                                            
                </div>
    </table>
</div>
<?php if ($this->_tpl_vars['FIRST'] == 1): ?>
    <br>
    <hr>
    <br>
<?php elseif ($this->_tpl_vars['FIRST'] == 2): ?>
    <br style="page-break-after: always;">
<?php else: ?>
<?php endif; ?>