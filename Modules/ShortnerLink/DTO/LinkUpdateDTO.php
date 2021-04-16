<?php

namespace Modules\ShortnerLink\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\DataTransferObject\DataTransferObject;


class LinkUpdateDTO extends DataTransferObject
{
    public $main_link;
    public $id;


    public static function fromRequest(Request $request): self
    {
        return new self([
            'main_link' => (string) $request->get('main_link'),
            'id' => (int) $request->get('id'),
        ]);
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'main_link' => ['required', 'url', 'unique:links,main_link'],
            'id' => ['required', 'exists:links,id'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}
