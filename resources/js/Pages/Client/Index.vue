<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    clients: Array,
});

</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex">
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                   Clients 
                </div>
                <div class="grow"></div>
                <div class="flex justify-end">
                    <Link :href="route('clients.create')"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                    Add New Client
                    </Link>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div>
                        <div v-if="clients.length === 0" class="mt-6 text-gray-600">
                            You have no clients yet.
                        </div>

                        <div v-else class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div v-for="client in clients" :key="client.id"
                                class="bg-white rounded-lg p-6 border border-gray-200">
                                <h3 class="text-lg font-semibold text-blue-500">{{ client.first_name }} {{ client.last_name }}</h3>
                                <p class="text-sm text-gray-600">
                                    Created {{ client.created_at }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>