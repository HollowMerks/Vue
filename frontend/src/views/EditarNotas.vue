<template>
    <div>
        <h2 class="mb-4">✏️ Editar Nota</h2>

        <div v-if="cargandoInicial" class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>

        <form v-else @submit.prevent="actualizarNota">
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
                    Actualizar Nota
                </button>
                <router-link to="/" class="btn btn-secondary"
                    >Cancelar</router-link
                >
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { notasService } from "../services/notasService";

const route = useRoute();
const router = useRouter();
const contenido = ref("");
const cargando = ref(false);
const cargandoInicial = ref(true);

const cargarNota = async () => {
    try {
        const response = await notasService.getById(route.params.id);
        contenido.value = response.data.contenido;
    } catch (error) {
        console.error("Error al cargar nota:", error);
        alert("Error al cargar la nota");
        router.push("/");
    } finally {
        cargandoInicial.value = false;
    }
};

const actualizarNota = async () => {
    if (!contenido.value.trim()) return;

    try {
        cargando.value = true;
        await notasService.update(route.params.id, contenido.value);
        router.push("/");
    } catch (error) {
        console.error("Error al actualizar:", error);
        alert("Error al actualizar la nota");
    } finally {
        cargando.value = false;
    }
};

onMounted(() => {
    cargarNota();
});
</script>
