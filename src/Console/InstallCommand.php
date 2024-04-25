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
    use InstallsInertiaStacks;

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
        return $this->installInertiaVueStack();
    }


    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }
}
