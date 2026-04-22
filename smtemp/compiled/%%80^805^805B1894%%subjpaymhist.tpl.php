<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:44
         compiled from subjpaymhist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'subjpaymhist.tpl', 29, false),array('modifier', 'tomoney2', 'subjpaymhist.tpl', 35, false),array('modifier', 'tomoney', 'subjpaymhist.tpl', 91, false),)), $this); ?>
<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>	
<thead>
<tr>
<td class='d_table_title' colspan='200'>финансова история</td>
</tr>
</thead>
<tr class='header'>
<td> дата
<td class='sep'>&nbsp;</td>
<td> събитие
<td class='sep'>&nbsp;</td>
<td> промяна главница
<td class='sep'>&nbsp;</td>
<td> промяна лихва
<td class='sep'>&nbsp;</td>
<td> текуща главница
<td class='sep'>&nbsp;</td>
<td> общо лихвa
</tr>
		<?php $_from = $this->_tpl_vars['ARHIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr valign=top  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
											<?php $this->assign('myclas', 'contbott'); ?>
					<?php if ($this->_tpl_vars['elem']['flag'] == 'a'): ?>
						<?php $this->assign('myclas', 'contregu'); ?>
					<?php else: ?>
					<?php endif; ?>
											<?php $this->assign('mydate', ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
					<?php if ($this->_tpl_vars['elem']['flag'] == 'b'): ?>
						<?php $this->assign('mydate', "&nbsp;"); ?>
					<?php else: ?>
					<?php endif; ?>
											<?php $this->assign('myresuinte', ((is_array($_tmp=$this->_tpl_vars['elem']['resuinte'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
					<?php if ($this->_tpl_vars['elem']['flag'] == 'c'): ?>
						<?php $this->assign('myresuinte', "&nbsp;"); ?>
																<?php $this->assign('mydate', "&nbsp;"); ?>
					<?php else: ?>
					<?php endif; ?>
											<?php $this->assign('myclasinte', 'contbott'); ?>
					<?php if ($this->_tpl_vars['elem']['open'] == 'yes'): ?>
						<?php $this->assign('myclasinte', 'pagilink'); ?>
					<?php else: ?>
					<?php endif; ?>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
"> <?php echo $this->_tpl_vars['mydate']; ?>
			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
"> <?php echo $this->_tpl_vars['elem']['text']; ?>
			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['capi'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inte'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

						<?php else: ?>			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclasinte']; ?>
" onclick="opinte('inte<?php echo $this->_tpl_vars['ekey']; ?>
');"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inte'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

						<?php endif; ?>
											<?php $this->assign('capist', ""); ?>
					<?php if ($this->_tpl_vars['elem']['resucapi'] < 0): ?>
						<?php $this->assign('capist', "style='background-color:#ff6666'"); ?>
					<?php else: ?>
					<?php endif; ?>
						<?php $this->assign('intest', ""); ?>
					<?php if ($this->_tpl_vars['elem']['resuinte'] < 0): ?>
						<?php $this->assign('intest', "style='background-color:#ff6666'"); ?>
					<?php else: ?>
					<?php endif; ?>			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
" <?php echo $this->_tpl_vars['capist']; ?>
> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['resucapi'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
			
		<td class='sep'>&nbsp;</td>
			<td class="<?php echo $this->_tpl_vars['myclas']; ?>
" <?php echo $this->_tpl_vars['intest']; ?>
> <?php echo $this->_tpl_vars['myresuinte']; ?>

	
<?php $this->assign('peri', $this->_tpl_vars['elem']['listperi']); ?>
			<tr valign=top>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
							<?php if (count ( $this->_tpl_vars['peri']['list'] ) == 0): ?>
							<?php else: ?>
			<td><td>
			<td style="border: 1px solid black" colspan=20>
							<?php endif; ?>
						<?php else: ?>
			<td id="inte<?php echo $this->_tpl_vars['ekey']; ?>
" style="display: none; background-color: #aaffaa" colspan=20>
						<?php endif; ?>
						<?php if (count ( $this->_tpl_vars['peri']['list'] ) == 0): ?>
						<?php else: ?>
<center>
олихвяване на сума <b><?php echo ((is_array($_tmp=$this->_tpl_vars['peri']['descrip'][2])) ? $this->_run_mod_handler('tomoney', true, $_tmp) : smarty_modifier_tomoney($_tmp)); ?>
</b>  
от <b><?php echo ((is_array($_tmp=$this->_tpl_vars['peri']['descrip'][0])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b> до <b><?php echo ((is_array($_tmp=$this->_tpl_vars['peri']['descrip'][1])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
</center>
	<table class="caseperc" align=center>
	<tr>
	<th> начало
	<th> край
	<th> дни
	<th> ОЛП
	<th> ЗЛ
	<th> днев%
	<th> лихва
<?php $_from = $this->_tpl_vars['peri']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['perielem']):
?>
	<tr>
	<td> <?php echo $this->_tpl_vars['perielem']['d1']; ?>

	<td> <?php echo $this->_tpl_vars['perielem']['d2']; ?>

	<td> <?php echo $this->_tpl_vars['perielem']['days']; ?>

	<td> <?php echo $this->_tpl_vars['perielem']['bnb']; ?>

	<td> <?php echo $this->_tpl_vars['perielem']['zakono']; ?>

	<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['perielem']['dnevna'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 6) : smarty_modifier_tomoney($_tmp, 6)); ?>

	<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['perielem']['result'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

<?php endforeach; endif; unset($_from); ?>		
</table>
						<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			
				<tr valign=top>
			<td class="contright" colspan=4> текущ дълг
			<td class="contright" colspan=2> <?php echo ((is_array($_tmp=$this->_tpl_vars['TOTALAMO'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

			
			</table>

<script>
function opinte(p1){
	var o1= document.getElementById(p1);
	var newdis= (o1.style.display=="none") ? "" : "none";
	o1.style.display= newdis;
	resizeNyroModalIframe();
}
</script>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<iframe id="fraint" width=1 height=1 style="visibility:hidden">
</iframe>
<script>
function fuprin(p1){
	var op= document.getElementById("fraint").src= p1;
}
</script>
						<?php endif; ?>
