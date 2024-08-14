<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    first_name: '',
    last_name: '',
});

const submit = () => {
    form.post(route('clients.store'), {
        onSuccess: () => form.reset(),
        onError: () => console.error('Failed to create client')
    });
};
</script>

<template>
    <AppLayout title="Create Client">
        <template #header>
            <div class="flex">
                <div class="font-semibold text-xl text-gray-800 leading-tight">
                    Create New Client
                </div>
                <div class="grow"></div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                First Name
                            </label>
                            <input id="first_name" type="text" v-model="form.first_name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="first_name" />
                            <span v-if="form.errors.first_name" class="text-sm text-red-600 mt-1">{{
                                form.errors.first_name
                                }}</span>
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Last Name
                            </label>
                            <input id="last_name" type="text" v-model="form.last_name"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                autocomplete="last_name" />
                            <span v-if="form.errors.last_name" class="text-sm text-red-600 mt-1">{{
                                form.errors.last_name
                                }}</span>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                                Create Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>