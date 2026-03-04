<template>
    <div>
        <h2 class="mb-4">📋 Lista de Notas</h2>

        <div v-if="loading" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <div v-else>
            <div v-if="notas.length === 0" class="alert alert-info">
                No hay notas. ¡Agrega una!
            </div>

            <div v-else class="list-group">
                <div
                    v-for="nota in notas"
                    :key="nota.id"
                    class="list-group-item d-flex justify-content-between align-items-center"
                >
                    <div>
                        <p class="mb-0">{{ nota.contenido }}</p>
                        <small class="text-muted">
                            Creada:
                            {{ new Date(nota.created_at).toLocaleDateString() }}
                        </small>
                    </div>
                    <div>
                        <router-link
                            :to="{ name: 'editar', params: { id: nota.id } }"
                            class="btn btn-sm btn-warning me-2"
                            >✏️ Editar</router-link
                        >
                        <button
                            @click="eliminarNota(nota.id)"
                            class="btn btn-sm btn-danger"
                        >
                            🗑️ Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { notasService } from "../services/notasService";

const notas = ref([]);
const loading = ref(true);

const cargarNotas = async () => {
    try {
        loading.value = true;
        const response = await notasService.getAll();
        notas.value = response.data;
    } catch (error) {
        console.error("Error al cargar notas:", error);
        alert("Error al cargar las notas");
    } finally {
        loading.value = false;
    }
};

const eliminarNota = async (id) => {
    if (!confirm("¿Estás seguro de eliminar esta nota?")) return;

    try {
        await notasService.delete(id);
        await cargarNotas(); // Recargar la lista
    } catch (error) {
        console.error("Error al eliminar:", error);
        alert("Error al eliminar la nota");
    }
};

onMounted(() => {
    cargarNotas();
});
</script>
