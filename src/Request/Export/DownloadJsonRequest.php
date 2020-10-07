<?php
declare(strict_types=1);

namespace App\Request\Export;

use App\Request\RequestDTOInterface;
use App\Request\ParameterTraits\Limit;
use App\Request\ParameterTraits\PageNr;
use Symfony\Component\HttpFoundation\Request;

final class DownloadJsonRequest implements RequestDTOInterface
{
    use PageNr, Limit;

    public const PAGE_NR = 'page';
    public const LIMIT = 'limit';

    public function __construct(Request $request)
    {
        $pageNr = $request->query->getInt(static::PAGE_NR);
        $limit = $request->query->getInt(static::LIMIT);

        $this->setPageNr($pageNr);
        $this->setLimit($limit);
    }
}
