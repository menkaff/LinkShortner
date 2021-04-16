<?php

namespace Modules\ShortnerLink\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ShortnerLink\Database\factories\LinkFactory;

/**
 * @property int $id
 */
class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected static function newFactory()
    {
        return LinkFactory::new();
    }

    public function getNextId()
    {
        $last_link =  Link::orderBy("id", "DESC")->select("id")->first();
        if ($last_link) {
            return ++$last_link->id;
        } else {
            return 1000000;
        }
    }
}
