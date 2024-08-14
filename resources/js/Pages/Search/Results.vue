<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    query: String,
    properties: Array,
    conveyancingCases: Array,
});

const getStatusClass = (status) => {
    return {
        'text-green-600': status === 'completed',
        'text-yellow-600': status === 'in_progress',
        'text-red-600': status === 'cancelled',
    };
};
</script>

<template>
    <AppLayout title="Search Results">
        <template #header>
            <div class="flex">
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                    Search query: {{ query }}
                </div>
                <div class="grow"></div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Properties</h3>
                    <div class="overflow-hidden">
                        <div v-if="properties.length === 0" class="mt-6 text-gray-600">
                            No properties match your query.
                        </div>

                        <div v-else class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div v-for="property in properties" :key="property.id"
                                class="bg-white rounded-lg p-6 border border-gray-200">
                                <Link :href="route('properties.show', property.id)">
                                <h3 class="text-lg font-semibold text-blue-500">{{ property.address }}</h3>
                                </Link>
                                <p class="text-sm text-gray-600">{{ property.city }}, {{ property.state }} {{
                                    property.postal_code }}
                                </p>
                                <p class="text-sm text-gray-600">{{ property.country }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <!-- Existing Conveyancing Cases -->
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Cases</h3>
                    <div v-if="conveyancingCases.length === 0" class="text-gray-600">
                        No cases available.
                    </div>
                    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <Link v-for="conveyancingCase in conveyancingCases" :key="conveyancingCase.id" :href="route('conveyancing-cases.edit', [conveyancingCase])">
                            <div 
                                class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                                <h4 class="text-lg font-semibold text-blue-900">
                                    REF: {{ conveyancingCase.ref }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    Status: <span class="font-bold" :class="getStatusClass(conveyancingCase.status)">{{
                                        conveyancingCase.status }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Start Date: {{ conveyancingCase.start_date }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    End Date: {{ conveyancingCase.end_date || 'N/A' }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Conveyancer: <span class="font-bold">{{ conveyancingCase.conveyancer?.name }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Client: <span class="font-bold">{{ conveyancingCase.clients[0]?.first_name }} {{
                                        conveyancingCase.clients[0]?.last_name }}</span>
                                </p>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>