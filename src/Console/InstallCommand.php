<?php

namespace WCast\Dashapp\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

#[AsCommand(name: 'dashapp:install')]
class InstallCommand extends Command implements PromptsForMissingInput
{
   // use InstallsApiStack, InstallsBladeStack, InstallsInertiaStacks, InstallsLivewireStack;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashapp:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instalação do painel genérico';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        print "OK Dash";

        return 1;
    }
}
