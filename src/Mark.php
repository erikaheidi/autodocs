<?php

declare(strict_types=1);

namespace Autodocs;

class Mark
{
    /**
     * Expected format: $content = [
     *     0 => [ col1, col2, col3 ...]
     *     1 => [ col1, col2, col3 ...]
     * ];
     * @param array $content
     * @param array|null $headers
     * @return string
     */
    public static function table(array $content, ?array $headers = []): string
    {
        $table = "";
        $colSizes = Mark::calculateCols(array_merge($content, [$headers]));

        if ($headers) {
            $table .= Mark::sprintHeaders($headers, $colSizes)."\n";
        }

        foreach ($content as $row) {
            $table .= Mark::sprintRow($row, $colSizes)."\n";
        }

        return $table;
    }

    /**
     * @param array $headers
     * @param array $colSizes
     * @return string
     */
    public static function sprintHeaders(array $headers, array $colSizes): string
    {
        $table = self::sprintRow($headers, $colSizes)."\n";

        foreach ($colSizes as $col => $size) {
            if (0 === $col) {
                $table .= "|";
            }
            $table .= str_pad("", $size + 2, "-")."|";
        }

        return $table;
    }

    /**
     * @param array $row
     * @param array $colSizes
     * @return string
     */
    public static function sprintRow(array $row, array $colSizes): string
    {
        $mdRow = "";
        foreach ($row as $col => $value) {
            if (0 === $col) {
                $mdRow .= "|";
            }
            $mdRow .= " ".str_pad($value, $colSizes[$col], " ")." |";
        }

        return $mdRow;
    }


    /**
     * Expected format: $table = [
     *     0 => [ col1, col2, col3 ...]
     *     1 => [ col1, col2, col3 ...]
     * ];
     * @param array $table
     * @param array $minSizes
     * @return array
     */
    public static function calculateCols(array $table, array $minSizes = []): array
    {
        $colMap = $minSizes;

        foreach ($table as $row) {
            foreach ($row as $key => $value) {
                if ( ! isset($colMap[$key]) || mb_strlen($value) > $colMap[$key]) {
                    $colMap[$key] = mb_strlen($value);
                }
            }
        }

        return $colMap;
    }
}
