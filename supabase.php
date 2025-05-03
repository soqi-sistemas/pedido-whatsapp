<?php
// supabase.php
define('SUPABASE_URL', 'https://isauvpkojbjyxdaxefoz.supabase.co');
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImlzYXV2cGtvamJqeXhkYXhlZm96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDYyOTMzODIsImV4cCI6MjA2MTg2OTM4Mn0.MS54KRfmR_m7q5qDkoq48uuPkAAzlTFYVaBazXIyF1g');

function supabase_get_produtos() {
    $url = SUPABASE_URL . "/rest/v1/produtos?select=*";
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
    return json_decode($res, true);
}

function supabase_salvar_produto($dados) {
    $url = SUPABASE_URL . "/rest/v1/produtos";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($dados),
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY,
            "Content-Type: application/json",
            "Prefer: return=representation"
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

function supabase_excluir_produto($id) {
    $url = SUPABASE_URL . "/rest/v1/produtos?id=eq.$id";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}


function supabase_salvar_pedido($pedido) {
    $url = SUPABASE_URL . "/rest/v1/pedidos";
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($pedido),
        CURLOPT_HTTPHEADER => [
            "apikey: " . SUPABASE_KEY,
            "Authorization: Bearer " . SUPABASE_KEY,
            "Content-Type: application/json",
            "Prefer: return=representation"
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}
