<?php
# корекция на тип входен документ - за статистиката 
# източник : cofromedit.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - aadocutype.id за корекция 
//print "correction [$mode][$edit]";
//print_rr($GETPARAM);

# таблицата 
$taname= "issi_docu_outgoing";
# шаблона 
$tpname= "outtemissi.ajax.tpl";
# полетата 
$filist= array(
	"name"=> array("validator"=>"notempty", "error"=>"името не може да е празно")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";
# особености - aadocutype.mode
$arspec= array();

$_issi_cat= $DB->select("select * from issi_doc_category where id in (1,4,5,10,12)");
$issi_sub_cat= $DB->select("select * from issi_doc_sub_category");

$_issi_cat= dbconv($_issi_cat);
$issi_sub_cat= dbconv($issi_sub_cat);

$issi_sub_cat_grouped = array();

$issi_sub_cat_grouped[0][0] = array("name" => "-", "category_id" => 0, "id" => 0);
$issi_cat[0] = array("id" => 0, "name" => '-');

foreach ($_issi_cat as $key=>$value) {
    $issi_cat[] = $value;
}

foreach ($issi_sub_cat as $key=>$value) {
    $issi_sub_cat_grouped[$value['category_id']][] = $value;
}

$smarty->assign("ISSI_CAT", $issi_cat);
$smarty->assign("ISSI_SUB_CAT", $issi_sub_cat);
$smarty->assign("ISSI_SUB_CAT_GROUPED", $issi_sub_cat_grouped);


# резултат
if (isset($_POST) && $_POST['id_doc_sub_category'] != null) {
    $id_doc_sub_category = $_POST["id_doc_sub_category"];
    $DB->query("DELETE FROM $taname WHERE id_docutype = ?d", $edit);
    $DB->query("INSERT $taname (`id_doc_sub_category`, `id_docutype`) VALUES (?d, ?d)", $id_doc_sub_category, $edit);
    # redirect
    reload("parent", $relurl);
} else {
    $rocont= $DB->select("select * from $taname where id_docutype=?" ,$edit);
    $_POST["id_doc_sub_category"] = $rocont[0]["id_doc_sub_category"];
    # извеждаме формата
    $smarty->assign("EDIT", $edit);
    $smarty->assign("FILIST", $filist);
    print smdisp($tpname,"iconv");
}

