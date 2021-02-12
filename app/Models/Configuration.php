<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    public static function getByCode($code)
    {
        return self::firstWhere('code', $code);
    }

    public static function saveConfiguration($code, $json, $metadata = "{}")
    {
        $confModel = self::getByCode($code);

        if (! $confModel) {
            $confModel = new self;
            $confModel->code = $code;
            $confModel->configuration = $json;
            $confModel->metadata = $metadata;
            $confModel->counts = 0;
        }

        $confModel->counts = $confModel->counts + 1;

        $confModel->save();


    }
}
