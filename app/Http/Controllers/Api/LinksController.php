<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkStoreRequest;
use App\Link\LinkService;
use Illuminate\Http\JsonResponse;

class LinksController extends Controller
{
    /**
     * @var LinkService
     */
    private $linkService;

    /**
     * @param LinkService $linkService
     */
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * @param LinkStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LinkStoreRequest $request): JsonResponse
    {
        if (false === $this->linkService->save($request->get('url'), $request->get('email'))) {
            return response()->json(['message' => 'URL couldn\'t saved'], 400);
        }

        return response()->json([], 201);
    }
}
