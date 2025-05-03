<?php
include 'supabase.php';

function supabase_get_config() {
    $url = SUPABASE_URL . "/rest/v1/config?select=pedidos_ativos";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res, true);
    echo json_encode(['ativo' => $data[0]['pedidos_ativos'] ?? true]);
}
