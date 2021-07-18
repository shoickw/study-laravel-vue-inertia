<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-end">
                            <h2 class="mr-auto font-bold text-xl">Task Detail</h2>
                            <button type="button" @click="deleteTask(task_detail.id)" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 focus:outline-none transition ease-in-out duration-150 mr-1">Delete</button>
                            <inertia-link :href="route('task.form', { task_id: task_detail.id })" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">Edit</inertia-link>
                        </div>
                        <ul>
                            <li v-for="(value, key) in task_detail" :key="value">
                                {{ key + ":" + value }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
    components: {
        BreezeAuthenticatedLayout,
    },
    props: {
        task_detail: Object,
    },
    methods: {
        deleteTask(task_id) {
            this.$inertia.post(this.route("task.delete_done", { task_id: task_id }));
        },
    },
};
</script>
