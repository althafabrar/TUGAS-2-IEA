<?php
$client_id = "f596f33df663489d9e393c2f579a6ea1";  // Ganti dengan Client ID dari Spotify
$client_secret = "1f385fc7a13b4855a32f8f8bd37929e3";  // Ganti dengan Client Secret dari Spotify

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic " . base64_encode("$client_id:$client_secret"),
    "Content-Type: application/x-www-form-urlencoded"
]);

$response = curl_exec($ch);
curl_close($ch);

$token = json_decode($response, true)['access_token'];
?>
