<?php

namespace App\Link;

use App\Link\ValueObjects\Email;
use App\Link\ValueObjects\Url;

class Link
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var Email
     */
    private $email;

    /**
     * @param Url $url
     * @param Email $email
     */
    public function __construct(Url $url, Email $email)
    {
        $this->url = $url;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return (string)$this->url;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string)$this->email;
    }
}