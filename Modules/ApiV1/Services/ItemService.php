<?php

namespace Modules\ApiV1\Services;

interface ItemService
{
    public function list():Object;

    public function create(Object $params):Bool;

    public function update(Int $id,Object $params):Object;

    public function destroy(Int $id):Bool;
}
