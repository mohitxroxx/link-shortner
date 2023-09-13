<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url = $_POST['original-url'];
    $apiUrl = "https://api.shrtco.de/v2/shorten?url=$url";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        $newUrl = json_decode($response, true);
        
        if ($newUrl && isset($newUrl['result'])) {
            $shortLink = $newUrl['result']['short_link'];
            $shortLink2 = $newUrl['result']['short_link2'];
            echo "<h2>Shortened Link 1: <a href='$shortLink' target='_blank'>$shortLink</a></h2>";
            echo "<h2>Shortened Link 2: <a href='$shortLink2' target='_blank'>$shortLink2</a></h2>";
        } else {
            echo "<p>Invalid URL format or no result found</p>";
        }
    }

    curl_close($ch);
}
?>
