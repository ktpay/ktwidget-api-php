<?php
namespace KTpay\Api\Traits;

trait SodiumCrypt
{
    /**
     *
     * @param string $key
     * @param array $data
     * @return string
     */
    public function encrypt(string $key, array $data): string
    {
        return base64_encode(
            sodium_crypto_box_seal(
                $this->toJsonString($data),
                base64_decode($key)
            )
        );
    }

    /**
     *
     * @param string $key
     * @param string $encrypted
     * @return bool
     */
    public function decrypt(string $key, string $encrypted): bool
    {
        $jsonString = sodium_crypto_box_seal_open($encrypted, base64_decode($key));

        if (!empty($jsonString)) {
            return json_decode($jsonString, JSON_UNESCAPED_UNICODE);
        }

    }

    public function toJsonString(array $data = []): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}