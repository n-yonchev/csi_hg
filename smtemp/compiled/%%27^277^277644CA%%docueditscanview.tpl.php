<?php /* Smarty version 2.6.9, created on 2020-02-28 13:19:49
         compiled from docueditscanview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'docueditscanview.tpl', 28, false),array('modifier', 'date_format', 'docueditscanview.tpl', 30, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_base.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.gene {font:normal 10pt verdana;}
.link {background-color:#dddddd;cursor:pointer;padding-left:10px;padding-right:10px;}
.mark {background-color:khaki;}
</style>

<center class="gene">
<?php if ($this->_tpl_vars['ISDOCUOUT']): ?>ИЗХОДЯЩ<?php else: ?>входящ<?php endif; ?> документ <b><?php echo $this->_tpl_vars['RODATA']['docuseri']; ?>
/<?php echo $this->_tpl_vars['RODATA']['docuyear']; ?>
</b> 
				<?php if ($this->_tpl_vars['COUNCASE'] == 1): ?>
&nbsp;&nbsp;&nbsp;
по изп.дело <b><?php echo $this->_tpl_vars['RODATA']['caseseri']; ?>
/<?php echo $this->_tpl_vars['RODATA']['caseyear']; ?>
</b>  
&nbsp;&nbsp;&nbsp;
деловодител <b><?php echo $this->_tpl_vars['RODATA']['username']; ?>
</b>
				<?php else: ?>
по <b><?php echo $this->_tpl_vars['COUNCASE']; ?>
 броя</b> дела 
				<?php endif; ?>
							<?php if (count ( $this->_tpl_vars['ARSCAN'] ) == 0): ?>
<br>
<br>
няма сканирани изображения
							<?php else: ?>
								<?php if (count ( $this->_tpl_vars['ARSCAN'] ) == 1): ?>
								<?php else: ?>
<br>
разгледай сканирано изображение &nbsp;&nbsp;&nbsp;
<?php $_from = $this->_tpl_vars['ARSCAN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indx'] => $this->_tpl_vars['elem']):
?>
			<?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['indx'],'b' => 1,'assign' => 'cuindx'), $this);?>

	<a class="link <?php if ($this->_tpl_vars['indx'] == $this->_tpl_vars['CUINDX']): ?>mark<?php else:  endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	title="качен от <?php echo $this->_tpl_vars['elem']['username']; ?>
 на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>
">
	<?php echo $this->_tpl_vars['cuindx']; ?>
</a> &nbsp;
<?php endforeach; endif; unset($_from); ?>
								<?php endif; ?>
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="dele('<?php echo $this->_tpl_vars['LINKDELE']; ?>
'); return false;"><img src="images/free.gif" title="изтрий текущото изображение"></a>
<br>
			<?php if (isset ( $this->_tpl_vars['NOVIEWTYPE'] )): ?>
<br>
тип на файла <font size=+1><?php echo $this->_tpl_vars['NOVIEWTYPE']; ?>
</font> не може да сe изобрази
			<?php else: ?>
<iframe id="framscan" src="docuedits2.ajax.php?p1=<?php echo $this->_tpl_vars['IDDOCU']; ?>
&p2=<?php echo $this->_tpl_vars['CUINDX'];  if ($this->_tpl_vars['ISDOCUOUT']): ?>&p3=1<?php else:  endif; ?>" width=900 height=1300 frameborder=1></iframe>
			<?php endif; ?>
							<?php endif; ?>
</center>

<script>
				<?php if (isset ( $this->_tpl_vars['ISRELO'] )): ?>
$(document).ready(function() {
					<?php if ($this->_tpl_vars['ISINCASE']): ?>
	window.opener.$('#<?php echo $this->_tpl_vars['ZOSCAN']; ?>
').click();
					<?php else: ?>
	window.opener.document.location.reload();
					<?php endif; ?>
});
				<?php else: ?>
				<?php endif; ?>
function dele(link){
	if(confirm('потвърди изтриването на текущото изображение')) window.location.href=link;
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_base.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>