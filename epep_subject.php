<?php

if($_POST['submit']) {
    foreach($_POST['subject'] as $key => $item) {
        $DB->query("UPDATE epep_subject SET type = ?d WHERE id = ?d", (int)$item, (int)$key);
    }
}

$types = $DB->query("SELECT * FROM epep_subject");
$types = dbconv($types);

unset($listsubjtype[3]);
unset($listsubjtype[4]);
unset($listsubjtype[5]);
$smarty->assign("TYPES", $types);
$smarty->assign("SUBJECT_TYPES", $listsubjtype);
$smarty->assign("FORM_URL", geturl("mode=epepsubject"));

$pagecont= smdisp("epep_subject.tpl","fetch");