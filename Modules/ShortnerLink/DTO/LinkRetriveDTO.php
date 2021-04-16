<?php

namespace Modules\ShortnerLink\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Validator;

class LinkRetriveDTO extends DataTransferObject
{
    public $short_link;


    public static function fromParam(string $short_link): self
    {

        return new self([
            'short_link' => (string) $short_link,
        ]);
    }

    public function validate()
    {
        $validator = Validator::make($this->toArray(), [
            'short_link' => ['required'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }
}
