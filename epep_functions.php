<?php

include_once "common.php";

function get_epep_auth_data() {
    global $DB;

    $o = $DB->select("SELECT epep_app_key, epep_app_secret FROM office LIMIT 1");
    return $o[0]; 
}

function get_epep_app_key() {
    global $DB;

    $o = $DB->select("SELECT epep_app_key FROM office LIMIT 1");
    return $o[0]['epep_app_key']; 
}

function get_epep_app_secret() {
    global $DB;

    $o = $DB->select("SELECT epep_app_secret FROM office LIMIT 1");
    return $o[0]['epep_app_secret']; 
}

function epep_auth_request($app_key, $app_secret) {
    global $DB;

    $url = 'https://ecase-api.justice.bg/api/v2/Auth/GetToken';

    $datetime = new DateTime('now', new DateTimeZone('Europe/Sofia'));
    $timestamp = $datetime->format('YmdHi');

    $hmac = hash_hmac('sha256', $timestamp, $app_secret, false);

    $payload_arr = array('data' => $timestamp, 'hash' => $hmac);
    $payload = json_encode($payload_arr);

    $ch = curl_init($url);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: token ' . $app_key,
    );

    $headers_str = implode("\n", $headers);

    $opts = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_TIMEOUT => 20,

        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    );

    curl_setopt_array($ch, $opts);

    $response = curl_exec($ch);

    $request_datetime = $datetime->format('Y-m-d H:i:s');
    if ($response === false) {
        $request_response = curl_error($ch);

        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES 
            ('{$request_datetime}', 'Auth', '{$headers_str}', '{$payload}', 0, '{$request_response}')"
        );
        curl_close($ch);
        return array(
            'error' => true,
        );
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES
            ('{$request_datetime}', 'Auth', '{$headers_str}', '{$payload}', {$http_code}, '{$response}')"
        );

        $response = json_decode($response, true);

        curl_close($ch);
        return array(
            'error' => $http_code != 200,
            'http_code' => $http_code,
            'response' => $response
        );
    }
}

function epep_auth($app_key, $app_secret) {
    global $DB;

    $epep_token_data = $DB->select("SELECT * FROM epep_token LIMIT 1");
    $epep_token_data = $epep_token_data[0];
    $now = new DateTime('now');
    $now->modify('+1 minute');

    if($epep_token_data['expiration_date']) {
        $expiration_date = new DateTime($epep_token_data['expiration_date']);

        if($now > $expiration_date) {
            $auth_data = epep_auth_request($app_key, $app_secret);
            if($auth_data['error']) {
                return array(
                    'error' => true,
                );
            } else {
                $token_data = array(
                    'token' => $auth_data['response']['token'],
                    'expiration_date' => $auth_data['response']['expiresIn']
                );
                $DB->query("UPDATE epep_token SET ?a", $token_data);
                return array(
                    'error' => false,
                    'token' => $token_data['token']
                );
            }
        } else {
            return array(
                'error' => false,
                'token' => $epep_token_data['token']
            );
        }
    } else {
        $auth_data = epep_auth_request($app_key, $app_secret);
        if($auth_data['error']) {
            return array(
                'error' => true,
            );
        } else {
            $token_data = array(
                'token' => $auth_data['response']['token'],
                'expiration_date' => $auth_data['response']['expiresIn']
            );
            $DB->query("UPDATE epep_token SET ?a", $token_data);
            return array(
                'error' => false,
                'token' => $token_data['token']
            );
        } 
    }
}

