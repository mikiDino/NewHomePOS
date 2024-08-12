@extends('layouts.app')

@section('title', __('home.home'))

@section('content')
    <div class="menuContent">
        @if (auth()->user()->can('user.view'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\HomeController::class, 'index']) }}" class="center">
                    @include('home.svg.inicio')
                </a>
                <b>Inicio</b>
            </div>
        @endif

        @if (auth()->user()->can('another.permission'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\ManageUserController::class, 'index']) }}" class="center">
                    @include('home.svg.usuarios')
                </a>
                <b>Usuarios</b>
            </div>
        @endif

        @if (auth()->user()->can('customer.view') || auth()->user()->can('customer.view_own'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'customer']) }}"
                    class="center">
                    @include('home.svg.clientes')
                </a>
                <b>Clientes</b>
            </div>
        @endif

        @if (auth()->user()->can('product.view') ||
                auth()->user()->can('product.create') ||
                auth()->user()->can('brand.view') ||
                auth()->user()->can('unit.view') ||
                auth()->user()->can('category.view') ||
                auth()->user()->can('brand.create') ||
                auth()->user()->can('unit.create') ||
                auth()->user()->can('category.create'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\ProductController::class, 'index']) }}" class="center">
                    @include('home.svg.productos')
                </a>
                <b>Productos</b>
            </div>

            @if (auth()->user()->can('category.view') || auth()->user()->can('category.create'))
                <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                    <a href="{{ action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=product' }}"
                        class="center">
                        @include('home.svg.categorias')
                    </a>
                    <b>Categorias</b>
                </div>
            @endif
        @endif

        @if (in_array('purchases', $enabled_modules) &&
                (auth()->user()->can('purchase.view') ||
                    auth()->user()->can('purchase.create') ||
                    auth()->user()->can('purchase.update')))
            @if (auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))
                <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                    <a href="{{ action([\App\Http\Controllers\PurchaseController::class, 'index']) }}" class="center">
                        @include('home.svg.compras')
                    </a>
                    <b>{{ __('purchase.list_purchase') }}</b>
                </div>
            @endif
        @endif

        @if (
            $is_admin ||
                auth()->user()->hasAnyPermission([
                        'sell.view',
                        'sell.create',
                        'direct_sell.access',
                        'view_own_sell_only',
                        'view_commission_agent_sell',
                        'access_shipping',
                        'access_own_shipping',
                        'access_commission_agent_shipping',
                        'access_sell_return',
                        'direct_sell.view',
                        'direct_sell.update',
                        'access_own_sell_return',
                    ]))
            @if (
                $is_admin ||
                    auth()->user()->hasAnyPermission([
                            'sell.view',
                            'sell.create',
                            'direct_sell.access',
                            'direct_sell.view',
                            'view_own_sell_only',
                            'view_commission_agent_sell',
                            'access_shipping',
                            'access_own_shipping',
                            'access_commission_agent_shipping',
                        ]))
                <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                    <a href="{{ action([\App\Http\Controllers\SellController::class, 'index']) }}" class="center">
                        @include('home.svg.ventas')
                    </a>
                    <b>Ventas</b>
                </div>
            @endif
        @endif

        @if (auth()->user()->can('faturador.create') ||
                auth()->user()->can('faturador.facturas') ||
                auth()->user()->can('faturador.settings'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\Modules\Facturador\Http\Controllers\SiatController::class, 'facturador']) }}"
                    class="center">
                    @include('home.svg.facturador')
                </a>
                <b>Facturador</b>
            </div>
        @endif

        @if (in_array('stock_transfers', $enabled_modules) &&
                (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create')))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\StockTransferController::class, 'index']) }}" class="center">
                    @include('home.svg.stockTransferencias')
                </a>
                <b>Transferencia Stock</b>
            </div>
        @endif

        @if (in_array('stock_adjustment', $enabled_modules) &&
                (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create')))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\StockAdjustmentController::class, 'index']) }}" class="center">
                    @include('home.svg.stockAjustes')
                </a>
                <b>Ajustes Stock</b>
            </div>
        @endif

        @if (in_array('expenses', $enabled_modules) &&
                (auth()->user()->can('all_expense.access') || auth()->user()->can('view_own_expense')))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\ExpenseController::class, 'index']) }}" class="center">
                    @include('home.svg.gastos')
                </a>
                <b>Gastos</b>
            </div>
        @endif

        @if (auth()->user()->can('account.access'))
            <div class=" mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\AccountController::class, 'index']) }}" class="center">
                    @include('home.svg.informes.informe')
                </a>
                <b>Informes</b>
            </div>
        @endif

        @if (auth()->user()->can('backup'))
            <div class="mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\BackUpController::class, 'index']) }}" class="center">
                    @include('home.svg.backup')
                </a>
                <b>Backup</b>
            </div>
        @endif

        @if (auth()->user()->can('manage_modules'))
            <div class="mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                <a href="{{ action([\App\Http\Controllers\Install\ModulesController::class, 'index']) }}" class="center">
                    @include('home.svg.modules')
                </a>
                <b>Modules</b>
            </div>
        @endif

        @if (auth()->user()->can('business_settings.access') ||
                auth()->user()->can('barcode_settings.access') ||
                auth()->user()->can('invoice_settings.access') ||
                auth()->user()->can('tax_rate.view') ||
                auth()->user()->can('tax_rate.create') ||
                auth()->user()->can('access_package_subscriptions'))
            @if (auth()->user()->can('business_settings.access'))
                <div class="mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                    <a href="{{ action([\App\Http\Controllers\BusinessController::class, 'getBusinessSettings']) }}"
                        class="{{ request()->segment(1) == 'business' ? 'active' : '' }} center" id="tour_step2">
                        @include('home.svg.settings.empresa')
                    </a>
                    <b>{{ __('business.business_settings') }}</b>
                </div>
                <div class="mb-4 d-flex align-items-center justify-content-center custom-hover rounded-circle text-center">
                    <a href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'index']) }}"
                        class="{{ request()->segment(1) == 'business-location' ? 'active' : '' }} center">
                        @include('home.svg.settings.sucursal')
                    </a>
                    <b>Sucursales</b>
                </div>
            @endif
        @endif

    </div>

    @php
        $ch = $wh == 50 ? 100 : 200;
    @endphp
    <style>
        .custom-hover {
            margin: 10px 11px;
            width: {{ $ch }}px;
            height: {{ $ch }}px;
            transition: transform 0.3s ease, border 0.3s ease;
            border: 2px solid #f2f4f5;
            background: #02B0F0;
            border-radius: 50%;
            box-sizing: border-box;
            box-shadow: 1px 1px 15px 1px;
        }

        .custom-hover:hover {
            transform: scale(1.1);
            /* border: 2px solid #0000005f; */
            background: #f1eeee74;
            font-size: 22px;
            color: #FF900F;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .menuContent {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 98%;
            background-image:
                url('{{ asset("uploads/business_logos/$logo") }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endsection
@section('javascript')
    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
@endsection
