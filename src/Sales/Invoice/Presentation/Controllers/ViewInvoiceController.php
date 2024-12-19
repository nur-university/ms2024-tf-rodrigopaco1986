<?php

namespace Src\Sales\Invoice\Presentation\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Sales\Invoice\Application\Queries\GetInvoiceQuery;
use Src\Sales\Invoice\Application\Queries\Handlers\GetInvoiceHandler;
use Src\Sales\Invoice\Infraestructure\Repositories\InvoiceRepository;
use Src\Sales\Invoice\Presentation\Resources\InvoiceResource;

class ViewInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $id = $request->route('id');

        $queryInvoice = new GetInvoiceQuery($id);
        $queryInvoiceHandlerResponse = (new GetInvoiceHandler(new InvoiceRepository))
            ->handle($queryInvoice);

        if ($queryInvoiceHandlerResponse) {
            return new InvoiceResource($queryInvoiceHandlerResponse);
        }

        throw new HttpResponseException(response()->json([
            'errors' => 'Invoice not found',
        ], 404));
    }
}
