<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazo6.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazo6.tpl', 152, false),)), $this); ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
изходящи документи
</div>
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t6link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['ADDNEWFILE']; ?>
" class="nyroModal" target="_blank">
<img src="images/up.gif" title="качи самостоятелен файл">
</a>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['DIREADD']; ?>
" class="nyroModal" target="_blank">
<img src="images/adda.gif" title="добави директно">
</a>
</div>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody id="myta">
		<tr class='header'>
<td> изх.номер </td>
			<td class='sep'>&nbsp;</td>
<td> създаден </td>
			<td class='sep'>&nbsp;</td>
<td> тип </td>
			<td class='sep'>&nbsp;</td>
<td> адресат </td>
			<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
				<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
				<?php else: ?>
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
			<td>&nbsp;</td>
				<?php endif; ?>
			<td class='sep'>&nbsp;</td>
<td>образ
			<td class='sep'>&nbsp;</td>
<td>връч
		</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
																		<?php if ($this->_tpl_vars['elem']['regigroup'] <> 0 && $this->_tpl_vars['elem']['serial'] == 0): ?>
																		<?php else: ?>
							<?php if ($this->_tpl_vars['elem']['regigroup'] == 0): ?>
									<?php $this->assign('bgco', ""); ?>
									<?php $this->assign('exta', ""); ?>
									<?php $this->assign('onic', ""); ?>
											<?php $this->assign('come', true); ?>
							<?php else: ?>
								<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
									<?php $this->assign('bgco', 'darkkhaki'); ?>
									<?php $this->assign('exta', ""); ?>
									<?php $this->assign('onic', "отвори"); ?>
											<?php $this->assign('come', false); ?>
								<?php else: ?>
									<?php $this->assign('bgco', ""); ?>
									<?php $this->assign('exta', ""); ?>
									<?php $this->assign('onic', ""); ?>
											<?php $this->assign('come', false); ?>
								<?php endif; ?>
							<?php endif; ?>
<tr class="myrow" bgcolor="<?php echo $this->_tpl_vars['bgco']; ?>
" <?php echo $this->_tpl_vars['exta']; ?>
 
											<?php if ($this->_tpl_vars['come']): ?>
oncontextmenu="$.nyroModalManual({url:'caseeditzone.php<?php echo $this->_tpl_vars['elem']['tocase']; ?>
',forceType:'iframe'});return false;"
											<?php else: ?>
oncontextmenu="return false;"
											<?php endif; ?>
>
										<?php $this->assign('grel', $this->_tpl_vars['GRLIST'][$this->_tpl_vars['elem']['regigroup']]); ?>
<td class="contleft"> 
					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
						<?php if (empty ( $this->_tpl_vars['grel'] )): ?>
	&nbsp;
						<?php else: ?>
	<?php echo $this->_tpl_vars['grel']['min']; ?>
-<?php echo $this->_tpl_vars['grel']['max']; ?>
/<?php echo $this->_tpl_vars['grel']['year']; ?>

						<?php endif; ?>
					<?php else: ?>
<nobr>
	<?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

