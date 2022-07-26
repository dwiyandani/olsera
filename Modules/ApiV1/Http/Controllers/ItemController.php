<?php

namespace Modules\ApiV1\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\ApiV1\Http\Requests\ItemCreateRequest;
use Modules\ApiV1\Http\Requests\ItemUpdateRequest;
use Modules\ApiV1\Services\ItemService;

class ItemController extends Controller
{
    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Show all data.
     * @return Json
     */
    public function list()
    {
        $data = $this->itemService->list();

        return response()->json([
            'status' => true,
            'data' => $data
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Json
     */
    public function store(ItemCreateRequest $request)
    {

        DB::beginTransaction();

        try {

            $request->validated();

            if(count($request->nama_pajak) < 2) throw new Exception("nama pajak min 2", 1);
            if(count($request->rate) < 2) throw new Exception("rate pajak min 2", 1);


            $this->itemService->create($request);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan.'
            ],200);

        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Json
     */
    public function update(ItemUpdateRequest $request, $id)
    {
        try {

            $request->validated();

            $data = $this->itemService->update($id, $request);

            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Json
     */
    public function destroy($id)
    {
        try {

            $data = $this->itemService->destroy($id);

            return response()->json([
                'status' => true,
                'message' => "Data berhasil dihapus"
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}