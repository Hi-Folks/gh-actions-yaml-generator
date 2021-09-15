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

    /**
     * @return Configuration|null|static
     */
    public static function getByCode(string $code)
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

    public function isSqlite(): bool
    {
        if (isset($this->configuration->databaseType)) {
            return $this->configuration->databaseType === "sqlite";
        }
        return false;
    }

    public function isPostgresqlService(): bool
    {
        if (isset($this->configuration->databaseType)) {
            return $this->configuration->databaseType === "postgresql";
        }
        return false;
    }


    public function getDatabaseType(): string
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

    public static function saveConfiguration(string $code, $json, $metadata = "{}"): void
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
