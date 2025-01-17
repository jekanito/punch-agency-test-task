<?php

namespace App\Services;

class TelegramService
{
    protected string $bot_token;
    protected string $user_id;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->bot_token = config('telegram.bot_token');
        $this->user_id = config('telegram.user_id');
    }

    public function sendMessage($message  = "Test message")
    {
        $params = [
            'chat_id' => $this->user_id, // id получателя
            'text' => $message, // текст сообщения
            'parse_mode' => 'HTML', // режим отображения сообщения HTML (не все HTML теги работают)
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot'.$this->bot_token.'/sendMessage'); // адрес вызова api функции телеграм
        curl_setopt($curl, CURLOPT_POST, true); // отправка методом POST
        curl_setopt($curl, CURLOPT_TIMEOUT, 10); // время выполнения запроса
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // параметры запроса
        $result = curl_exec($curl); // запрос к api
        curl_close($curl);

        return json_decode($result);
    }
}
