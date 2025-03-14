<?php
include 'search_music.php';

$music = [];
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $music = searchSpotify($search, $token);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lagu - Spotify API</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="GET">
        <input type="text" name="search" placeholder="Cari lagu atau artis..." required>
        <button type="submit">Cari</button>
    </form>

    <audio id="audioPlayer" controls style="display: none;"></audio>

    <?php if (!empty($music['tracks']['items'])): ?>
        <h2>Hasil Pencarian:</h2>
        <ul>
    <?php foreach ($music['tracks']['items'] as $track): ?>
        <li class="track" 
            data-preview="<?= $track['preview_url'] ?? '' ?>"
            data-title="<?= htmlspecialchars($track['name']) ?>"
            data-artist="<?= htmlspecialchars($track['artists'][0]['name']) ?>"
            data-spotify="<?= $track['external_urls']['spotify'] ?>">

            <img src="<?= $track['album']['images'][0]['url'] ?>" width="80">
            <span><?= htmlspecialchars($track['name']) ?> - <?= htmlspecialchars($track['artists'][0]['name']) ?></span>
        </li>
    <?php endforeach; ?>
</ul>

    <?php elseif (isset($_GET['search'])): ?>
        <p>Tidak ada hasil ditemukan untuk "<?= htmlspecialchars($search) ?>"</p>
    <?php endif; ?>

        <script>
            document.querySelectorAll(".track").forEach(item => {
        item.addEventListener("click", function() {
            let audioPlayer = document.getElementById("audioPlayer");
            let previewUrl = this.getAttribute("data-preview");
            let spotifyUrl = this.getAttribute("data-spotify");

            if (previewUrl) {   
                audioPlayer.src = previewUrl;
                audioPlayer.style.display = "block";
                audioPlayer.play();
            } else {
                let confirmRedirect = confirm("Preview tidak tersedia untuk lagu ini. Buka di Spotify?");
                if (confirmRedirect) {
                    window.open(spotifyUrl, "_blank");
                }
            }
        });
    });

    </script>
</body>
</html>
