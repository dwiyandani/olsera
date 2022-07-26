<?php

namespace Modules\ApiV1\Services\Implements;

use App\Models\Item;
use App\Models\Pajak;
use Exception;
use Illuminate\Support\Facades\DB;
use Modules\ApiV1\Services\ItemService;
use PhpParser\Node\Expr\Cast\Object_;

class ItemServiceImplements implements ItemService
{
    public function list():Object
    {
        $data = Item::with(['pajak'])->get();

        return $data;
    }

    public function create(Object $request):Bool{

        try {

            $item = new Item();
            $item->nama = $request->nama_item;
            $item->save();

            for ($i=0; $i < count($request->nama_pajak); $i++) {

                $pajak = new Pajak();
                $pajak->nama = $request->nama_pajak[$i];
                $pajak->rate = $request->rate[$i];
                $pajak->item_id = $item->id;
                $pajak->save();
            }

            return true;

        } catch (Exception $e) {

            throw new Exception($e->getMessage(), 1);
        }

    }

    public function update(Int $id, Object $request):Object{

        DB::beginTransaction();
        try {

            $item = Item::find($id);
            $item->nama = $request->nama_item;
            $item->save();

            for ($i=0; $i < count($request->pajak_id); $i++) {

                $pajak = Pajak::find($request->pajak_id[$i]);
                $pajak->nama = $request->nama_pajak[$i];
                $pajak->rate = $request->rate[$i];
                $pajak->item_id = $item->id;
                $pajak->save();
            }

            return Item::with(['pajak'])->where('id',$id)->get();

        } catch (Exception $e) {

            throw new Exception($e->getMessage(), 1);
        }

    }

    public function destroy(Int $id):Bool
    {
        DB::beginTransaction();

        try {
            Item::destroy($id);

            $pajak = Pajak::where('item_id',$id)->get();

            foreach ($pajak as $pj ) {
                Pajak::destroy($pj->id);
            }

            DB::commit();

            return true;

        } catch (Exception $e) {

            DB::rollBack();
            throw new Exception($e->getMessage(), 1);

        }
    }
}