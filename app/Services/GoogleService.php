<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleService
{
    public function appendRowInSheet($data, $range = 'Лист1!A:D'): void
    {
        $client = new Client();
        $client->setAuthConfig(__DIR__ . '/../../tasks-punch-agency-7be5170e8ca8.json');
        $client->setAccessType('offline');
        $client->setScopes([Sheets::SPREADSHEETS]);

        $service = new Sheets($client);
        $spreadsheetId = config('google.spreadsheet_id');

        $body = new ValueRange([
            'values' => $data
        ]);
        $params = [
            'valueInputOption' => "RAW"
        ];
        $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }
}
