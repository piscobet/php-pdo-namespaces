<?php

namespace Utils;

class GeoLocator {
    private string $apiUrl;

    public function __construct(string $apiUrl = 'http://ip-api.com/php/') {
        $this->apiUrl = rtrim($apiUrl, '/');
    }

    public function getGeoLocation(string $ip): ?array {
        $url = $this->apiUrl . '/' . $ip;

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Execute the request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check for cURL errors
        if (curl_errno($ch)) {
            curl_close($ch);
            return null; // Handle error appropriately
        }

        curl_close($ch);

        // Check HTTP status and decode the response
        if ($httpCode === 200 && $response) {
            return @unserialize($response) ?: null;
        }

        return null; // Handle API failure
    }
}
