<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public string $activeClass = 'bg-blue-50 text-blue-600 font-semibold';
    public string $inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';

    public array $menu = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Check user role
        $user = Auth::user();

        // Define menu structure
        $this->menu = [
            // Single Menu
            [
                'type' => 'single',
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'routePattern' => 'dashboard',
            ],

            // Separator
            [
                'type' => 'separator',
            ],

            // Multi Menu - Rekam Medis
            [
                'type' => 'multi',
                'label' => 'Rekam Medis',
                'routePattern' => ['datamedis.*', 'identitaspasien.*'],
                'items' => [
                    [
                        'label' => 'Tambah Pemesanan',
                        'route' => 'datamedis.create.step1',
                        'requireRole' => ['admin', 'superadmin'],
                        'routePattern' => 'datamedis.create.*',
                    ],
                    [
                        'label' => 'Data Medis',
                        'route' => 'datamedis.index',
                        'requireRole' => ['admin', 'superadmin'],
                        'routePattern' => ['datamedis.index', 'datamedis.show', 'datamedis.edit'],
                    ],
                    [
                        'label' => 'Data Identitas Pasien',
                        'route' => 'identitaspasien.index',
                        'requireRole' => ['admin', 'superadmin'],
                        'routePattern' => 'identitaspasien.*',
                    ],
                    [
                        'label' => 'Rekam Medis',
                        'route' => 'mitra.bpjs.index',
                        'requireRole' => ['bpjs'],
                        'routePattern' => 'mitra.bpjs.*',
                    ],
                ],
            ],

            // Multi Menu - Master Data (Admin & SuperAdmin)
            [
                'type' => 'multi',
                'label' => 'Master Data',
                'routePattern' => ['frame.*', 'lensa.*', 'supplier.*', 'document.*', 'aksesoris.*'],
                'requireRole' => ['admin', 'superadmin'],
                'items' => [
                    [
                        'label' => 'Supplier',
                        'route' => 'supplier.index',
                        'routePattern' => 'supplier.*',
                        'requireRole' => ['admin', 'superadmin'],
                    ],
                    [
                        'label' => 'Frame',
                        'route' => 'frame.index',
                        'routePattern' => 'frame.*',
                        'requireRole' => ['admin', 'superadmin'],
                    ],
                    [
                        'label' => 'Aksesoris',
                        'route' => 'aksesoris.index',
                        'routePattern' => 'aksesoris.*',
                        'requireRole' => ['admin', 'superadmin'],
                    ],
                    [
                        'label' => 'Lensa',
                        'route' => 'lensa.index',
                        'routePattern' => 'lensa.*',
                        'requireRole' => ['admin', 'superadmin'],
                    ],
                    [
                        'label' => 'Kebutuhan Dokumen',
                        'route' => 'document.index',
                        'routePattern' => 'document.*',
                        'requireRole' => 'superadmin',
                    ],
                ],
            ],

            // Multi Menu - Manajemen Pengguna (SuperAdmin only)
            [
                'type' => 'multi',
                'label' => 'Manajemen Pengguna',
                'routePattern' => 'admin.*',
                'requireRole' => 'superadmin',
                'items' => [
                    [
                        'label' => 'Data Pengguna',
                        'route' => 'admin.index',
                        'routePattern' => 'admin.*',
                    ],
                ],
            ],

            // Separator (SuperAdmin only)
            [
                'type' => 'separator',
                'requireRole' => 'superadmin',
            ],

            // Single Menu - Pengaturan (SuperAdmin only)
            [
                'type' => 'single',
                'label' => 'Pengaturan',
                'route' => 'pengaturan.index',
                'routePattern' => 'pengaturan.*',
                'requireRole' => 'superadmin',
            ],
        ];
    }

    /**
     * Check if a route is active
     */
    public function isRouteActive(string|array $pattern): bool
    {
        $patterns = is_array($pattern) ? $pattern : [$pattern];
        return request()->routeIs(...$patterns);
    }

    /**
     * Check if user has required role
     */
    public function hasRequiredRole(string|array|null $role): bool
    {
        if (!$role) {
            return true;
        }

        $user = Auth::user();
        if (!$user) {
            return false;
        }

        $requiredRoles = is_array($role) ? $role : [$role];

        foreach ($requiredRoles as $requiredRole) {
            if ($user->hasRole($requiredRole)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.sidebar');
    }
}
