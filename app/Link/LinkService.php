<?php

namespace App\Link;

use App\Link\Repositories\LinkRepository;
use Illuminate\Contracts\Logging\Log;
use App\Link\Exceptions\InvalidUrlException;
use App\Link\Exceptions\InvalidEmailException;
use App\Link\ValueObjects\Url;
use App\Link\ValueObjects\Email;

class LinkService
{
    /**
     * @var LinkRepository
     */
    private $linkRepository;

    /**
     * @var Log
     */
    private $log;

    /**
     * @param LinkRepository $linkRepository
     * @param Log $log
     */
    public function __construct(LinkRepository $linkRepository, Log $log)
    {
        $this->linkRepository = $linkRepository;
        $this->log = $log;
    }

    /**
     * @param string $url
     * @param string $email
     * @return bool
     */
    public function save(string $url, string $email)
    {
        try {
            $url = new Url($url);
        } catch (InvalidUrlException $invalidUrlException) {
            $this->log->error('Invalid URL', $invalidUrlException->getTrace());

            return false;
        }

        try {
            $email = new Email($email);
        } catch (InvalidEmailException $invalidEmailException) {
            $this->log->error('Invalid Email', $invalidEmailException->getTrace());

            return false;
        }

        $link = new Link($url, $email);

        return $this->linkRepository->create($link);
    }
}