<?php

$root = "http://localhost/nfq-internship-task/api_routes.php?action=";

switch ($_POST['action']) {
    case 'create':
        $api_url = $root . "create";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);
        if ($result) {
            echo "created";
        }
        break;

    case 'read':
        $id = $_POST["id"];
        $api_url = $root . "read&id=" . $id;
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        echo $response;
        break;

    case 'update':
        $api_url = $root . "update";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);
        if ($result) {
            echo 'updated';
        }
        break;

    case 'delete':
        $id = $_POST['id'];
        $api_url = $root . "delete&id=" . $id;
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        echo $response;
        break;
}


