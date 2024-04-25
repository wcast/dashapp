<?php

namespace App\Http\Middleware;

use App\Helpers\BreadcrumbHelper;
use App\Helpers\MenuHelper;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request)
    {
        $navmenu = new MenuHelper();

        $navmenu = json_encode(config('menu.default'));

        $breadcrumb = new BreadcrumbHelper();

        $breadcrumb = $breadcrumb->make();

        $companies = [];

        if(Auth::check()){
            $id = Auth::user()->id;
        }

        return array_merge(parent::share($request), [
            'config' => fn () => [
                'app' => [
                    'name' => config('app.name'),
                ],
            ],
            'flash' => [
                'error' => fn () => $request->session()->get('error'),
                'success' => fn () => $request->session()->get('success'),
                'notification' => fn () => $request->session()->get('notification')
            ],
            'companies' => $companies,
            'auth' => [
                'user' => $request->user(),
            ],
            'csrf' => csrf_token(),
            'navigation' => [
                'menu' => json_decode($navmenu),
                'breadcrumb' => $breadcrumb,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url()
                ]);
            },
        ]);
    }
}