<?php if ($this->_tpl_vars['elem']['iduserregi'] == 0): ?>
<?php else: ?>
	<img style="cursor:help" src="images/info.gif" title="изходен от <?php echo $this->_tpl_vars['elem']['userregi']; ?>
 на <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['registered'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
">
<?php endif; ?>
<?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
<?php else: ?>
	<img style="cursor:help" src="images/view.png" title="бележки: <?php echo $this->_tpl_vars['elem']['notes']; ?>
">
<?php endif; ?>
</nobr>
					<?php endif; ?>
			<td class='sep'>&nbsp;</td>
<td class="contleft"> 
	<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

									<td class='sep'>&nbsp;</td>
<td class="contleft"> <?php if (empty ( $this->_tpl_vars['elem']['typetext'] )): ?><font color=blue><?php echo $this->_tpl_vars['elem']['descrip']; ?>
</font><?php else:  echo $this->_tpl_vars['elem']['typetext'];  endif; ?>
			<td class='sep'>&nbsp;</td>
<td class="contleft"> <?php if (empty ( $this->_tpl_vars['grel'] ) || $this->_tpl_vars['elem']['serial'] <> 0):  echo $this->_tpl_vars['elem']['adresat'];  else:  echo $this->_tpl_vars['grel']['coun']; ?>
 броя<?php endif; ?>

			<td class='sep'>&nbsp;</td>

																												<?php if ($_SESSION['VIEWFLAG_FINANOEDIT']): ?>
<td colspan=5> &nbsp;
<?php if (empty ( $this->_tpl_vars['elem']['content'] ) && empty ( $this->_tpl_vars['elem']['contword'] )): ?>
<?php else: ?>
	<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
		<?php if (empty ( $this->_tpl_vars['onic'] )): ?>
		<?php else: ?>
<span style="border-bottom:1px solid black;cursor:pointer;" 
id="g<?php echo $this->_tpl_vars['elem']['regigroup']; ?>
" onclick="tog2('g<?php echo $this->_tpl_vars['elem']['regigroup']; ?>
');">отвори</span>
</td>
		<?php endif; ?>
	<?php else: ?>
		<?php if (empty ( $this->_tpl_vars['onic'] )): ?>
		<?php else: ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
														<?php else: ?>

<?php if (empty ( $this->_tpl_vars['elem']['content'] ) && empty ( $this->_tpl_vars['elem']['contword'] )): ?>
		<?php if (empty ( $this->_tpl_vars['elem']['filename'] )): ?>
<td colspan=7> <font color=red> празен документ </font>
				<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['uplo']; ?>
" class="nyroModal" target="_blank">
				<img src="images/up.gif" title="качи файл">
				</a>
		<?php else: ?>
<td colspan=7> 
				<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['uplo']; ?>
" class="nyroModal" target="_blank">
				<img src="images/up.gif" title="качи файл">
				</a>
<img src="images/down.gif" title="свали файла" style="cursor:pointer" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['down']; ?>
');">
				<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['defi']; ?>
" class="nyroModal" target="_blank">
				<img src="images/delefile.gif" title="изтрий файла">
				</a>
<font color=blue> <?php echo $this->_tpl_vars['elem']['filename']; ?>
 </font>
		<?php endif; ?>
<?php else: ?>
			<td>
										<?php if ($this->_tpl_vars['elem']['regigroup'] <> 0 && $this->_tpl_vars['elem']['serial'] == 0): ?>
											<?php $this->assign('imgtit', "отпечати всички"); ?>
											<?php $this->assign('imgsrc', "printmult.gif"); ?>
											<?php $this->assign('ellink', $this->_tpl_vars['elem']['mult']); ?>
										<?php else: ?>
											<?php $this->assign('imgtit', "отпечати"); ?>
											<?php $this->assign('imgsrc', "print.gif"); ?>
											<?php $this->assign('ellink', $this->_tpl_vars['elem']['prnt']); ?>
										<?php endif; ?>
							<?php if ($this->_tpl_vars['elem']['suff'] == 'html'): ?>
								<?php if ($this->_tpl_vars['elem']['regigroup'] <> 0 && $this->_tpl_vars['elem']['serial'] == 0): ?>
<img src="images/<?php echo $this->_tpl_vars['imgsrc']; ?>
" title="<?php echo $this->_tpl_vars['imgtit']; ?>
" style="cursor:pointer" onclick="fuprin('<?php echo $this->_tpl_vars['ellink']; ?>
');">
								<?php else: ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['ellink']; ?>
" class="nyroModal" target="_blank">
<img src="images/<?php echo $this->_tpl_vars['imgsrc']; ?>
" title="<?php echo $this->_tpl_vars['imgtit']; ?>
">
</a>
								<?php endif; ?>
							<?php else: ?>
								<?php if ($this->_tpl_vars['elem']['regigroup'] <> 0 && $this->_tpl_vars['elem']['serial'] == 0): ?>
<a href="file:///<?php echo $this->_tpl_vars['LETDOC']; ?>
:/<?php echo $this->_tpl_vars['elem']['regigroup']; ?>
group.doc" target="_blank"><img src="images/<?php echo $this->_tpl_vars['imgsrc']; ?>
" title="<?php echo $this->_tpl_vars['imgtit']; ?>
" style="cursor:pointer; border: 0px;"></a>
								<?php else: ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
						<?php else: ?>
			<td class='sep'>&nbsp;</td>
																						<?php if (empty ( $this->_tpl_vars['onic'] )): ?>
														<td>
							<?php if ($this->_tpl_vars['elem']['suff'] == 'html'): ?>
				<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['docu']; ?>
" class="nyroModal" target="_blank">
				<img src="images/edit.png" title="корегирай">
				</a>
							<?php else: ?>
				<a href="file:///<?php echo $this->_tpl_vars['LETDOC']; ?>
:/<?php echo $this->_tpl_vars['elem']['id']; ?>
.doc" target="_blank">
				<img src="images/word.gif" title="корегирай/изведи">
				</a>
							<?php endif; ?>
					&nbsp;

			<td class='sep'>&nbsp;</td>
			<td>
					<?php if ($this->_tpl_vars['elem']['serial'] == 0 && $this->_tpl_vars['elem']['izho']): ?>
				<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['regi']; ?>
" class="nyroModal" target="_blank">
				<img src="images/regi.gif" title="изведи">
				</a>
					<?php else: ?>
					&nbsp;
					<?php endif; ?>

			<td class='sep'>&nbsp;</td>
			<td>
					<?php if ($this->_tpl_vars['elem']['serial'] == 0): ?>
<img src="images/free.gif" title="изтрий" style="cursor:pointer;" onclick="dele('caseeditzone.php<?php echo $this->_tpl_vars['elem']['dele']; ?>
');">
					<?php else: ?>
					&nbsp;
					<?php endif; ?>
																						<?php else: ?>
											<td colspan=5>
<span style="border-bottom:1px solid black;cursor:pointer;" 
id="g<?php echo $this->_tpl_vars['elem']['regigroup']; ?>
" onclick="tog2('g<?php echo $this->_tpl_vars['elem']['regigroup']; ?>
');">отвори</span>
</td>
																						<?php endif; ?>
						<?php endif; ?>
<?php endif; ?>
														<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=left>
											<?php if (empty ( $this->_tpl_vars['onic'] )): ?>
<nobr>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['scanuplo']; ?>
" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
					<?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
		<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('caseeditzone.php<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
</nobr>
											<?php else: ?>
											<?php endif; ?>
		<td class='sep'>&nbsp;</td>
											<?php if (empty ( $this->_tpl_vars['onic'] )): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deliinfo.ajax.tpl", 'smarty_include_vars' => array('iddocu' => $this->_tpl_vars['iddocu'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
											<?php else: ?>
<td>&nbsp;
											<?php endif; ?>
																																				<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
			
	</tbody>
			</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "deliinfobase.ajax.tpl", 'smarty_include_vars' => array('ISTTIP' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<center>
<iframe id="frarep" width=520 height=40 frameborder=0 scrolling=no style="display:block"></iframe>
</center>
<script>
function fuprin(p1){
	document.getElementById("frarep").src= "caseeditzone.php"+p1;
}
function tog2(idgr){
//alert(idgr);
//alert($("#"+idgr).text());
	var flshow;
	if ($("#"+idgr).text()=="отвори"){
		$("#"+idgr).text("затвори");
		flshow= true;
	}else{
		$("#"+idgr).text("отвори");
		flshow= false;
	}
	$(".myrow").each(function(){
		if ($(this).attr("rela")==idgr){
			if (flshow){
				$(this).show();
			}else{
				$(this).hide();
			}
		}else{
		}
	});
}
function dele(link){
	var resu= confirm('ВНИМАНИЕ\\nПотвърди изтриването на изходящия документ');
	if (resu){
		jQuery.ajax({
			url: link
			,success: function(data){
					if (data=="ok"){
$('#t6link').click();
					}else{
alert("ERROR"+String.fromCharCode(10)+data);
					}
			}
		});
	}else{
	}
}
$(document).ready(function() {
	$("[@rela='ttip']").cluetip({ width: 460, cursor:'help' });
	$('.deliinfo').cluetip({ width: 660, cursor:'help' });
});
</script>