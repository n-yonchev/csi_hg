<?php /* Smarty version 2.6.9, created on 2020-02-27 14:00:08
         compiled from cazofinagroustat.tpl */ ?>
			<?php if (0): ?>
			<?php elseif ($this->_tpl_vars['elem']['stat'] == "ok+"): ?>
<span class="yes">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="Постъплението е приключено" style="cursor:help;">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
Сумата участва като ПОГАСЕНА,
<br>
както и в изчисляване на актуалния дълг към момента.
</span>
			<?php elseif ($this->_tpl_vars['elem']['stat'] == "ok-"): ?>
<span class="yesmin">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="Постъплението е приключено" style="cursor:help;">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
Обаче ЛИПСВА дата за погасяване, поради което
<br>
Сумата е НЕНАСОЧЕНА и
<br>
НЕ участва в погасяването и в актуалния дълг към момента.
<br>
Ако въведете дата за погасяване, сумата ще участва като ПОГАСЕНА.
</span>
			<?php elseif ($this->_tpl_vars['elem']['stat'] == "di+"): ?>
<span class="no">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
Няма въведени разпределения, поради което
<br>
сумата може да участва в груповото разпределяне.
</span>
			<?php elseif ($this->_tpl_vars['elem']['stat'] == "di+nocb"): ?>
<span class="nochecked">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
Няма въведени разпределения. 
<br>
Сумата може да участва в груповото разпределяне,
<br>
но не е избрана.
<br>
Ако ИЗБЕРЕТЕ сумата, тя ЩЕ УЧАСТВА в груп.разпределяне.
</span>
			<?php elseif ($this->_tpl_vars['elem']['stat'] == "di-"): ?>
<span class="nomin">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
Но ИМА въведени разпределения, поради което
<br>
Сумата е НЕНАСОЧЕНА и
НЕ МОЖЕ да участва в груповото разпределяне.
<br>
Ако НУЛИРАТЕ всички въведени разпределения,
<br>
сумата ЩЕ МОЖЕ да участва в груповото разпределяне.
</span>
			<?php endif; ?>

