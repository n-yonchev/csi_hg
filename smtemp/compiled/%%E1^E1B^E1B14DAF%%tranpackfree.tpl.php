<?php /* Smarty version 2.6.9, created on 2020-02-27 13:28:33
         compiled from tranpackfree.tpl */ ?>
<style>
.link {font:normal 8pt verdana;cursor:pointer;border-bottom: 1px solid black;}
.desc {font:normal 8pt verdana;}
</style>
									<table align=center>
									<tr>
									<td>
<a class="link" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['GOBACK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<?php echo $this->_tpl_vars['GOTEXT']; ?>
 </a>

<br>&nbsp;
<br>
<span  class="desc">
пакет <b><span style="background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['ROPACK']['idstat']]; ?>
">&nbsp;&nbsp; <?php echo $this->_tpl_vars['ROPACK']['id']; ?>
 &nbsp;&nbsp;</span></b>
<?php echo $this->_tpl_vars['ARPACKTEXT'][$this->_tpl_vars['ROPACK']['idstat']]; ?>
 <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['ROPACK']['idbank']];  if ($this->_tpl_vars['ROPACK']['code'] == $this->_tpl_vars['CODEBANKPOST']): ?>/бюджетен<?php else:  endif; ?>
</span>

<?php echo $this->_tpl_vars['C2VARI']; ?>

									</table>