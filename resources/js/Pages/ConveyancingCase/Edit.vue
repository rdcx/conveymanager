<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';

// Access the conveyancing case and tasks passed from the server
const { conveyancingCase, tasks } = usePage().props;

const form = useForm({
    _method: 'patch',
});

const toggleTaskCompletion = (task) => {
    form.is_completed = !task.is_completed;
    form.post(route('tasks.update', task.id), {
        onSuccess: () => console.log('Task updated successfully'), 
        onError: () => console.error('Failed to update task')
    });
};
</script>

<template>
    <AppLayout title="Edit Case">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Case: {{ conveyancingCase.property.address }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                    <!-- Case Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900">Case Details</h3>
                        <div class="mt-4">
                            <p><strong>REF:</strong> {{ conveyancingCase.ref }}</p>
                            <p><strong>Property:</strong> {{ conveyancingCase.property.address }}</p>
                            <p><strong>Status:</strong> {{ conveyancingCase.status }}</p>
                            <p><strong>Start Date:</strong> {{ conveyancingCase.start_date }}</p>
                            <p><strong>End Date:</strong> {{ conveyancingCase.end_date || 'N/A' }}</p>
                            <p><strong>Conveyancer:</strong> {{ conveyancingCase.conveyancer.name }}</p>
                            <p><strong>Client:</strong> {{ conveyancingCase.clients[0]?.first_name }} {{ conveyancingCase.clients[0]?.last_name }}</p>
                        </div>
                    </div>

                    <!-- Task List -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tasks</h3>
                        <div v-if="conveyancingCase.tasks.length === 0" class="text-gray-600">
                            No tasks available.
                        </div>
                        <div v-else class="space-y-4">
                            <div v-for="task in conveyancingCase.tasks" :key="task.id" class="flex items-center">
                                <input
                                    type="checkbox"
                                    :id="'task-' + task.id"
                                    :checked="task.is_completed"
                                    @change="toggleTaskCompletion(task)"
                                    class="form-checkbox h-5 w-5 text-blue-600"
                                />
                                <label :for="'task-' + task.id" class="ml-3 text-sm text-gray-700">
                                    {{ task.name }}
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>