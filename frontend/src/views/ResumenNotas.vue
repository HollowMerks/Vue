<template>
    <div>
        <h2 class="mb-4">📊 Resumen de Notas</h2>

        <div v-if="cargando" class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>

        <div v-else class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total</h5>
                        <p class="card-text display-4">{{ resumen.total }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Distintas</h5>
                        <p class="card-text display-4">
                            {{ resumen.distintas }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Promedio</h5>
                        <p class="card-text display-4">
                            {{ resumen.largoPromedio }}
                        </p>
                        <small>caracteres</small>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">📏 Nota más larga</h5>
                        <p class="card-text display-6">
                            {{ resumen.masLarga }} caracteres
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">📐 Nota más corta</h5>
                        <p class="card-text display-6">
                            {{ resumen.masCorta }} caracteres
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { notasService } from "../services/notasService";

const cargando = ref(true);
const resumen = ref({
    total: 0,
    distintas: 0,
    masLarga: 0,
    masCorta: 0,
    largoPromedio: 0,
});

const cargarResumen = async () => {
    try {
        cargando.value = true;
        const response = await notasService.resumen();
        resumen.value = response.data;
    } catch (error) {
        console.error("Error al cargar resumen:", error);
        alert("Error al cargar el resumen");
    } finally {
        cargando.value = false;
    }
};

onMounted(() => {
    cargarResumen();
});
</script>
