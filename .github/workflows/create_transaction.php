<?php
$apiKey = 'API_KEY_ANDA'; // Ganti dengan API Key dari Tripay
$privateKey = 'PRIVATE_KEY_ANDA'; // Ganti dengan Private Key Tripay
$merchantCode = 'MERCHANT_CODE_ANDA'; // Ganti dengan Merchant Code Tripay

// Data transaksi
$merchantRef = 'INV' . time(); // Referensi transaksi unik

$data = [
    'method'         => 'BRIVA', // Contoh metode: BRIVA, QRIS, BCA, DLL
    'merchant_ref'   => $merchantRef,
    'amount'         => 10000,
    'customer_name'  => 'Nama Pelanggan',
    'customer_email' => 'email@contoh.com',
    'customer_phone' => '081234567890',
    'order_items'    => [
        [
            'sku'      => 'TOPUP10',
            'name'     => 'Top-Up 10 Diamond',
            'price'    => 10000,
            'quantity' => 1
        ]
    ],
    'return_url'     => 'https://websiteanda.com/return',
    'expired_time'   => time() + (24 * 60 * 60),
    'signature'      => hash_hmac('sha256', $merchantCode . $merchantRef . 10000, $privateKey)
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL            => "https://tripay.co.id/api/transaction/create",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ["Authorization: Bearer $apiKey"],
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($data)
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
    echo json_encode(['success' => false, 'message' => "cURL Error: $error"]);
} else {
    echo $response; // JSON dari Tripay, berisi payment URL dan informasi lainnya
}
?>
