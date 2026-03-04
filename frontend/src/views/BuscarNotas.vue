<template>
    <div>
        <h2 class="mb-4">🔍 Buscar Notas</h2>

        <div class="input-group mb-4">
            <input
                type="text"
                v-model="patron"
                class="form-control"
                placeholder="Escribe para buscar..."
                @keyup.enter="buscar"
            />
            <button
                @click="buscar"
                class="btn btn-primary"
                :disabled="cargando"
            >
                <span
                    v-if="cargando"
                    class="spinner-border spinner-border-sm me-2"
                ></span>
                Buscar
            </button>
        </div>

        <div v-if="resultados.length > 0">
            <h5>Resultados ({{ total }}):</h5>
            <div class="list-group">
                <div
                    v-for="nota in resultados"
                    :key="nota.id"
                    class="list-group-item"
                >
                    {{ nota.contenido }}
                    <small class="text-muted d-block">
                        {{ new Date(nota.created_at).toLocaleDateString() }}
                    </small>
                </div>
            </div>
        </div>

        <div v-else-if="buscado && !cargando" class="alert alert-info">
            No se encontraron notas con "{{ patronBuscado }}"
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { notasService } from "../services/notasService";

const patron = ref("");
const patronBuscado = ref("");
const resultados = ref([]);
const total = ref(0);
const cargando = ref(false);
const buscado = ref(false);

const buscar = async () => {
    if (!patron.value.trim()) return;

    try {
        cargando.value = true;
        buscado.value = true;
        patronBuscado.value = patron.value;

        const response = await notasService.buscar(patron.value);
        resultados.value = response.data.coincidencias;
        total.value = response.data.total;
    } catch (error) {
        console.error("Error al buscar:", error);
        alert("Error en la búsqueda");
    } finally {
        cargando.value = false;
    }
};
</script>
