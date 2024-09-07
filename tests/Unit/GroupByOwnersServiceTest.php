<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use AppHumanResources\Attendance\Application\GroupByOwnersService;

class GroupByOwnersServiceTest extends TestCase
{
    public function testGroupByOwners()
    {
        $service = new GroupByOwnersService();

        $input = [
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B",
        ];

        $expectedOutput = [
            "Company A" => ["insurance.txt", "letter.docx"],
            "Company B" => ["Contract.docx"],
        ];

        $this->assertEquals($expectedOutput, $service->groupByOwners($input));
    }
}
