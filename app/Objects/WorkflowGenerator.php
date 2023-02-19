<?php

namespace App\Objects;

use App\Traits\Form\BaseWorkflow;
use App\Traits\Form\CodeQuality;
use App\Traits\Form\Deploy;
use App\Traits\Form\LaravelStuff;
use Composer\Semver\Semver;
use Illuminate\Support\Str;

class WorkflowGenerator
{
    use BaseWorkflow;
    use CodeQuality;
    use LaravelStuff;
    use Deploy;

    public const DB_TYPE_NONE = 'none';

    public const DB_TYPE_MYSQL = 'mysql';

    public const DB_TYPE_SQLITE = 'sqlite';

    public const DB_TYPE_POSTGRESQL = 'postgresql';

    public function loadDefaults(): void
    {
        $this->loadDefaultsBaseWorkflow();
        $this->loadDefaultsCodeQuality();
        $this->loadDefaultsLaravelStuff();
        $this->loadDefaultsDeploy();
    }

    /**
     * @return array<mixed>
     */
    public static function compactObject(object $object, string ...$args): array
    {
        $vars = get_object_vars($object);
        $retVal = [];
        foreach ($args as $arg) {
            if (array_key_exists($arg, $vars)) {
                $retVal[$arg] = $vars[$arg];
            } elseif (array_key_exists(Str::camel($arg), $vars)) {
                $retVal[$arg] = $vars[Str::camel($arg)];
            }
        }

        return $retVal;
    }

    /**
     * @param  array<mixed>  $array
     */
    public static function arrayToString(array $array): string
    {
        return '[ '.implode(
            ',',
            array_map(
                function ($str) {
                    return "'$str'";
                },
                $array
            )
        ).' ]';
    }

    /**
     * @param  array<mixed>|string  $somethingToSplit
     * @return array<mixed>|mixed
     */
    public static function split($somethingToSplit, string $splitChars = ',')
    {
        if (\is_string($somethingToSplit)) {
            return array_map('trim', explode($splitChars, $somethingToSplit));
        }

        return $somethingToSplit;
    }

    /**
     * @return array<mixed>
     */
    public function setData(): array
    {
        $data = [];
        $data = $this->setDataBaseWorkflow($data);
        $data = $this->setDataCodeQuality($data);
        $data = $this->setDataLaravelStuff($data);
        $data = $this->setDeployData($data);

        return $data;
    }

    /**
     * @param  array<mixed>  $data
     * @return array<mixed>|string
     */
    public function generate(array $data)
    {
        $stringResult = view('action_yaml', $data)->render();

        return $stringResult;
    }

    /**
     * @return string[]
     *
     * @psalm-return list<'7.3'|'7.4'|'8.0'|'8.1'>
     */
    public function detectPhpVersion(string $phpversion): array
    {
        $listPhpVersions = ['7.3', '7.4', '8.0', '8.1'];
        $stepPhp = [];
        foreach ($listPhpVersions as $php) {
            if (Semver::satisfies($php, $phpversion)) {
                $stepPhp[] = $php;
            }
        }
        $this->stepPhpVersions = $stepPhp;

        return $stepPhp;
    }

    /**
     * Detect cache, for now the behavior is to disable cache
     */
    public function detectCache(bool $cache): void
    {
        $this->stepCacheNpmModules = $cache;
        $this->stepCachePackages = $cache;
        $this->stepCacheVendors = $cache;
    }

    /**
     * @return string[]
     *
     * @psalm-return array<string, string>
     */
    public function readDotEnv(string $fileEnv): array
    {
        $envConfiguration = [];
        if (! is_readable($fileEnv)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $fileEnv));
        }

        $lines = file($fileEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            $envConfiguration[$name] = $value;
        }

        return $envConfiguration;
    }

    public function readNvmrc(string $fileNvmrc): string
    {
        if (! is_readable($fileNvmrc)) {
            return '';
        }

        $lines = file($fileNvmrc, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            return $line;
        }

        return '';
    }
}
