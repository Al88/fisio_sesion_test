<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

defineProps({
    ejercicios: {
        type: Array,
        required: true,
    },
});

const editEjercicio = (ejercicio) => {
    router.visit(`/ejercicios/${ejercicio.id}/edit`);
};

const deleteEjercicio = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este ejercicio?')) {
        router.delete(`/ejercicios/${id}`);
    }
};

const addEjercicio = () => {
    router.visit('/ejercicios/create');
};
</script>

<template>
    <Head title="Ejercicios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Listado de Ejercicios
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Ejercicios</h3>
                        <button
                            @click="addEjercicio"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            + Nuevo Ejercicio
                        </button>
                    </div>

                    <div>
                        <table class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        URL de YouTube
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="ejercicio in ejercicios" :key="ejercicio.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ejercicio.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ejercicio.nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ejercicio.youtube_url }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-4">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900"
                                            @click="editEjercicio(ejercicio)"
                                        >
                                            Editar
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-900"
                                            @click="deleteEjercicio(ejercicio.id)"
                                        >
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
