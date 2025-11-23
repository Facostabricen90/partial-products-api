<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    category: Object,
});
</script>

<template>
    <Head title="Category Details"/>

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Category Details
                </h2>
                <Link :href="route('categories.index')"
                      class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md 
                             hover:bg-gray-700 dark:hover:bg-gray-600">
                    Back to Categories
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Category Information</h3>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">

                                <!-- ID -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ category.id }}</p>
                                </div>

                                <!-- Name -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ category.category_name }}</p>
                                </div>

                                <!-- Description -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ category.category_description ?? '—' }}
                                    </p>
                                </div>

                                <!-- Created At -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                        {{ new Date(category.created_at).toISOString().slice(0, 10) }} - {{ new Date(category.created_at).toISOString().slice(11, 16) }}
                                    </p>
                                </div>

                                <!-- Updated At -->
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</p>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                         {{ new Date(category.updated_at).toISOString().slice(0, 10) }} - {{ new Date(category.updated_at).toISOString().slice(11, 16) }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8"></div>

                <!-- RELATED PRODUCTS LIST -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            Products in this Category
                        </h3>

                        <template v-if="category.products.length > 0">
                            <table class="min-w-full text-left">
                                <thead>
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <th class="py-2 px-3">ID</th>
                                    <th class="py-2 px-3">Name</th>
                                    <th class="py-2 px-3">Price</th>
                                    <th class="py-2 px-3">Stock</th>
                                    <th class="py-2 px-3">Status</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr
                                    v-for="product in category.products"
                                    :key="product.id"
                                    class="border-b border-gray-200 dark:border-gray-700 text-white"
                                >
                                    <td class="py-2 px-3">{{ product.id }}</td>
                                    <td class="py-2 px-3">{{ product.product_name }}</td>
                                    <td class="py-2 px-3">{{ product.product_price }}</td>
                                    <td class="py-2 px-3">{{ product.product_stock }}</td>
                                    <td class="py-2 px-3">{{ product.product_status }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </template>

                        <template v-else>
                            <p class="text-gray-600 dark:text-gray-400">No products in this category.</p>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
