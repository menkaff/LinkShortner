<?php

namespace Modules\ShortnerLink\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Validator;

class LinkStoreDTO extends DataTransferObject
{
    public $main_link;


    public static function fromRequest(Request $request): self
    {
        return new self([
            'main_link' => (string) $request->get('main_link'),
        ]);
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'main_link' => ['required', 'url'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}
