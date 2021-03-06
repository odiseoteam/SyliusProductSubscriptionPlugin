<?php

declare(strict_types=1);

namespace Odiseo\SyliusProductSubscriptionPlugin\Paypal\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

final class Plan
{
    /** @var Authorization */
    private $authorization;

    /** @var Client */
    private $client;

    public function __construct(Authorization $authorization, bool $sandbox)
    {
        $this->authorization = $authorization;

        $baseUri = 'https://api.paypal.com';

        if ($sandbox) {
            $baseUri = 'https://api.sandbox.paypal.com';
        }

        $this->client = new Client([
            'base_uri' => $baseUri,
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @param string $productId
     * @return array
     */
    public function listPlans(string $productId): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans?product_id=' . $productId;

            $response = $this->client->get($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param string $planId
     * @return array
     */
    public function showPlan(string $planId): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans/' . $planId;

            $response = $this->client->get($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function createPlan(array $data): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans';

            $response = $this->client->post($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
                RequestOptions::BODY => json_encode($data)
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param string $planId
     * @param array $data
     * @return array
     */
    public function updatePlan(string $planId, array $data): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans/' . $planId;

            $this->client->patch($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
                RequestOptions::BODY => json_encode($data)
            ]);

            return [];
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param string $planId
     * @return array
     */
    public function activatePlan(string $planId): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans/' . $planId . '/activate';

            $this->client->post($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return [];
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param string $planId
     * @return array
     */
    public function deactivatePlan(string $planId): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans/' . $planId . '/deactivate';

            $this->client->post($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ]
            ]);

            return [];
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }

    /**
     * @param string $planId
     * @param array $data
     * @return array
     */
    public function updatePricingSchemesPlan(string $planId, array $data): array
    {
        try {
            if ($this->authorization->getAccessToken() === null) {
                $this->authorization->setAccessToken();
            }

            $token = $this->authorization->getAccessToken();

            $uri = '/v1/billing/plans/' . $planId . '/update-pricing-schemes';

            $this->client->post($uri, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
                RequestOptions::BODY => json_encode($data)
            ]);

            return [];
        } catch (RequestException $e) {
            $message = '{}';
            if (null !== $e->getResponse()) {
                $message = $e->getResponse()->getBody()->getContents();
            }

            return json_decode($message, true);
        }
    }
}
