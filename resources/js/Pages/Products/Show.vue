<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    product: Object,
});
</script>

<template>
    <Head title="Product Details" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Product Details
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
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">

                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">
                        Information of Product #{{ product.id }}
                    </h3>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Name</td>
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">
                                    {{ product.product_name }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Description</td>
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">
                                    {{ product.product_description }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Price</td>
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">
                                    ${{ product.product_price }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Stock</td>
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">
                                    {{ product.product_stock }}
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Status</td>
                                <td class="px-6 py-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-sm"
                                        :class="product.product_status === true
                                            ? 'bg-green-200 text-green-800'
                                            : 'bg-red-200 text-red-800'"
                                    >
                                        {{ product.product_status === true ? 'Disponible' : 'No disponible' }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-700 dark:text-gray-300">Category</td>
                                <td class="px-6 py-3 text-gray-900 dark:text-gray-100">
                                    <Link
                                        :href="route('categories.show', product.category.id)"
                                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300"
                                    >
                                        {{ product.category.category_name }}
                                    </Link>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
