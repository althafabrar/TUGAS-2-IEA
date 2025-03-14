<?php
include 'spotify_auth.php';

function searchSpotify($query, $token) {
    $url = "https://api.spotify.com/v1/search?q=" . urlencode($query) . "&type=track&limit=10";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $token
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>
