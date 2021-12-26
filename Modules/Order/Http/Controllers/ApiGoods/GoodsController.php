<?php

namespace Modules\Order\Http\Controllers\ApiGoods;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderItem;
use Modules\Order\Http\Requests\ApiGood\GoodRequest;

/**
 * Get an order by ID, a list of orders
 * @package Modules\Order\Http\Controllers\ApiGoods
 * @OA\Tag(name="Order")
 */
class GoodsController extends Controller
{
    /**
     * Display the specified resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * @OA\Get(
     * path="/api/order",
     *   tags={"Order"},
     *   summary="Orders",
     *   security={{ "Bearer":{} }},
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request(something wrong with URL or parameters)"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Logged in but access to requested area is forbidden"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity (validation failed)"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="General server error"
     *      )
     *)
     **/
    /**
     * Order api
     *
     *
     */

    public function index()
    {
        try {
            $orders = Order::with('goods')->whereHas('goods',)
                ->get();
            if ($orders) {
                return response()->json(['orders' => $orders], 200);

            } else {
                throw new \Exception('Entry for not found');
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Entry for not found',
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */


    public function store(GoodRequest $request)
    {
//        $validated = $request->validated();
//
//        return OrderItem::create($validated);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * @OA\Get(
     * path="/api/order/show/{id}",
     * summary="Viewing an order by ID",
     * description="Enter the order ID",
     * operationId="Orders",
     * tags={"Order"},
     * security={{ "Bearer":{} }},
     *
     *
     * @OA\Parameter(
     *    description="ID of order",
     *    in="path",
     *    name="id",
     *    required=true,
     *    @OA\Schema(
     *       type="integer",
     *    )
     * ),
     *
     *      @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request(something wrong with URL or parameters)"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Logged in but access to requested area is forbidden"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity (validation failed)"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="General server error"
     *      )
     *)
     **/
    /**
     * Order api
     *
     *
     */

    public function show($id)
    {
        try {
            $order = Order::where(['id' => $id])->with('goods')->first();
            if ($order) {
                return response()->json(['orders' => $order], 200);
            } else {
                throw new \Exception('Entry for not found');
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Entry for not found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
