<?php

namespace Src\Sales\Order\Presentation\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Src\Sales\Order\Application\Queries\GetOrderQuery;
use Src\Sales\Order\Application\Queries\Handlers\GetOrderHandler;
use Src\Sales\Order\Infraestructure\Repositories\OrderRepository;
use Src\Sales\Order\Presentation\Resources\OrderResource;

class ViewOrderController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $id = $request->route('id');

        $queryOrder = new GetOrderQuery($id);
        $queryOrderHandlerResponse = (new GetOrderHandler(new OrderRepository))
            ->handle($queryOrder);

        if ($queryOrderHandlerResponse) {
            return new OrderResource($queryOrderHandlerResponse);
        }

        throw new HttpResponseException(response()->json([
            'errors' => 'Order not found',
        ], 404));
    }
}
