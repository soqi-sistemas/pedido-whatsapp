<?php
require_once('../supabase.php');

$data = [
    "select" => "*"
];
$response = $supabase->from('produtos')->select('*')->execute();

header('Content-Type: application/json');
echo json_encode($response['data']);
