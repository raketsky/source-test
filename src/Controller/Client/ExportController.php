<?php
declare(strict_types=1);

namespace App\Controller\Client;

use App\Component\BulkGenerator\BulkGenerator;
use App\Component\BulkGenerator\Writer\FileStreamedResponseWriter;
use App\Controller\AbstractController;
use App\Service\SourceService;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

final class ExportController extends AbstractController
{
    /**
     * @Route("/tables/source/csv", methods={"GET"}, name="downloadCsv")
     *
     * @param SourceService              $sourceService
     * @param BulkGenerator              $bulkGenerator
     * @param FileStreamedResponseWriter $fileStreamedResponseWriter
     * @return StreamedResponse
     */
    public function downloadCsv(
        SourceService $sourceService,
        BulkGenerator $bulkGenerator,
        FileStreamedResponseWriter $fileStreamedResponseWriter
    ): StreamedResponse
    {
        $sourceItems = $sourceService->findAll();

        $bulkGenerator->setWriter($fileStreamedResponseWriter);
        $response = new StreamedResponse(function () use ($sourceItems, $bulkGenerator) {
            $bulkGenerator->generate($sourceItems);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        // Setting this header instructs Nginx to disable fastcgi_buffering and disable
        // gzip for this request.
        $response->headers->set('X-Accel-Buffering', 'no');

        $fileName = $this->generateFileName('csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

		return $response;
    }

    private function generateFileName(string $extension): string
    {
        $datetime = new \DateTimeImmutable();

        return sprintf('source_%s.%s', $datetime->format('Ymd_His'), $extension);
    }
}
