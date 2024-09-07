<?php

namespace AppHumanResources\Attendance\Application;

class GroupByOwnersService
{
    public function groupByOwners(array $files): array
    {
        $groupedFiles = [];

        foreach ($files as $file => $owner) {
            if (!isset($groupedFiles[$owner])) {
                $groupedFiles[$owner] = [];
            }
            $groupedFiles[$owner][] = $file;
        }

        return $groupedFiles;
    }
}
