<?php

namespace Wcast\Dashapp\Console;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

trait InstallsInertiaStacks
{
    /**
     * Install the Inertia Vue Breeze stack.
     *
     * @return int|null
     */
    protected function installInertiaVueStack()
    {
        // Install Inertia...
        if (!$this->requireComposerPackages(['inertiajs/inertia-laravel:^1.0', 'laravel/sanctum:^4.0', 'tightenco/ziggy:^2.0'])) {
            return 1;
        }

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                '@inertiajs/vue3' => '^1.0.0',
                '@inertiajs/progress' => '^0.1.2',
                '@vitejs/plugin-vue' => '^5.0.0',
                'autoprefixer' => '^10.4.12',
                'postcss' => '^8.4.31',
                '@devindex/vue-mask' => '^2.0.3',
                '@popperjs/core' => '^2.11.8',
                '@sweetalert2/theme-bootstrap-4' => '^5.0.16',
                'bootstrap' => '^5.3.3',
                'bootstrap-icons' => '^1.11.3',
                'chart' => '^0.1.2',
                'feather-icons' => '^4.29.1',
                'flatpickr' => '^4.6.13',
                'jquey' => '^0.0.1-security',
                'jsvectormap' => '^1.5.3',
                'lodash' => '^4.17.21',
                'metismenu' => '^3.0.7',
                'mitt' => '^3.0.1',
                'rollup-plugin-copy' => '^3.5.0',
                'sass' => '^1.72.0',
                'simplebar-vue' => '^2.3.3',
                'sweetalert2' => '^11.6.13',
                'v-mask' => '^2.3.0',
                'vue-draggable-next' => '^2.2.1',
                'vue-multiselect' => '^2.1.9',
                'vue3-select2-component' => '^0.1.7',
                'vue3-summernote-editor' => '^1.0.2',
                'vue' => '^3.4.0',
            ] +$packages;
        });

        // Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia-common/app/Http/Controllers', app_path('Http/Controllers'));

        // Requests...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Requests'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/default/app/Http/Requests', app_path('Http/Requests'));

        // Middleware...
        $this->installMiddleware([
            '\App\Http\Middleware\HandleInertiaRequests::class',
            '\Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class',
        ]);

        (new Filesystem)->ensureDirectoryExists(app_path('Http/Middleware'));
        copy(__DIR__ . '/../../stubs/inertia-common/app/Http/Middleware/HandleInertiaRequests.php', app_path('Http/Middleware/HandleInertiaRequests.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Http/Middleware/MakeMenu.php', app_path('Http/Middleware/MakeMenu.php'));

        // Views...
        copy(__DIR__ . '/../../stubs/inertia-vue/resources/views/app.blade.php', resource_path('views/app.blade.php'));

        @unlink(resource_path('views/welcome.blade.php'));

        //Admin Helpers
        (new Filesystem)->ensureDirectoryExists(app_path('Helpers'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/BreadcrumbHelper.php', app_path('Helpers/BreadcrumbHelper.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/DataFormat.php', app_path('Helpers/DataFormat.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/DataUtilities.php', app_path('Helpers/DataUtilities.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/DataValidation.php', app_path('Helpers/DataValidation.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/File.php', app_path('Helpers/File.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/GitHelper.php', app_path('Helpers/GitHelper.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/MakePDF.php', app_path('Helpers/MakePDF.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Helpers/MenuHelper.php', app_path('Helpers/MenuHelper.php'));

        //Admin Controllers
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers/Admin'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Http/Controllers/Admin/DashboardController.php', app_path('Http/Controllers/Admin/DashboardController.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Http/Controllers/Admin/ProfileController.php', app_path('Http/Controllers/Admin/ProfileController.php'));
        copy(__DIR__ . '/../../stubs/dashboard/app/Http/Controllers/Admin/UserController.php', app_path('Http/Controllers/Admin/UserController.php'));

        // Components + Pages...
        (new Filesystem)->ensureDirectoryExists(resource_path('js/apps'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/libs'));
        (new Filesystem)->ensureDirectoryExists(resource_path('js/modules'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia-vue/resources/js/apps', resource_path('js/apps'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia-vue/resources/js/layouts', resource_path('js/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia-vue/resources/js/libs', resource_path('js/libs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/inertia-vue/resources/js/modules', resource_path('js/modules'));

        if (!$this->option('dark')) {
            $this->removeDarkClasses((new Finder)
                ->in(resource_path('js'))
                ->name('*.vue')
                ->notName('Welcome.vue')
            );
        }

        // Routes...
        copy(__DIR__ . '/../../stubs/inertia-common/routes/web.php', base_path('routes/web.php'));
        copy(__DIR__ . '/../../stubs/inertia-common/routes/auth.php', base_path('routes/auth.php'));

        // Tailwind / Vite...
        copy(__DIR__ . '/../../stubs/default/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__ . '/../../stubs/default/postcss.config.js', base_path('postcss.config.js'));
        copy(__DIR__ . '/../../stubs/inertia-vue/vite.config.js', base_path('vite.config.js'));

        copy(__DIR__ . '/../../stubs/inertia-common/jsconfig.json', base_path('jsconfig.json'));
        copy(__DIR__ . '/../../stubs/inertia-vue/resources/js/app.js', resource_path('js/app.js'));

        $this->components->info('Installing and building Node dependencies.');

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }

        $this->line('');
        $this->components->info('Dashapp scaffolding installed successfully.');
    }

    /**
     * Configure Ziggy for SSR.
     *
     * @return void
     */
    protected function configureZiggyForSsr()
    {
        $this->replaceInFile(
            <<<'EOT'
            use Inertia\Middleware;
            EOT,
            <<<'EOT'
            use Inertia\Middleware;
            use Tighten\Ziggy\Ziggy;
            EOT,
            app_path('Http/Middleware/HandleInertiaRequests.php')
        );

        $this->replaceInFile(
            <<<'EOT'
                        'auth' => [
                            'user' => $request->user(),
                        ],
            EOT,
            <<<'EOT'
                        'auth' => [
                            'user' => $request->user(),
                        ],
                        'ziggy' => fn () => [
                            ...(new Ziggy)->toArray(),
                            'location' => $request->url(),
                        ],
            EOT,
            app_path('Http/Middleware/HandleInertiaRequests.php')
        );

        if ($this->option('typescript')) {
            $this->replaceInFile(
                <<<'EOT'
                export interface User {
                EOT,
                <<<'EOT'
                import { Config } from 'ziggy-js';

                export interface User {
                EOT,
                resource_path('js/types/index.d.ts')
            );

            $this->replaceInFile(
                <<<'EOT'
                    auth: {
                        user: User;
                    };
                EOT,
                <<<'EOT'
                    auth: {
                        user: User;
                    };
                    ziggy: Config & { location: string };
                EOT,
                resource_path('js/types/index.d.ts')
            );
        }
    }
}
