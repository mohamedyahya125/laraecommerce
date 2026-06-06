<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                {{ auth()->user()->name }}
            </h2>
            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full shadow-sm">
                {{ date('F j, Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-6 bg-gray-100/70 rounded-2xl border border-gray-200/80 shadow-sm">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900">
                            {{ __('Welcome Back,') }} <span class="text-blue-600">{{ auth()->user()->name }}</span>!
                        </h3>
                        <p class="text-gray-600 text-sm mt-1 font-medium">
                            {{ __('Manage your orders, track your payments via Stripe, and explore your personal catalog seamlessly.') }}
                        </p>
                    </div>
                    <div
                        class="bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-xl text-xs font-bold shrink-0 shadow-sm">
                        ⚡ Status: Active Buyer
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Total
                                Orders</span>
                            <span class="text-3xl font-black text-gray-900 block">12</span>
                        </div>
                        <span class="text-3xl bg-gray-50 p-3 rounded-xl border border-gray-100 shadow-inner">📦</span>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">In Cart</span>
                            <span class="text-3xl font-black text-gray-900 block">3 Items</span>
                        </div>
                        <span class="text-3xl bg-gray-50 p-3 rounded-xl border border-gray-100 shadow-inner">🛒</span>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Payment
                                Method</span>
                            <span class="text-lg font-extrabold text-gray-800 block pt-1">Stripe Secured</span>
                        </div>
                        <span class="text-3xl bg-gray-50 p-3 rounded-xl border border-gray-100 shadow-inner">💳</span>
                    </div>
                </div>

            </div>{{-- نهاية الـ Grid --}}

        </div>
    </div>
</x-app-layout>
