<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public string $activeClass = 'bg-blue-50 text-blue-600 font-semibold';
    public string $inactiveClass = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';

    public array $menu = [];
    public bool $isSuperAdmin;
    public bool $isAdmin;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Check user role
        $user = auth()->user();
        $this->isSuperAdmin = $user && $user->hasRole('superadmin');
        $this->isAdmin = $user && $user->hasRole('admin');

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
                        'routePattern' => 'datamedis.create.*',
                    ],
                    [
                        'label' => 'Data Medis',
                        'route' => 'datamedis.index',
                        'routePattern' => ['datamedis.index', 'datamedis.show', 'datamedis.edit'],
                    ],
                    [
                        'label' => 'Data Identitas Pasien',
                        'route' => 'identitaspasien.index',
                        'routePattern' => 'identitaspasien.*',
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

        $requiredRoles = is_array($role) ? $role : [$role];

        foreach ($requiredRoles as $requiredRole) {
            if ($requiredRole === 'superadmin' && $this->isSuperAdmin) {
                return true;
            }
            if ($requiredRole === 'admin' && $this->isAdmin) {
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
