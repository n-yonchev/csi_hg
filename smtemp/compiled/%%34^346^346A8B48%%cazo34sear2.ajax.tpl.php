<?php /* Smarty version 2.6.9, created on 2020-03-04 09:13:26
         compiled from cazo34sear2.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazo34sear2.ajax.tpl', 20, false),array('modifier', 'nl2br', 'cazo34sear2.ajax.tpl', 37, false),)), $this); ?>
		<?php if (count ( $this->_tpl_vars['DATA'] ) == 0): ?>
няма физически лица с "<?php echo $this->_tpl_vars['CODECONT']; ?>
" в ЕГН
		<?php else: ?>
	<table class="caseview" align=center>
	<tr>
	<td colspan=10>
намерени физически лица с "<?php echo $this->_tpl_vars['CODECONT']; ?>
" в ЕГН (или на съпруга)
	<tr>
	<th class="cont"> егн
	<th class="cont"> име
	<th class="cont"> представител
	<th class="cont"> роля
	<th class="cont"> съпруг
	<th class="cont"> егн
			
			<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
				<?php $this->assign('myid', ((is_array($_tmp=$this->_tpl_vars['elem']['role'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['id']))); ?>
	<tr class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="допълнителна информация" 
	onmouseover="this.style.color='red';this.style.cursor='pointer';" onmouseout="this.style.color='black';"
	onclick="copycont('<?php echo $this->_tpl_vars['myid']; ?>
');">
	<td class="contleft"> <?php echo $this->_tpl_vars['elem']['egn']; ?>

	<td class="contleft"> <?php echo $this->_tpl_vars['elem']['name']; ?>

	<td class="contleft"> <?php echo $this->_tpl_vars['elem']['agent']; ?>

	<td class="contleft"> <?php if ($this->_tpl_vars['elem']['role'] == 'c'): ?>взиск<?php else: ?>длъж<?php endif; ?>
	<td class="contleft"> <?php echo $this->_tpl_vars['elem']['name2']; ?>

	<td class="contleft"> <?php echo $this->_tpl_vars['elem']['egn2']; ?>


<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
адреси : <br>
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['address'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</b>
</span>
<span style="display: none">
	<?php $_from = $this->_tpl_vars['FILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fielem']):
?>
<span id="<?php echo $this->_tpl_vars['myid']; ?>
_<?php echo $this->_tpl_vars['fielem']; ?>
"><?php echo $this->_tpl_vars['elem'][$this->_tpl_vars['fielem']]; ?>
</span>
	<?php endforeach; endif; unset($_from); ?>
</span>
			<?php endforeach; endif; unset($_from); ?>
	</table>
		<?php endif; ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
	$('tr.ttip').cluetip({ width: 330, local:true, cursor:'pointer' });
</script>

<script type="text/javascript">
function copycont(paid){
	var indx,fina;
	<?php $_from = $this->_tpl_vars['FILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fielem']):
?>
		document.forms[0].elements['<?php echo $this->_tpl_vars['fielem']; ?>
'].value= document.getElementById(paid+'_'+'<?php echo $this->_tpl_vars['fielem']; ?>
').innerHTML;
//alert("copy=<?php echo $this->_tpl_vars['fielem']; ?>
");
	<?php endforeach; endif; unset($_from); ?>
}
</script>