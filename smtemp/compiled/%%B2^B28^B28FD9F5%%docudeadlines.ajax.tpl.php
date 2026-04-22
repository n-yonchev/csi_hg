<?php /* Smarty version 2.6.9, created on 2020-10-05 16:14:43
         compiled from docudeadlines.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => 'Внимание')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

Документ,
<br />
<table class="table-info">
    <tr>
        <td>входящ номер / година</td>
        <td><?php echo $this->_tpl_vars['DOCU']['serial']; ?>
 / <?php echo $this->_tpl_vars['DOCU']['year']; ?>
</td>
    </tr>
    <tr>
        <td>входиран на</td>
        <td><?php echo $this->_tpl_vars['DOCU']['created']; ?>
</td>
    </tr>
    <tr>
        <td>от</td>
        <td><?php echo $this->_tpl_vars['DOCU']['from']; ?>
</td>
    </tr>
    <tr>
        <td>описание на документа</td>
        <td><?php echo $this->_tpl_vars['DOCU']['text']; ?>
</td>
    </tr>
</table>

<br /><br />

Следният документ ще бъде маркиран като
<?php if ($this->_tpl_vars['ACTION'] == 'done'): ?><span class="done">ИЗПЪЛНЕН</span><?php else: ?><span class="discard">НЕ ЗА ИЗПЪЛНЕНИЕ</span><?php endif; ?>

<br />
<br />
коментар
<br>
<textarea name="comment" id="comment" rows=3 cols=60></textarea>
<br>
<span class="desc">Пример: изходящ документ номер, причина за отхвърляне и т.н.</span>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'продължи','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'отказ','NAME' => 'submno','ID' => 'submno')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<style>
<?php echo '
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
'; ?>

</style>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>