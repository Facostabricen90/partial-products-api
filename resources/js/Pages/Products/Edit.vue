<script setup>
import { useForm } from '@inertiajs/vue3';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    product: Object,
    categories: Array,
});

const form = useForm({
    product_name: props.product.product_name,
    product_description: props.product.product_description,
    product_price: props.product.product_price,
    product_stock: props.product.product_stock,
    product_status: props.product.product_status,
    fk_category_product: props.product.fk_category_product,
});

const submit = () => {
    form.put(route('products.update', props.product.id));
};
</script>

<template>
    <Head title="Edit Product" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Product
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="submit">

                            <!-- Product Name -->
                            <div class="mb-4">
                                <InputLabel for="product_name" value="Product Name" class="dark:text-gray-300" />
                                <TextInput
                                    id="product_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.product_name"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.product_name" />
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <InputLabel for="product_description" value="Product Description" class="dark:text-gray-300" />
                                <TextInput
                                    id="product_description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.product_description"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.product_description" />
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <InputLabel for="product_price" value="Price" class="dark:text-gray-300" />
                                <TextInput
                                    id="product_price"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.product_price"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.product_price" />
                            </div>

                            <!-- Stock -->
                            <div class="mb-4">
                                <InputLabel for="product_stock" value="Stock" class="dark:text-gray-300" />
                                <TextInput
                                    id="product_stock"
                                    type="number"
                                    min="0"
                                    class="mt-1 block w-full"
                                    v-model="form.product_stock"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.product_stock" />
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <InputLabel for="product_status" value="Status" class="dark:text-gray-300" />
                                <select
                                    id="product_status"
                                    class="mt-1 block w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md"
                                    v-model="form.product_status"
                                    required
                                >
                                    <option :value="true">Active</option>
                                    <option :value="false">Inactive</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.product_status" />
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <InputLabel for="fk_category_product" value="Category" class="dark:text-gray-300" />
                                <select
                                    id="fk_category_product"
                                    class="mt-1 block w-full border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 rounded-md"
                                    v-model="form.fk_category_product"
                                    required
                                >
                                    <option disabled value="">Select a category</option>
                                    <option
                                        v-for="cat in categories"
                                        :key="cat.id"
                                        :value="cat.id"
                                    >
                                        {{ cat.category_name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.fk_category_product" />
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Product
                                </PrimaryButton>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
