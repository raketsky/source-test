<?php
declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AbstractController;
use App\Request\Export\DownloadJsonRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     *
     * @return StreamedResponse
     */
    public function home(): Response
    {
        $actions = [];
        $actions[] = [
            'title' => 'Download CSV',
            'label' => 'CSV',
            'link' => $this->generateUrl('downloadCsv'),
            'icon' => 'download',
        ];

        return $this->renderTemplate('home', [
            'actions' => $actions,
            'links' => $this->generateRandomJsonLinks(),
        ]);
    }

    private function generateRandomJsonLinks(int $limit = 5): array
    {
        $links = [];
        for ($i = 0; $i < $limit; $i++) {
            $pageNr = rand(1, 20);
            $itemsPerPage = rand(1, 50000);

            $link = $this->generateUrl('getJson', [
                DownloadJsonRequest::PAGE_NR => $pageNr,
                DownloadJsonRequest::LIMIT => $itemsPerPage,
            ]);
            $links[] = [
                'title' => sprintf('Download JSON with %d items starting from page %d', $itemsPerPage, $pageNr),
                'link' => $link,
            ];
        }

        return $links;
    }
}
