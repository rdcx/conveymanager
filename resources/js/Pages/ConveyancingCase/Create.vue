<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';


// Define the properties and users that will be passed to the page
const props = defineProps({
    property: Object,
});

// Access the conveyancers and clients passed from the server
const { conveyancers, clients } = usePage().props;

const form = useForm({
    property_id: props.property.id,
    conveyancer_id: '',
    client_id: '',   
    status: 'initiated', // Default status
    start_date: '',
    end_date: '',
});

const submit = () => {
    form.post(route('conveyancing-cases.store', props.property.id), {
        onSuccess: () => form.reset(),
        onError: () => console.error('Failed to create conveyancing case')
    });
};

// Status options for the conveyancing case
const statusOptions = ['initiated', 'in_progress', 'completed', 'cancelled'];
</script>

<template>
    <AppLayout title="Create Conveyancing Case">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Open a New Case
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property</h3>
                        <p class="text-sm text-gray-600">
                            {{ property.address }}, {{ property.city }}, {{ property.state }} {{ property.postal_code }}, {{ property.country }}
                        </p>
                    </div>
                    <!-- Form for Creating a New Conveyancing Case -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Conveyancer -->
                        <div>
                            <label for="conveyancer_id" class="block text-sm font-medium text-gray-700">Conveyancer</label>
                            <select
                                id="conveyancer_id"
                                v-model="form.conveyancer_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">Select a conveyancer</option>
                                <option v-for="conveyancer in conveyancers" :key="conveyancer.id" :value="conveyancer.id">
                                    {{ conveyancer.name }} ({{ conveyancer.email }})
                                </option>
                            </select>
                            <span v-if="form.errors.conveyancer_id" class="text-sm text-red-600 mt-1">{{ form.errors.conveyancer_id }}</span>
                        </div>

                        <!-- Client -->
                        <div>
                            <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                            <select
                                id="client_id"
                                v-model="form.client_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">Select a client</option>
                                <option v-for="client in clients" :key="client.id" :value="client.id">
                                    {{ client.first_name }} {{ client.last_name }}
                                </option>
                            </select>
                            <span v-if="form.errors.client_id" class="text-sm text-red-600 mt-1">{{ form.errors.client_id }}</span>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select
                                id="status"
                                v-model="form.status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            >
                                <option v-for="status in statusOptions" :key="status" :value="status">
                                    {{ status }}
                                </option>
                            </select>
                            <span v-if="form.errors.status" class="text-sm text-red-600 mt-1">{{ form.errors.status }}</span>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input
                                id="start_date"
                                type="date"
                                v-model="form.start_date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            />
                            <span v-if="form.errors.start_date" class="text-sm text-red-600 mt-1">{{ form.errors.start_date }}</span>
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input
                                id="end_date"
                                type="date"
                                v-model="form.end_date"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            />
                            <span v-if="form.errors.end_date" class="text-sm text-red-600 mt-1">{{ form.errors.end_date }}</span>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition"
                            >
                                Create Case
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>