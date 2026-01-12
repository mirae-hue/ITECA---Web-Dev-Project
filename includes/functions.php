<?
/*function getLiveRates() {
    $apiKey = "1149cf39676b90f38d355a1d";
    $url = "https://v6.exchangerate-api.com/v6/$apiKey/latest/ZAR";

    $response = @file_get_contents($url);
    if (!$response) {
        return false; // fallback if API fails
    }

    $data = json_decode($response, true);
    return $data['conversion_rates'] ?? false;
 }*/
?>