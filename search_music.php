<?php
include 'spotify_auth.php'; 

function searchSpotify($query, $token) {
    $url = "https://api.spotify.com/v1/search?q=" . urlencode($query) . "&type=track&limit=10";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLO PT_HTTPHEADER, [
        "Authorization: Bearer " . $token
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        return ["error" => "API request failed", "status" => $httpCode];
    }

    return json_decode($response, true);
}
?>
