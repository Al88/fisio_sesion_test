<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    ejercicio: Object,
});

const form = useForm({
    nombre: props.ejercicio.nombre,
    youtube_url: props.ejercicio.youtube_url,
});

const submit = () => {
    form.put(`/ejercicios/${props.ejercicio.id}`);
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Editar Ejercicio
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white p-4 shadow sm:rounded-lg sm:p-8 space-y-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input
                            id="nombre"
                            type="text"
                            v-model="form.nombre"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        />
                    </div>

                    <div>
                        <label for="youtube_url" class="block text-sm font-medium text-gray-700">URL de YouTube</label>
                        <input
                            id="youtube_url"
                            type="text"
                            v-model="form.youtube_url"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        />
                    </div>

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        :disabled="form.processing"
                    >
                        Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
