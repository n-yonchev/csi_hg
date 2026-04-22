{*
{$elem.stat}
*}
			{if 0}
			{elseif $elem.stat=="ok+"}
<span class="yes">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="Постъплението е приключено" style="cursor:help;">
<span id="cont{$myid}" style="display: none">
Сумата участва като ПОГАСЕНА,
<br>
както и в изчисляване на актуалния дълг към момента.
</span>
			{elseif $elem.stat=="ok-"}
<span class="yesmin">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="Постъплението е приключено" style="cursor:help;">
<span id="cont{$myid}" style="display: none">
Обаче ЛИПСВА дата за погасяване, поради което
<br>
Сумата е НЕНАСОЧЕНА и
<br>
НЕ участва в погасяването и в актуалния дълг към момента.
<br>
Ако въведете дата за погасяване, сумата ще участва като ПОГАСЕНА.
</span>
			{elseif $elem.stat=="di+"}
<span class="no">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont{$myid}" style="display: none">
Няма въведени разпределения, поради което
<br>
сумата може да участва в груповото разпределяне.
</span>
			{elseif $elem.stat=="di+nocb"}
<span class="nochecked">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont{$myid}" style="display: none">
Няма въведени разпределения. 
<br>
Сумата може да участва в груповото разпределяне,
<br>
но не е избрана.
<br>
Ако ИЗБЕРЕТЕ сумата, тя ЩЕ УЧАСТВА в груп.разпределяне.
</span>
			{elseif $elem.stat=="di-"}
<span class="nomin">&#9679;</span>
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="Постъплението е НЕПРИКЛЮЧЕНО" style="cursor:help;">
<span id="cont{$myid}" style="display: none">
Но ИМА въведени разпределения, поради което
<br>
Сумата е НЕНАСОЧЕНА и
НЕ МОЖЕ да участва в груповото разпределяне.
<br>
Ако НУЛИРАТЕ всички въведени разпределения,
<br>
сумата ЩЕ МОЖЕ да участва в груповото разпределяне.
</span>
			{/if}

{*
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="допълнителна информация" style="cursor:help;">
*}

