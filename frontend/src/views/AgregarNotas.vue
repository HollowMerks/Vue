<template>
    <div>
        <h2 class="mb-4">➕ Agregar Nueva Nota</h2>

        <form @submit.prevent="guardarNota">
            <div class="mb-3">
                <label for="contenido" class="form-label"
                    >Contenido de la nota</label
                >
                <textarea
                    id="contenido"
                    v-model="contenido"
                    class="form-control"
                    rows="4"
                    required
                ></textarea>
            </div>

            <div class="d-flex gap-2">
                <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="cargando"
                >
                    <span
                        v-if="cargando"
                        class="spinner-border spinner-border-sm me-2"
                    ></span>
                    Guardar Nota
                </button>
                <router-link to="/" class="btn btn-secondary"
                    >Cancelar</router-link
                >
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { notasService } from "../services/notasService";

const router = useRouter();
const contenido = ref("");
const cargando = ref(false);

const guardarNota = async () => {
    if (!contenido.value.trim()) return;

    try {
        cargando.value = true;
        await notasService.create(contenido.value);
        router.push("/"); // Volver a la lista
    } catch (error) {
        console.error("Error al guardar:", error);
        alert(
            "Error al guardar la nota: " +
                (error.response?.data?.message || error.message),
        );
    } finally {
        cargando.value = false;
    }
};
</script>
