<!DOCTYPE html>
<html>
<head>
    <title>Write</title>
</head>
<a href="read.php">Display results</a><br>
<?php

require 'vendor/autoload.php';
//EAN KEY: 7cadb24b-b9a9-40b1-9e54-18db60231715
$client = new GuzzleHttp\Client();
$apiToken = ''; //enter key here
$conn = mysqli_connect("localhost", "root", "", "colby");
$sql = "truncate table product";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$response = $client->get(
    'https://hyperion.colby.si/api/digital/products/query/7cadb24b-b9a9-40b1-9e54-18db60231715',
    [
        'headers' => [
            'Api-Token' => $apiToken,
            'Accept' => 'application/json',
        ],
        ]
    );
    
$body = $response->getBody();
    $response2 = $client->get(
        'https://hyperion.colby.si/api/digital/products/prices/query/7cadb24b-b9a9-40b1-9e54-18db60231715',
        [
            'headers' => [
                'Api-Token' => $apiToken,
                'Accept' => 'application/json',
            ],
            ]
        );
$body2 = $response2->getBody();

$mysqli = new mysqli("localhost", "root", "", "colby");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$items = array();
if ($response2->getStatusCode() == 200) {
    foreach (json_decode((string) $body2) as $product) {
        $items[0] = $product->SRP;
        $items[1] = $product->promotion;
        $items[2] = $product->wholesale;
    }
    echo '<pre>';
    print_r($items);
    echo '</pre>';
}

echo '<pre>';
print_r(json_decode((string) $body));
echo '</pre>';


if ($response->getStatusCode() == 200) {
    foreach (json_decode((string) $body) as $product) {
        $genresCombined = '';
        foreach ($product->genres as $genre) {
            $genresCombined .= $genre->tag . ',';
        }
        $assetsCombined = '';
        foreach ($product->assets as $asset) {
            $assetsCombined .= $asset->fileName . ' => ' . $asset->URL . ', ';
        }
        $sql = "INSERT INTO product (
                langTitle, 
                ean, 
                vendor, 
                productType, 
                productID, 
                releaseDate, 
                announced, 
                datumIzida, 
                packShot, 
                description, 
                keyFeatures, 
                legals, 
                spokenLanguages, 
                subtitleLanguages,
                menuLanguages,
                minRequirements,
                recRequirements,
                pegiValue,
                pegiNumber,
                videoURL,
                genre,
                assets,
                srp,
                promotion,
                wholesale
            ) 
            VALUES 
            (
                '$product->langTitle', 
                '$product->EAN', 
                '$product->vendor', 
                '$product->productType', 
                '$product->productID', 
                '$product->releaseDate', 
                '$product->announced', 
                '$product->datumIzida', 
                '$product->packShot', 
                '$product->description', 
                '$product->keyFeatures', 
                '$product->legals', 
                '$product->spokenLanguages', 
                '$product->subtitleLanguages', 
                '$product->menuLanguages', 
                '$product->minRequirements', 
                '$product->recRequirements', 
                '$product->PEGIValue', 
                '$product->PEGINumber', 
                '$product->videoURL', 
                '$genresCombined', 
                '$assetsCombined',
                '$items[0]',
                '$items[1]',
                '$items[2]'
            )";
        if ($conn->query($sql) === TRUE) {
            echo "Finished successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>