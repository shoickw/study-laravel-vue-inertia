<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <input type="hidden" v-model="form.task_id" />
                            <input type="hidden" v-model="form.user_id" />
                            <div class="mt-4">
                                <breeze-label for="task_name" value="Caption" />
                                <breeze-input type="text" id="task_name" class="mt-1 block w-full" v-model="form.task_name" />
                            </div>
                            <div class="mt-4">
                                <breeze-label for="description" value="Description" />
                                <breeze-textarea id="description" class="my-1 block w-full" v-model="form.description"></breeze-textarea>
                            </div>
                            <div class="mt-4">
                                <breeze-label for="status" value="Status" />
                                <breeze-select id="status" class="mt-1 block w-full" v-model="form.status">
                                    <option :value="1">Pending</option>
                                    <option :value="2">Proggress</option>
                                    <option :value="3">Done</option>
                                    <option :value="9">Discarded</option>
                                </breeze-select>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <breeze-button>
                                    {{ parameter.id == "" ? "Add" : "update" }}
                                </breeze-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeLabel from "@/Components/Label";
import BreezeInput from "@/Components/Input";
import BreezeTextarea from "@/Components/Textarea";
import BreezeSelect from "@/Components/Select";
import BreezeButton from "@/Components/Button";

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeLabel,
        BreezeInput,
        BreezeTextarea,
        BreezeSelect,
        BreezeButton,
    },

    props: {
        user_detail: Object,
        parameter: Array,
    },

    data() {
        return {
            form: {
                task_id: this.parameter.id,
                user_id: this.parameter.user_id,
                task_name: this.parameter.task_name,
                description: this.parameter.description,
                status: this.parameter.status,
            },
        };
    },

    methods: {
        submit() {
            this.$inertia.post(this.route("task.done"), this.form);
        },
    },
};
</script>
