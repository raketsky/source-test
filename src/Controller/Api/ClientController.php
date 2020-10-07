<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\DTO\SourceResourceCollection;
use App\Request\Export\DownloadJsonRequest;
use App\Service\SourceService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class ClientController extends AbstractController
{
    /**
     * @Route("/tables/source/json", methods={"GET"}, name="getJson")
     *
     * @param DownloadJsonRequest $request
     * @param SourceService       $sourceService
     * @return JsonResponse
     */
    public function getJson(
        DownloadJsonRequest $request,
        SourceService $sourceService
    ): JsonResponse
    {
        $pageNr = $request->getPageNr();
        $itemsPerPage = $request->getLimit();

        $sourceItems = $sourceService->findLimited($pageNr, $itemsPerPage);
        if (!$sourceItems) {
            throw new NotFoundHttpException('Page not found');
        }

        $sourceResourceCollection = new SourceResourceCollection($sourceItems);

		return new JsonResponse($sourceResourceCollection->getJsonItemResponse());
    }
}
