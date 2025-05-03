<?php
include 'supabase.php';

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados inválidos']);
    exit;
}

$pedido = [
    'nome_cliente' => $data['nome'],
    'whatsapp' => $data['whatsapp'],
    'itens' => json_encode($data['itens']),
    'total' => $data['total'],
    'created_at' => date('c')
];

$result = supabase_salvar_pedido($pedido);

echo json_encode(['success' => true, 'id' => $result['id'] ?? null]);
