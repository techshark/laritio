<?php
declare(strict_types=1);

namespace TechShark\Laritio\Managers;

/**
 * Class PublitioManager
 *
 * @author Tyler Brennan < info@techshark.nl >
 * @version 1.0
 */
class LaritioManager
{
    /**
     * @var string
     */
    private $version;
    /**
     * @var string
     */
    private $publicKey;
    /**
     * @var string
     */
    private $privateKey;
    /**
     * @var string
     */
    private $library;
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return LaritioManager
     */
    public function setVersion(string $version): LaritioManager
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     *
     * @return LaritioManager
     */
    public function setPublicKey(string $publicKey): LaritioManager
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey
     *
     * @return LaritioManager
     */
    public function setPrivateKey(string $privateKey): LaritioManager
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getLibrary(): string
    {
        return $this->library;
    }

    /**
     * @param string $library
     *
     * @return LaritioManager
     */
    public function setLibrary(string $library): LaritioManager
    {
        $this->library = $library;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return LaritioManager
     */
    public function setEndpoint(string $endpoint): LaritioManager
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
