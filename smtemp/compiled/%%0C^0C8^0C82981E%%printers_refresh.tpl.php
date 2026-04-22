<?php /* Smarty version 2.6.9, created on 2025-06-26 11:45:34
         compiled from printers_refresh.tpl */ ?>
<?php if ($this->_tpl_vars['REFRESH_MESSAGE']): ?>
    <div style="display: flex; justify-content: center;">
        <div style="
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px 20px;
            margin: 20px 0;"
        >
            <?php echo $this->_tpl_vars['REFRESH_MESSAGE']; ?>

        </div>
    </div>
<?php endif; ?>
<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
	<thead>
		<tr>
			<td class='d_table_title' colspan=100>QR принтери</td>
        </tr>
	</thead>
	<tbody>
        <?php $_from = $this->_tpl_vars['PRINTERS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
            <tr>
                <td style="font-size: 14px; padding: 5px 10px;"><?php echo $this->_tpl_vars['value']['name']; ?>
</td>
                <td>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => $this->_tpl_vars['value']['refresh_url'],'TITLE' => 'изчисти опашката')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </tbody>
</table>