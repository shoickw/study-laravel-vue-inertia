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
                            <inertia-link :href="route('task.form')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Add Task</inertia-link>
                        </div>
                        <div class="mt-3">
                            <template v-if="task_list.length == 0">
                                <div>No Tasks</div>
                            </template>
                            <template v-else>
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="w-10">ID</th>
                                            <th class="font-bold">Task</th>
                                            <th class="w-1/12">Status</th>
                                            <th class="w-1/6">Control</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="task in task_list" :key="task.id" class="border-t-2 hover:bg-gray-100">
                                            <td class="px-4 py-2 border-solid divide-gray-200 text-center">{{ task.id }}</td>
                                            <td class="px-4 py-2 border-solid divide-gray-200 text-left">{{ task.task_name }}</td>
                                            <td class="px-0 py-2 border-solid divide-gray-200 text-center">
                                                <span class="rounded-full w-full block text-xs px-4 py-2 border-0 bg-gray-200 text-gray-800" v-if="task.status == 1">Pending</span>
                                                <span class="rounded-full w-full block text-xs px-4 py-2 border-0 bg-blue-400 text-blue-700" v-else-if="task.status == 2">In Progress</span>
                                                <span class="rounded-full w-full block text-xs px-4 py-2 border-0 bg-green-200 text-green-700" v-else-if="task.status == 3">Done</span>
                                                <span class="rounded-full w-full block text-xs px-4 py-2 border-0 bg-gray-300 text-gray-800" v-else>Discarded</span>
                                            </td>
                                            <td class="px-4 py-2 border-solid divide-gray-200 text-center">
                                                <div class="flex justify-end">
                                                    <template v-if="task.status == 3">
                                                        <button type="button" @click="deleteTask(task.id)" class="inline-flex justify-center items-center px-4 py-2 w-20 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-500 focus:shadow-outline-red transition ease-in-out duration-150 mr-1">Delete</button>
                                                    </template>
                                                    <template v-else>
                                                        <button type="button" @click="updateTask(task.id, 3)" class="inline-flex justify-center items-center px-4 py-2 w-20 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-green-900 tracking-widest hover:bg-green-300 focus:outline-none focus:border-green-300 focus:shadow-outline-green transition ease-in-out duration-150 mr-1">Done</button>
                                                    </template>
                                                    <inertia-link :href="route('task.detail')" :data="{ task_id: task.id }" class="inline-flex justify-center items-center px-4 py-2 w-20 bg-gray-200 border border-transparent rounded-md font-bold text-xs tracking-widest hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray transition ease-in-out duration-150"> Detail </inertia-link>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                        </div>
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
        task_list: Array,
    },
    methods: {
        updateTask(task_id, status) {
            this.$inertia.post(
                this.route("task.update", {
                    task_id: task_id,
                    status: status,
                })
            );
        },
        deleteTask(task_id) {
            this.$inertia.post(this.route("task.delete_done", { task_id: task_id }));
        },
    },
};
</script>
