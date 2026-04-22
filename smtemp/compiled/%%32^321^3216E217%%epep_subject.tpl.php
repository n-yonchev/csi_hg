<?php /* Smarty version 2.6.9, created on 2026-03-10 15:42:13
         compiled from epep_subject.tpl */ ?>
<?php echo '
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
'; ?>

<form method="POST" action="<?php echo $this->_tpl_vars['FORM_URL']; ?>
">
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
            <?php $_from = $this->_tpl_vars['TYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <tr>
                    <td class="subject-row"><?php echo $this->_tpl_vars['item']['epep_name']; ?>
</td>
                    <td style="padding-left: 15px" class="subject-row">
                        <select class="select-type" name="subject[<?php echo $this->_tpl_vars['item']['id']; ?>
]">
                            <?php $_from = $this->_tpl_vars['SUBJECT_TYPES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s_key'] => $this->_tpl_vars['s_item']):
?>
                                <option value="<?php echo $this->_tpl_vars['s_key']; ?>
" <?php if ($this->_tpl_vars['s_key'] == $this->_tpl_vars['item']['type']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['s_item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
    <div class="button-container">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</form>