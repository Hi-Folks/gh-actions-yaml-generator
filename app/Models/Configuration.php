<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $casts = [
        'configuration' => 'object',
    ];

    public static function getByCode($code)
    {
        return self::firstWhere('code', $code);
    }

    public function isMysqlService()
    {
        if (isset($this->configuration->mysqlService)) {
            return $this->configuration->mysqlService;
        }
        return $this->configuration->databaseType === "mysql";
    }

    public function isSqlite()
    {
        if (isset($this->configuration->databaseType)) {
            return $this->configuration->databaseType === "sqlite";
        }
        return false;
    }

    public function isPostgresqlService()
    {
        if (isset($this->configuration->databaseType)) {
            return $this->configuration->databaseType === "postgresql";
        }
        return false;
    }


    public function getDatabaseType()
    {
        if ($this->isMysqlService()) {
            return "Mysql";
        }
        if ($this->isPostgresqlService()) {
            return "Postgresql";
        }
        if ($this->isSqlite()) {
            return "Sqlite";
        }
        return "";
    }

    public static function saveConfiguration($code, $json, $metadata = "{}")
    {
        $confModel = self::getByCode($code);

        if (! $confModel) {
            $confModel = new self();
            $confModel->code = $code;
            $confModel->configuration = $json;
            $confModel->metadata = $metadata;
            $confModel->counts = 0;
        }

        $confModel->counts = $confModel->counts + 1;

        $confModel->save();

        LogConfiguration::create([
            'code' => $code,
        ]);
    }
}
