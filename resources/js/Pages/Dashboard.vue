<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
    totalProperties: Number,
    totalConveyancingCases: Number,
    totalUsers: Number,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Total Properties -->
                        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Total Properties</h3>
                            <p class="text-3xl mt-2">{{ totalProperties }}</p>
                        </div>

                        <!-- Total Conveyancing Cases -->
                        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Total Conveyancing Cases</h3>
                            <p class="text-3xl mt-2">{{ totalConveyancingCases }}</p>
                        </div>

                        <!-- Total Users (for admins) -->
                        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Total Users</h3>
                            <p class="text-3xl mt-2">{{ totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>