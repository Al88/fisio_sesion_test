<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    rutinas: {
        type: Array,
    }
});
const user = usePage().props.auth.user;

const editRutina = (rutina) => {
   // Inertia.visit('/rutinas/'+ rutina.id);
    router.visit('/rutinas/'+ rutina.id);

};

const deleteRutina = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar esta rutina?')) {
        router.delete(`/rutinas/${id}`);
    }
};
const addRutina = () => {
    router.visit('/rutinas/create')

};
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Listado de Rutinas de <b>{{ user.name }}</b>
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Rutinas</h3>
                        <button
                            @click="addRutina"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            + Nueva Rutina
                        </button>
                     </div>

                    <div>
                        <table class="min-w-full divide-y divide-gray-200 mt-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>

                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="rutina in rutinas" :key="rutina.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rutina.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rutina.descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex space-x-4">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900"
                                            @click="editRutina(rutina)"
                                        >
                                            Editar
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-900"
                                            @click="deleteRutina(rutina.id)"
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
