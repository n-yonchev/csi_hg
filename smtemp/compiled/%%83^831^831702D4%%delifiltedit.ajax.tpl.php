<?php /* Smarty version 2.6.9, created on 2020-02-28 11:14:28
         compiled from delifiltedit.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => "корегирай филтъра",'WIDTH' => 800)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				<fieldset class="filtgr">
				<legend align=right> екземпляр за връчване </legend>
					<table>
					<tr>
<td> дата или период на създаване
<td>
<input type="text" name="peridateregi" id="peridateregi" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'peridateregi','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridateregi" label="няма дата на създаване">
</nobr>
					<tr>
<td> адресата да съдържа
<td>
<input type="text" name="asatcont" id="asatcont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'asatcont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="asatcont" label="празен адресат">
</nobr>
					<tr>
<td> адреса да съдържа
<td>
<input type="text" name="addrcont" id="addrcont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'addrcont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="addrcont" label="празен адрес">
</nobr>
					</table>
				</fieldset>

				<fieldset class="filtgr">
				<legend align=right> връчване </legend>
					<table>
									<?php if ($this->_tpl_vars['ISINTE']): ?>
					<tr>
<td> метод
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPOSTTYPENAME'],'ID' => 'idposttype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idposttype" label="няма метод на връчване">
</nobr>
									<?php else: ?>
									<?php endif; ?>
					<tr>
<td> дата или период на вземане 
<td>
<input type="text" name="peridate1" id="peridate1" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'peridate1','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate1" label="няма дата на вземане">
</nobr>
					<tr>
<td> дата или период на връчване
<td>
<input type="text" name="peridate2" id="peridate2" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'peridate2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate2" label="няма дата на връчване">
</nobr>
					<tr>
<td> дата или период на връщане 
<td>
<input type="text" name="peridate3" id="peridate3" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'peridate3','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="peridate3" label="няма дата на връщане">
</nobr>
					<tr>
<td> текущ статус
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSTATPOST'],'ID' => 'idpoststat','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idpoststat" label="няма текущ статус">
</nobr>
					</table>
				</fieldset>

									<?php if ($this->_tpl_vars['ISINTE']): ?>
				<fieldset class="filtgr">
				<legend align=right> изходящ документ </legend>
					<table>
					<tr>
<td> номер
<td>
<input type="text" name="seridocuout" id="seridocuout" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seridocuout','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> година
<td>
<input type="text" name="yeardocuout" id="yeardocuout" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'yeardocuout','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> тип
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPEPOST'],'ID' => 'iddocutype','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<tr>
<td colspan=3>
въведи списък изходящи номера от текущото тримесечие, разделени с интервал
<br>
<textarea class="input" name="listdocuout" id="listdocuout" rows=2 cols=80></textarea>
					</table>
				</fieldset>
									<?php else: ?>
				<fieldset class="filtgr">
				<legend align=right> входящ документ </legend>
					<table>
					<tr>
<td> номер
<td>
<input type="text" name="seridocu" id="seridocu" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seridocu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> година
<td>
<input type="text" name="yeardocu" id="yeardocu" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'yeardocu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> описанието да съдържа
<td>
<input type="text" name="desccont" id="desccont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'desccont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="desccont" label="празно описание">
</nobr>
					<tr>
<td> подателя да съдържа
<td>
<input type="text" name="fromcont" id="fromcont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'fromcont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> бележките да съдържат
<td>
<input type="text" name="notecont" id="notecont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notecont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="notecont" label="празни бележки">
</nobr>
					<tr>
<td> доп.инфо да съдържа
<td>
<input type="text" name="exincont" id="exincont" size=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'exincont','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="exincont" label="празна доп.инфо">
</nobr>
					</table>
				</fieldset>
									<?php endif; ?>

									<?php if ($this->_tpl_vars['ISINTE']): ?>
				<fieldset class="filtgr">
				<legend align=right> изп.дело </legend>
					<table>
					<tr>
<td> номер/год
<td>
<input type="text" name="seriyearcase" id="seriyearcase" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seriyearcase','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td> деловодител
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARUSERCASE'],'ID' => 'idcaseuser','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<nobr>
<input class="fon7" type=checkbox name="cboxlistelem[]" value="idcaseuser" label="без деловодител">
</nobr>
					</table>
				</fieldset>
									<?php else: ?>
									<?php endif; ?>

<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'приложи','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>