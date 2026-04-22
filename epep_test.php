<?php

include_once "common.php";
include_once "epep_functions.php";

// App Auth Data(Key & Secret)
// $epep_auth = get_epep_auth_data();
// print_rr($epep_auth);
$app_key = get_epep_app_key();
$app_secret = get_epep_app_secret();

// Auth Request
var_dump(epep_auth_request($app_key, $app_secret));
exit;

// Auth Function
// print_rr(epep_auth($app_key, $app_secret));

// Get Proccess
// print_rr($proc = epep_request('GetExecProcessById', "9046e321-5465-4742-8195-df44b65c4c66", $app_key, $app_secret)['response']['execCases']);
// $exec_process = epep_request('GetExecProcessById', "9046e321-5465-4742-8195-df44b65c4c66", $app_key, $app_secret)['response'];
// print_rr($exec_process['sideList']);

// Delete Exec Case
// foreach($proc as $case) {
//     print_rr(epep_request('DeleteExecCase', $case['gid'], $app_key, $app_secret));
// }

// Insert Case
// $epep_case_data = array(
//     'gid' => null,
//     'execProcessGid' => "9046e321-5465-4742-8195-df44b65c4c66",
//     'caseState' => "51",
// );
// print_rr(epep_request('InsertExecCase', $epep_case_data, $app_key, $app_secret));

// Update Case
// $case = $DB->select("SELECT * FROM suit WHERE id = 21140")[0];
// $epep_case_data = array(
//     'gid' => null,
//     'execProcessGid' => "9046e321-5465-4742-8195-df44b65c4c66",
//     'caseState' => "51",
// );
// $epep_case_data['gid'] = $case['epep_case_uid'];
// $epep_case_data['number'] = $case['serial'];
// $date = new DateTime($case['created']);
// $epep_case_data['dateRegister'] = $date->format("Y-m-d");
// $update_case_request = epep_request('UpdateExecCase', $epep_case_data, $app_key, $app_secret);

// File Download
// $doc = epep_common_request('DownloadDocumentBinary', "b6d79e4a-623f-4d32-ba55-734b3802e114", $app_key, $app_secret);
// $binary_data = base64_decode($doc['response']['binaryContent']);
// file_put_contents('./incoming/01test.pdf', $binary_data);

// Epep_subject Fill
$epep_codes = array(
    121 => '��������',
    122 => '�����',
    123 => '�����',
    124 => '���������',
    125 => '��������� �����',
    126 => '��������� �����',
    127 => '���������� �����',
    431 => '�������� �����',
    432 => '���������� ��������������',
    433 => '��������������� ��������������',
    501 => '�����',
    1002 => '�����',
    1003 => '����������� ������� ������ ��������',
    1004 => '�������������� �� ������ ��������',
    1005 => '�������� �� ������ ��������',
    1006 => '��������',
    1007 => '������� �� ���� ����',
    1008 => '������� �� ������ �����',
    1009 => '����� ���� �� ������ ��������',
    1010 => '����������� � ���������',
    1016 => '�������� �� ����',
    1017 => '�� ������������ �� ���������� �����',
    1018 => '�� ���������� �������������� �� ������',
    1019 => '�������� �� ������ ��������',
    1020 => '�������������� �� ������ ��������',
    1021 => '��������� ����� �� ������ ��������',
    1022 => '��������� ����� �� ������ ��������',
    1023 => '�������� �� �������������� �� ������ ����� �� ������ ��������',
    1024 => '�������� �� �������������� �� ������ ����� �� ������ ��������',
    1025 => '�������� �� �������������� �� ���� ���� �� ������ ��������',
    1026 => '�������� �� �������������� �� ���� ���� �� ������ ��������',
    1027 => '�������� ����� �� �������� �� ������������ ����',
    1028 => '�������� ����� ����� ������ ���������� ���',
    1029 => '�������� �� ��������� ������������ �� ������ ��������',
    1030 => '�������� �� ��������� ������������ �� ������ ��������',
    1031 => '����������� ������� ������ ��������',
    1032 => '��������� ��������',
    1034 => '��������� �����',
    1036 => '������� �����',
    1037 => '����� �����',
    1038 => '����� ������������ �������',
    1041 => '�����������',
    1042 => '����� ����������',
);

foreach($epep_codes as $key => $value) {
    $name = toutf8($value);
    $DB->query("INSERT INTO epep_subject(epep_code, epep_name, type) VALUES ({$key}, '{$name}', 2)");
}

// UPDATE `csi_ds`.`epep_debt_distribution` SET `principal` = '0', `intrest` = '0', `up_to_date` = NULL WHERE `epep_debt_distribution`.`id` = 2;
// UPDATE `csi_ds`.`epep_obligations` SET `paid` = '0' WHERE `epep_obligations`.`id` = 5;
