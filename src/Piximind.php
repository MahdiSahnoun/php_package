<?php

namespace Piximind\Princo;

class Princo
{
    public function printTicket($apiKey, $userId, $ticket)
    {
        $url = 'http://localhost:3000/impression'; // Update if needed

        $body = [
            'apiKey' => $apiKey,
            'userId' => $userId,
            'pdfBase64' => base64_encode($ticket), // Use base64_encode for proper encoding
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($body),
            ],
        ];

        $context = stream_context_create($options);

        try {
            $result = file_get_contents($url, false, $context);
            $data = json_decode($result, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response');
            }

            return $data;
        } catch (Exception $e) {
            // Handle exception appropriately (e.g., log error, throw further)
            return null;
        }
    }

    public function print_pdf($ticket)
    {
        $url = 'http://localhost:3000/impression/pdf'; // Update if needed

        $body = [
            'pdfBase64' => base64_encode($ticket),
        ];

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($body),
            ],
        ];

        $context = stream_context_create($options);

        try {
            $result = file_get_contents($url, false, $context);
            $data = json_decode($result, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON response');
            }

            return $data;
        } catch (Exception $e) {
            // Handle exception appropriately (e.g., log error, throw further)
            return null;
        }
    }
}