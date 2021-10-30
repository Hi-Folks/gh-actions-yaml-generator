<?php

namespace App\Objects;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ReportExecution
{
    private Collection $result;
    private $idx = -1;

    public const LINE_TYPE_ERROR   = 'error';
    public const LINE_TYPE_WARNING = 'warning';
    public const LINE_TYPE_INFO = 'info';
    public const LINE_TYPE_HINT    = 'hint';
    public const LINE_TYPE_DEFAULT = 'default';


    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->result = collect();
        $this->idx = -1;
    }

    public function addError($label, $value): void
    {
        $this->add($label, $value, true, self::LINE_TYPE_ERROR);
    }

    public function addWarning($label, $value): void
    {
        $this->add($label, $value, true, self::LINE_TYPE_WARNING);
    }
    public function addInfo($label, $value): void
    {
        if (is_array($value)) {
            $value = implode(",", $value);
        }
        $this->add($label, $value, true, self::LINE_TYPE_INFO);
    }


    public function addHint($value): void
    {
        $this->add("*** HINT", $value, true, self::LINE_TYPE_HINT);
    }
    public function addErrorAndHint($label, $errorMessage, $hintMessage): void
    {
        $this->addError($label, $errorMessage);
        $this->addHint($hintMessage);
    }
    public function addWarningAndHint($label, $warningMessage, $hintMessage): void
    {
        $this->addWarning($label, $warningMessage);
        $this->addHint($hintMessage);
    }
    public function addInfoAndHint($label, $infoMessage, $hintMessage): void
    {
        $this->addInfo($label, $infoMessage);
        $this->addHint($hintMessage);
    }

    public function add($label, $value, $forceLine = false, $lineType = self::LINE_TYPE_DEFAULT): void
    {
        $this->result->push(
            [
                "label" => $label,
                "value" => $value,
                "isLine" => $forceLine,
                "lineType" => $lineType
            ]
        );
        $this->idx++;
    }

    /**
     * @return bool
     */
    public static function isMessageLine(string $lineType)
    {
        return (($lineType === self::LINE_TYPE_ERROR) ||
            ($lineType === self::LINE_TYPE_WARNING) ||
            ($lineType === self::LINE_TYPE_INFO));
    }
    public static function isHintLine($lineType): bool
    {
        return ($lineType === self::LINE_TYPE_HINT);
    }

    public function toArrayLabelValue()
    {
        $retArray = [];
        foreach ($this->result as $r) {
            $label = Arr::get($r, "label", "");
            $value = Arr::get($r, "value", "");
            $retArray[] = ["label" => $label, "value" => $value];
        }
        return $retArray;
    }
    public function toArray()
    {
        return $this->result->toArray();
    }
}
