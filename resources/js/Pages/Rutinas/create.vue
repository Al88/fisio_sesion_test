<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import RutinaForm from './partials/RutinaForm.vue';

defineProps({
    rutina: {
        type: Array,
        default: () => null, // Maneja explícitamente valores null
    },
    ejerciciosDisponibles: {
        type: Array,
        default: () => [],
    },
});
const user = usePage().props.auth.user;

</script>

<template>
    <Head title="Rutina" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
            {{ isEdit ? 'Editar Rutina' : 'Crear Nueva Rutina' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <RutinaForm
                        class="max-w-xl"
                        :isEdit="false"
                        :ejerciciosDisponibles = "ejerciciosDisponibles"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
