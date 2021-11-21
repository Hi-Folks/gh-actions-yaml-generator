<?php

namespace App\Objects;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ReportExecution
{
    private Collection $result;
    private int $idx = -1;

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

    public function addError(string $label, string $value): void
    {
        $this->add($label, $value, true, self::LINE_TYPE_ERROR);
    }

    public function addWarning(string $label, string $value): void
    {
        $this->add($label, $value, true, self::LINE_TYPE_WARNING);
    }
    /**
     * @param string $label
     * @param string|string[] $value
     * @param string $style
     * @psalm-param array<string>|string $value
     */
    public function addValue(string $label, $value, string $style = ""): void
    {
        if (is_array($value)) {
            $value = implode(",", $value);
        }
        if ($style !== "") {
            $value = sprintf("<%s>%s</%s>", $style, $value, $style);
        }
        $this->add($label, $value, true, self::LINE_TYPE_INFO);
    }

    /**
     * @param string $label
     * @param string|string[] $value
     * @psalm-param array<string>|string $value
     */
    public function addValueInfo(string $label, $value): void
    {
        $this->addValue($label, $value, "info");
    }
    /**
     * @param string $label
     * @param string|string[] $value
     * @psalm-param array<string>|string $value
     */
    public function addValueComment(string $label, $value): void
    {
        $this->addValue($label, $value, "comment");
    }


    public function addHint(string $value): void
    {
        $this->add("*** HINT", $value, true, self::LINE_TYPE_HINT);
    }
    public function addErrorAndHint(
        string $label,
        string $errorMessage,
        string $hintMessage
    ): void {
        $this->addError($label, $errorMessage);
        $this->addHint($hintMessage);
    }
    public function addWarningAndHint(
        string $label,
        string $warningMessage,
        string $hintMessage
    ): void {
        $this->addWarning($label, $warningMessage);
        $this->addHint($hintMessage);
    }
    public function addInfoAndHint(
        string $label,
        string $infoMessage,
        string $hintMessage
    ): void {
        $this->addValue($label, $infoMessage);
        $this->addHint($hintMessage);
    }

    public function add(
        string $label,
        string $value,
        bool $forceLine = false,
        string $lineType = self::LINE_TYPE_DEFAULT
    ): void {
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
    public static function isMessageLine(string $lineType): bool
    {
        return (($lineType === self::LINE_TYPE_ERROR) ||
            ($lineType === self::LINE_TYPE_WARNING) ||
            ($lineType === self::LINE_TYPE_INFO));
    }
    public static function isHintLine(string $lineType): bool
    {
        return ($lineType === self::LINE_TYPE_HINT);
    }

    /**
     * @return array<mixed>
     */
    public function toArrayLabelValue(): array
    {
        $retArray = [];
        foreach ($this->result as $r) {
            $label = Arr::get($r, "label", "");
            $value = Arr::get($r, "value", "");
            $retArray[] = ["label" => $label, "value" => $value];
        }
        return $retArray;
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->result->toArray();
    }
}
