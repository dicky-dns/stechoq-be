<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ReportData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $status,
        public ?string $start_date,
        public ?string $end_date,
        public ?UserData $manager,
    ) {}
}
