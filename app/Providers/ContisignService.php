<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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

        if ($response->failed()) {
            throw new \Exception('Login failed: ' . $response->body());
        }

        $data = $response->json();
        $this->token = $data['token'] ?? null;

        if (!$this->token) {
            throw new \Exception('Token not returned from login.');
        }

        return $data;
    }

    /**
     * Helper to add Authorization header
     */
    protected function withAuth()
    {
        if (!$this->token) {
            throw new \Exception('Token not set. Call login() first.');
        }
        // dd($this->token);

        return Http::withHeaders([
            'Authorization' => $this->token
        ]);
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
