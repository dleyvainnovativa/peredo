<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContisignService
{
    protected $baseUrl = 'https://api.contisign.com.mx/api';
    protected $token;

    /**
     * Login and store token
     */

    public function login(string $email, string $password)
    {
        $response = Http::post("{$this->baseUrl}/auth/signin", [
            'email' => $email,
            'password' => $password
        ]);
        Log::debug("login");

        if ($response->failed()) {
            throw new \Exception('Login failed: ' . $response->body());
        }
        $data = $response->json();
        $token = $data['token'] ?? null;

        if (!$token) {
            throw new \Exception('Token not returned from login.');
        }
        Cache::put('contisign_token', $token, now()->addHour());
        return $token;
    }

    /**
     * Helper to add Authorization header
     */
    protected function withAuth()
    {
        $token = Cache::get('contisign_token');

        if (!$token) {
            // Auto login if no token
            $token = $this->login(
                env('CONTISIGN_EMAIL'),
                env('CONTISIGN_PASSWORD')
            );
        }

        return Http::withHeaders([
            'Authorization' => $token
        ]);
    }

    public function getDocument($id)
    {
        $response = $this->withAuth()->get("{$this->baseUrl}/document/$id");

        if ($response->failed()) {
            throw new \Exception('Error creating UniKey: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Create UniKey
     */
    public function createUniKey(array $payload)
    {
        $response = $this->withAuth()->post("{$this->baseUrl}/createUniKey", $payload);

        if ($response->failed()) {
            throw new \Exception('Error creating UniKey: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Create DataTemplate
     */
    public function createDataTemplate(array $payload)
    {
        $response = $this->withAuth()->post("{$this->baseUrl}/datatemplate", $payload);

        if ($response->failed()) {
            throw new \Exception('Error creating DataTemplate: ' . $response->body());
        }

        return $response->json();
    }
    public function getFullDocument($id)
    {
        dd(sys_get_temp_dir());
        $payload = [
            "email" => "sistemas@contactocp.com.mx",
            "name" => "Johan Narvaez"
        ];
        // dd("{$this->baseUrl}/v2/viewfulldocument/$id");
        // $response = $this->withAuth()->put("{$this->baseUrl}/v2/viewfulldocument/$id", $payload);
        $response = $this->withAuth()
            ->withOptions([
                'stream' => false,
            ])
            ->get("{$this->baseUrl}/v2/viewfulldocument/$id", $payload);

        if ($response->failed()) {
            throw new \Exception('Error creating DataTemplate: ' . $response->body());
        }
        // dd("{$this->baseUrl}/v2/viewfulldocument/$id", $payload, $response->body());
        return $response->json();
    }

    /**
     * Send Signs
     */
    public function sendSigns(array $payload)
    {
        $response = $this->withAuth()->post("{$this->baseUrl}/signs", $payload);

        if ($response->failed()) {
            throw new \Exception('Error sending Signs: ' . $response->body());
        }

        return $response->json();
    }
    public function testCompareConsumables(string $companyId, string $startDate, string $endDate)
    {
        $url = "{$this->baseUrl}/compareconsumables/{$companyId}?StartDate={$startDate}&EndDate={$endDate}";
        $response = $this->withAuth()->get($url);
        // dd($response, $this->token, $this->withAuth());

        if ($response->failed()) {
            throw new \Exception('Error fetching compare consumables: ' . $response->body());
        }

        return $response->json();
    }
}
