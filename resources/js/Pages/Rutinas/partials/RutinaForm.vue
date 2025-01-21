<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect'; // Importar el componente Multiselect

const props = defineProps({
    rutina: {
        type: Object,
        default: () => null, // Maneja explícitamente valores null
    },
    isEdit: {
        type: Boolean,
        default: () => true, // Maneja explícitamente valores null
    },
    ejerciciosDisponibles: {
        type: Array,
        default: () => [],
    },

});

// Configuración del formulario
const form = useForm({
    descripcion: props.isEdit ? props.rutina.descripcion : '',
    ejercicios: props.isEdit ? props.rutina.ejercicios : [], // Cargar ejercicios seleccionados
});

// Función de envío
const submit = () => {
    if (props.isEdit) {
        // Actualización
        form.patch('/rutinas/'+props.rutina.id, {
            onSuccess: () => form.reset(),
        });
    } else {
        // Creación
        form.post('/rutinas', {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ isEdit ? 'Editar Rutina' : 'Crear Nueva Rutina' }}
            </h2>
        </header>

        <form
            @submit.prevent="submit"
            class="mt-6 space-y-6"
        >
            <!-- Descripción -->
            <div>
                <InputLabel for="descripcion" value="Descripción" />

                <TextInput
                    id="descripcion"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.descripcion"
                    required
                    autofocus
                    autocomplete="descripcion"
                />

                <!-- Mostrar errores de descripción -->
                <InputError class="mt-2" :message="form.errors.descripcion" />
            </div>


           <!-- Ejercicios -->
           <div>
                <InputLabel for="ejercicios" value="Ejercicios" />
                <Multiselect
                id="ejercicios"
                v-model="form.ejercicios"
                :options="ejerciciosDisponibles"
                :multiple="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="true"
                placeholder="Selecciona ejercicios"
                label="nombre"
                track-by="id"
            />
                <InputError class="mt-2" :message="form.errors.ejercicios" />
            </div>

            <!-- Botón de envío -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    Guardar
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        {{ isEdit ? 'Actualizado.' : 'Guardado.' }}
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
<style>
@import 'vue-multiselect/dist/vue-multiselect.min.css';
</style>
