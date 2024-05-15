<?php

namespace Rahat1994\SparkcommerceMultivendor\Commands;

use Illuminate\Console\Command;

class SparkcommerceMultivendorCommand extends Command
{
    public $signature = 'sparkcommerce-multivendor';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
