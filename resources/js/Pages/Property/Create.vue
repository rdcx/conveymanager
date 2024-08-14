<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    address: '',
    city: '',
    state: '',
    postal_code: '',
    country: ''
});

const submit = () => {
    form.post(route('properties.store'), {
        onSuccess: () => form.reset(),
        onError: () => console.error('Failed to create property')
    });
};
</script>

<template>
    <AppLayout title="Create Property">
        <template #header>
            <div class="flex">
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                    Create New Property
                </div>
                <div class="grow"></div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <input
                                id="address"
                                type="text"
                                v-model="form.address"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="address"
                            />
                            <span v-if="form.errors.address" class="text-sm text-red-600 mt-1">{{ form.errors.address }}</span>
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">
                                City
                            </label>
                            <input
                                id="city"
                                type="text"
                                v-model="form.city"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="city"
                            />
                            <span v-if="form.errors.city" class="text-sm text-red-600 mt-1">{{ form.errors.city }}</span>
                        </div>

                        <!-- Postal Code -->
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">
                                Postal Code
                            </label>
                            <input
                                id="postal_code"
                                type="text"
                                v-model="form.postal_code"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="postal_code"
                            />
                            <span v-if="form.errors.postal_code" class="text-sm text-red-600 mt-1">{{ form.errors.postal_code }}</span>
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700">
                                Country
                            </label>
                            <input
                                id="country"
                                type="text"
                                v-model="form.country"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="country"
                            />
                            <span v-if="form.errors.country" class="text-sm text-red-600 mt-1">{{ form.errors.country }}</span>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition"
                            >
                                Create Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>