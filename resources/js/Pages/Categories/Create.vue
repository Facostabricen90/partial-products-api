<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const page = usePage();
const flashMessage = computed(() => page.props.message ?? null);

const form = useForm({
    category_name: '',
    category_description: '',
    category_classification: '',
    category_state: true,
});

const submit = () => {
    form.post(route('categories.store'));
};
</script>

<template>

    <Head title="Create Category" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Create Category
                </h2>
                <Link :href="route('categories.index')"
                    class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                Back to Categories
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">

                        <div v-if="flashMessage" class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400
           dark:border-green-700 text-green-700 dark:text-green-300
           px-4 py-3 rounded">
                            {{ flashMessage }}
                        </div>

                        <!-- Errores de validación -->
                        <div v-if="Object.keys(form.errors).length" class="mb-4">
                            <div v-for="(error, key) in form.errors" :key="key" class="bg-red-100 dark:bg-red-900 border border-red-400
                           dark:border-red-700 text-red-700 dark:text-red-300
                           px-4 py-2 rounded mb-2">
                                {{ error }}
                            </div>
                        </div>

                        <form @submit.prevent="submit">

                            <!-- CATEGORY NAME -->
                            <div class="mb-4">
                                <InputLabel for="category_name" value="Category Name" class="dark:text-gray-300" />
                                <TextInput id="category_name" type="text" class="mt-1 block w-full"
                                    v-model="form.category_name" required minlength="3" maxlength="50" autofocus />
                                <InputError class="mt-2" :message="form.errors.category_name" />
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="mb-4">
                                <InputLabel for="category_description" value="Description" class="dark:text-gray-300" />
                                <TextInput id="category_description" type="text" class="mt-1 block w-full"
                                    v-model="form.category_description" required minlength="5" maxlength="255" />
                                <InputError class="mt-2" :message="form.errors.category_description" />
                            </div>

                            <!-- CLASSIFICATION -->
                            <div class="mb-4">
                                <InputLabel for="category_classification" value="Classification"
                                    class="dark:text-gray-300" />
                                <select id="category_classification" v-model="form.category_classification"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md"
                                    required>
                                    <option value="">Select Classification</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.category_classification" />
                            </div>

                            <!-- STATE (ACTIVE / INACTIVE) -->
                            <div class="mb-4">
                                <InputLabel for="category_state" value="State" class="dark:text-gray-300" />
                                <label class="inline-flex items-center mt-1">
                                    <input type="checkbox" id="category_state" v-model="form.category_state"
                                        class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-600" />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Active</span>
                                </label>
                                <InputError class="mt-2" :message="form.errors.category_state" />
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <div class="flex items-center justify-end mt-6">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Create Category
                                </PrimaryButton>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
