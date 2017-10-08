<?php

namespace App\Link\ValueObjects;

use App\Link\Exceptions\InvalidUrlException;

final class Url
{
    /**
     * @var string
     */
    private $url;

    /**
     * @param string $url
     * @throws \App\Link\Exceptions\InvalidUrlException
     */
    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL, [FILTER_FLAG_SCHEME_REQUIRED, FILTER_FLAG_HOST_REQUIRED])) {
            throw new InvalidUrlException('The specified URL is invalid');
        }

        $this->url = $url;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->url;
    }
}