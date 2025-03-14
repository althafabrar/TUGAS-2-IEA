<?php
if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = "ca67b199592249319b70c6f118580fc3"; // Ganti dengan API Key Spoonacular
    $url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=$apiKey&query=$query&number=5&addRecipeInformation=true";

    // Gunakan cURL untuk request API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
} else {
    echo "Tidak ada pencarian!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Resep</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hasil Pencarian: <?= htmlspecialchars($_GET['query']) ?></h1>
        <a href="index.php" class="kembali">⬅ Kembali</a>
        <div class="resep-container">
            <?php if (!empty($data['results'])): ?>
                <?php foreach ($data['results'] as $resep): ?>
                    <div class="resep">
                        <h3><?= htmlspecialchars($resep['title']) ?></h3>
                        <img src="<?= htmlspecialchars($resep['image']) ?>" alt="<?= htmlspecialchars($resep['title']) ?>" title="<?= htmlspecialchars($resep['title']) ?>">
                        <?php if (isset($resep['readyInMinutes'])): ?>
                            <p>⏳ Durasi: <?= $resep['readyInMinutes'] ?> menit</p>
                        <?php endif; ?>
                        <?php if (isset($resep['servings'])): ?>
                            <p>🍽️ Porsi: <?= $resep['servings'] ?> orang</p>
                        <?php endif; ?>
                        <a href="https://spoonacular.com/recipes/<?= urlencode($resep['title']) ?>-<?= $resep['id'] ?>" target="_blank" class="lihat-resep">Lihat Resep</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada resep ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
