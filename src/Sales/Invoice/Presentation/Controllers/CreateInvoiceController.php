<?php

namespace Src\Sales\Invoice\Presentation\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Src\Sales\Invoice\Application\Commands\CreateInvoiceCommand;
use Src\Sales\Invoice\Application\Commands\Handlers\CreateInvoiceHandler;
use Src\Sales\Invoice\Application\Services\OrderService;
use Src\Sales\Invoice\Application\Services\PatientService;
use Src\Sales\Invoice\Application\Services\ServiceService;
use Src\Sales\Invoice\Infraestructure\Repositories\InvoiceRepository;
use Src\Sales\Invoice\Presentation\Requests\CreateInvoiceRequest;
use Src\Sales\Invoice\Presentation\Resources\InvoiceResource;
use Src\Sales\Order\Infraestructure\Repositories\OrderRepository;
use Src\Sales\Patient\Infraestructure\Repositories\PatientRepository;
use Src\Sales\Service\Infraestructure\Repositories\ServiceRepository;

class CreateInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateInvoiceRequest $request)
    {
        $validated = $request->validated();

        $orderId = $validated['order_id'] ?? null;
        $customerId = $validated['customer_id'] ?? '';

        $commandInvoice = new CreateInvoiceCommand($orderId, $customerId);
        $commandInvoiceHandlerResponse = (new CreateInvoiceHandler(
            new InvoiceRepository,
            new OrderService(new OrderRepository),
            new PatientService(new PatientRepository),
            new ServiceService(new ServiceRepository),
        )
        )
            ->handle($commandInvoice);

        if ($commandInvoiceHandlerResponse) {
            return new InvoiceResource($commandInvoiceHandlerResponse);
        }

        throw new HttpResponseException(response()->json([
            'errors' => ['invoice' => 'Invoice not saved'],
        ], 422));
    }
}
