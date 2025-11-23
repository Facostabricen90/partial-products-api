<script setup>
import { ref, computed, onMounted } from "vue";
import { Head, useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    categories: Array,
    message: String,
});

const search = ref("");

const filteredCategories = computed(() => {
    return props.categories.filter(cat =>
        cat.category_name.toLowerCase().includes(search.value.toLowerCase())
    );
});

const showMessage = ref(props.message);

onMounted(() => {
    if (showMessage.value) {
        setTimeout(() => {
            showMessage.value = null;
        }, 5000);
    }
});


const showDeleteModal = ref(false);
const categoryToDelete = ref(null);

const confirmDelete = (category) => {
    categoryToDelete.value = category;
    showDeleteModal.value = true;
};

const closeModal = () => {
    showDeleteModal.value = false;
};

const deleteForm = useForm({});

const deleteCategory = () => {
    deleteForm.delete(route('categories.destroy', categoryToDelete.value.id), {
        preserveState: false,
        onSuccess: () => {
            showDeleteModal.value = false;
        },
    });
};
</script>

<template>

    <Head title="Categories" />

    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Categories</h2>
                <Link :href="route('categories.create')"
                    class="px-4 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-600">
                Create Category
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div v-if="showMessage" class="mb-4 bg-green-100 dark:bg-green-900 border border-green-400
           dark:border-green-700 text-green-700 dark:text-green-300
           px-4 py-3 rounded">
                            {{ showMessage }}
                        </div>
                        <div class="p-6">
                            <div v-if="categories.length === 0"
                                class="text-center py-4 text-gray-600 dark:text-gray-400">
                                No hay categorías disponibles.
                            </div>
                            <div v-else class="overflow-x-auto">
                                <div class="mb-4">
                                    <input type="text" v-model="search" placeholder="Buscar categoría..." class="w-full sm:w-1/3 px-4 py-2 border dark:border-gray-700 rounded-lg
               dark:bg-gray-900 dark:text-gray-300 focus:ring focus:ring-indigo-500" />
                                </div>
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                State
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Classification
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Description
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Products
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        <tr v-for="category in filteredCategories" :key="category.id">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ category.id }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                                {{ category.category_name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ category.category_state }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ category.category_classification }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ category.category_description }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ category.products_count }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <Link :href="route('categories.show', category.id)"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                                View
                                                </Link>
                                                <Link :href="route('categories.edit', category.id)"
                                                    class="text-blue-600 hover:text-blue-900">
                                                Edit
                                                </Link>
                                                <button @click="confirmDelete(category)"
                                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <Modal :show="showDeleteModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-400">
                    ¿Estás seguro de que deseas eliminar esta categoría?
                </h2>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                    Esta acción no se puede deshacer.
                </p>
                <div class="mt-6 flex justify-end space-x-3">
                    <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
                    <DangerButton :class="{ 'opacity-25': deleteForm.processing }" :disabled="deleteForm.processing"
                        @click="deleteCategory">
                        Delete
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>