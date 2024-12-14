<?php

namespace Src\Sales\Order\Presentation\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Src\Sales\Order\Application\Commands\CreateOrderCommand;
use Src\Sales\Order\Application\Commands\Handlers\CreateOrderHandler;
use Src\Sales\Order\Application\Services\ServiceService;
use Src\Sales\Order\Infraestructure\Repositories\OrderRepository;
use Src\Sales\Order\Presentation\Requests\CreateOrderRequest;
use Src\Sales\Order\Presentation\Resources\OrderResource;
use Src\Sales\Service\Infraestructure\Repositories\ServiceRepository;

class CreateOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateOrderRequest $request)
    {
        $validated = $request->validated();

        $patientId = $validated['patient_id'];
        $generateInvoice = $validated['generate_invoice'];
        $items = $validated['items'];

        $commandOrder = new CreateOrderCommand($patientId, $items, $generateInvoice);
        $commandOrderHandlerResponse = (new CreateOrderHandler(new OrderRepository, new ServiceService(new ServiceRepository)))
            ->handle($commandOrder);

        if ($commandOrderHandlerResponse) {
            return new OrderResource($commandOrderHandlerResponse);
        }

        throw new HttpResponseException(response()->json([
            'errors' => ['order' => 'Order not saved'],
        ], 422));
    }
}