function epep_request($target, $body, $app_key, $app_secret){
    global $DB;

    $epep_token_data = epep_auth($app_key, $app_secret);
    if($epep_token_data['error']) {
        return array(
            'error' => true
        );
    }

    $epep_token = $epep_token_data['token'];

    $url = 'https://ecase-api.justice.bg/api/v2/ExecProcess/' . $target;

    $payload = json_encode($body);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $epep_token,
        'Connection: close',
        'Expect:'
    );

    $ch = curl_init($url);

    $headers_str = implode("\n", $headers);

    $opts = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,

        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    );

    curl_setopt_array($ch, $opts);

    $response = curl_exec($ch);

    $datetime = new DateTime('now', new DateTimeZone('Europe/Sofia'));
    $request_datetime = $datetime->format('Y-m-d H:i:s');
    if ($response === false) {
        $request_response = curl_error($ch);
        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES 
            ('{$request_datetime}', '{$target}', '{$headers_str}', '{$payload}', 0, '{$request_response}')"
        );
        curl_close($ch);
        return array(
            'error' => true,
        );
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES
            ('{$request_datetime}', '{$target}', '{$headers_str}', '{$payload}', $http_code, '{$response}')"
        );

        $response_json = json_decode($response, true);
        if(!$response_json) {
            $DB->query("INSERT INTO epep_json_error(body, response) VALUES ('{$payload}', '{$response}')");
        }

        curl_close($ch);
        return array(
            'error' => $http_code != 200,
            'http_code' => $http_code,
            'response' => $response_json
        );
    }
}

function epep_common_request($target, $body, $app_key, $app_secret){
    global $DB;

    $epep_token_data = epep_auth($app_key, $app_secret);
    if($epep_token_data['error']) {
        return array(
            'error' => true
        );
    }

    $epep_token = $epep_token_data['token'];

    $url = 'https://ecase-api.justice.bg/api/v2/Common/' . $target;

    $payload = json_encode($body);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $epep_token,
        'Content-Length: ' . strlen($payload),
        'Connection: close',
        'Expect:'
    );

    $ch = curl_init($url);

    $headers_str = implode("\r\n", $headers);

    $opts = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_TIMEOUT => 20,

        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    );

    curl_setopt_array($ch, $opts);

    $response = curl_exec($ch);   

    $datetime = new DateTime('now', new DateTimeZone('Europe/Sofia'));
    $request_datetime = $datetime->format('Y-m-d H:i:s');
    if ($response === false) {
        $request_response = curl_error($ch);
        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES 
            ('{$request_datetime}', '{$target}', '{$headers_str}', '{$payload}', 0, '{$request_response}')"
        );
        curl_close($ch);
        return array(
            'error' => true,
        );
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $DB->query(
            "INSERT INTO epep_logs(request_date, request_type, request_headers, request_body, http_code, response) VALUES
            ('{$request_datetime}', '{$target}', '{$headers_str}', '{$payload}', $http_code, '{$response}')"
        );

        $response_json = json_decode($response, true);
        if(!$response_json) {
            $DB->query("INSERT INTO epep_json_error(body, response) VALUES ('{$payload}', '{$response}')");
        }

        curl_close($ch);
        return array(
            'error' => $http_code != 200,
            'http_code' => $http_code,
            'response' => $response_json
        );
    }
}

function case_create($post_params) {
    global $DB;

    $DB->query("LOCK TABLES suit write, docu write, docusuit write, viewersuit write");

    $current_year = (int) date("Y");

    $document_serial = $DB->select("SELECT max(serial) as 'last' FROM docu WHERE year = ?d", $current_year);
    $document_serial = $document_serial[0]['last'] + 1;
    $case_serial = $DB->select("SELECT max(serial) as 'last' FROM suit WHERE year = ?d", $current_year);
    $case_serial = $case_serial[0]['last'] + 1;

    // FILL WITH ALL THE POST PARAMETERS

    $case_data = array(
        'serial' => $case_serial,
        'year' => $current_year,
    );

    $new_case_id = $DB->query("INSERT INTO suit SET ?a, created = now(), lastdocu = now(), last2 = 0", $case_data);

    $document_data = array(
        'serial' => $document_serial,
        'year' => $current_year,
        'from' => $post_params['from'],
        'notes' => $post_params['notes'] ? $post_params['notes'] : "",
        'iduser' => $_SESSION["iduser"],
        'idtype' => $post_params['type_id'],
        'text' => $post_params['text']
    );

    $new_docu_id = $DB->query("INSERT INTO docu SET ?a, created = now()", $document_data);

    $DB->query("INSERT INTO docusuit(iddocu, idcase, docurange) VALUES (?d, ?d, 0)",
    $new_docu_id, $new_case_id);

    $DB->query("UPDATE suit SET iddocucrea = ?d WHERE id = ?d", $new_docu_id, $new_case_id);

    $DB->query("UNLOCK TABLES");
}