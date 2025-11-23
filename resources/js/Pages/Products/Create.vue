<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    categories: Array,
});

// Formulario con Inertia
const form = useForm({
    product_name: "",
    product_description: "",
    product_price: "",
    product_stock: "",
    product_status: true,
    fk_category_product: "",
});

const submit = () => {
    form.post(route('products.store'));
};
</script>

<template>
    <Head title="Create Product" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Create Product
                </h2>

                <Link
                    :href="route('products.index')"
                    class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600"
                >
                    Back to Products
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">

                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Product Name
                            </label>
                            <input
                                v-model="form.product_name"
                                type="text"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            />
                            <div v-if="form.errors.product_name" class="text-red-500 text-sm mt-1">
                                {{ form.errors.product_name }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Description
                            </label>
                            <textarea
                                v-model="form.product_description"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            ></textarea>
                            <div v-if="form.errors.product_description" class="text-red-500 text-sm mt-1">
                                {{ form.errors.product_description }}
                            </div>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Price
                            </label>
                            <input
                                v-model="form.product_price"
                                type="number"
                                step="0.01"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            />
                            <div v-if="form.errors.product_price" class="text-red-500 text-sm mt-1">
                                {{ form.errors.product_price }}
                            </div>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Stock
                            </label>
                            <input
                                v-model="form.product_stock"
                                type="number"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            />
                            <div v-if="form.errors.product_stock" class="text-red-500 text-sm mt-1">
                                {{ form.errors.product_stock }}
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                            <select
                                v-model="form.product_status"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            >
                                <option :value="true">Disponible</option>
                                <option :value="false">No disponible</option>
                            </select>
                            <div v-if="form.errors.product_status" class="text-red-500 text-sm mt-1">
                                {{ form.errors.product_status }}
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Category
                            </label>
                            <select
                                v-model="form.fk_category_product"
                                class="mt-1 w-full px-4 py-2 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300"
                            >
                                <option value="">Select Category</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                    {{ cat.category_name }}
                                </option>
                            </select>
                            <div v-if="form.errors.fk_category_product" class="text-red-500 text-sm mt-1">
                                {{ form.errors.fk_category_product }}
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50"
                            >
                                Save Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
