<?php
// Firebase JWTライブラリの読み込み
require 'libs/php-jwt/src/JWT.php';
require 'libs/php-jwt/src/BeforeValidException.php';
require 'libs/php-jwt/src/ExpiredException.php';
require 'libs/php-jwt/src/SignatureInvalidException.php';

use Firebase\JWT\JWT;

// JWTトークンの生成
$team_id = 'YOUR_TEAM_ID';
$key_id = 'YOUR_KEY_ID';
$private_key = file_get_contents('AuthKey_YOUR_KEY_ID.p8');

$header = [
    'alg' => 'ES256',
    'kid' => $key_id
];

$payload = [
    'iss' => $team_id,
    'iat' => time(),
    'exp' => time() + (60 * 60 * 24 * 180), // 6 months
];

$jwt = JWT::encode($payload, $private_key, 'ES256');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Music Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Apple Music Search</h1>
        <form action="" method="GET" class="mb-4">
            <input type="text" name="query" class="border p-2 w-full" placeholder="Enter song or artist name" required>
            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Search</button>
        </form>

        <?php
        if (isset($_GET['query'])) {
            $query = urlencode($_GET['query']);

            $url = "https://api.music.apple.com/v1/catalog/us/search?term=$query&limit=10&types=songs";
            $opts = [
                "http" => [
                    "header" => "Authorization: Bearer $jwt"
                ]
            ];
            $context = stream_context_create($opts);
            $response = file_get_contents($url, false, $context);
            $results = json_decode($response, true);

            if (isset($results['results']['songs']['data'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
                foreach ($results['results']['songs']['data'] as $song) {
                    $songName = $song['attributes']['name'];
                    $artistName = $song['attributes']['artistName'];
                    $previewUrl = $song['attributes']['previews'][0]['url'];

                    echo "<div class='bg-white p-4 rounded shadow'>
                            <h2 class='text-xl font-bold'>$songName</h2>
                            <p class='text-gray-700'>$artistName</p>
                            <audio controls class='w-full mt-2'>
                                <source src='$previewUrl' type='audio/mpeg'>
                                Your browser does not support the audio element.
                            </audio>
                          </div>";
                }
                echo '</div>';
            } else {
                echo '<p class="text-red-500">No results found.</p>';
            }
        }
        ?>
    </div>
</body>
</html>
