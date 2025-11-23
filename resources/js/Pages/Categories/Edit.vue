<script setup>
import { useForm } from '@inertiajs/vue3';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    category: Object,
});

const form = useForm({
    category_name: props.category.category_name,
    category_description: props.category.category_description,
    category_classification: props.category.category_classification,
    category_state: props.category.category_state,
});

const submit = () => {
    form.put(route('categories.update', props.category.id));
};
</script>

<template>
    <Head title="Edit Category" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Category
                </h2>

                <Link
                    :href="route('categories.index')"
                    class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600"
                >
                    Back to Categories
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">

                            <!-- Name -->
                            <div class="mb-4">
                                <InputLabel for="category_name" value="Category Name" class="dark:text-gray-300" />
                                <TextInput
                                    id="category_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.category_name"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.category_name" />
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <InputLabel for="category_description" value="Category Description" class="dark:text-gray-300" />
                                <TextInput
                                    id="category_description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.category_description"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.category_description" />
                            </div>

                            <!-- Classification -->
                            <div class="mb-4">
                                <InputLabel for="category_classification" value="Classification" class="dark:text-gray-300" />
                                <select
                                    id="category_classification"
                                    class="mt-1 block w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md"
                                    v-model="form.category_classification"
                                    required
                                >
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_classification" />
                            </div>

                            <!-- State -->
                            <div class="mb-4">
                                <InputLabel for="category_state" value="State" class="dark:text-gray-300" />
                                <select
                                    id="category_state"
                                    class="mt-1 block w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md"
                                    v-model="form.category_state"
                                    required
                                >
                                    <option :value="true">Active</option>
                                    <option :value="false">Inactive</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_state" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Category
                                </PrimaryButton>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
