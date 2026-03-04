<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container">
                <router-link class="navbar-brand" to="/"
                    >📝 Mis Notas</router-link
                >
                <div class="navbar-nav">
                    <router-link
                        class="nav-link"
                        to="/"
                        :class="{ active: $route.name === 'lista' }"
                        >Lista</router-link
                    >
                    <router-link
                        class="nav-link"
                        to="/agregar"
                        :class="{ active: $route.name === 'agregar' }"
                        >Agregar</router-link
                    >
                    <router-link
                        class="nav-link"
                        to="/buscar"
                        :class="{ active: $route.name === 'buscar' }"
                        >Buscar</router-link
                    >
                    <router-link
                        class="nav-link"
                        to="/resumen"
                        :class="{ active: $route.name === 'resumen' }"
                        >Resumen</router-link
                    >
                </div>
            </div>
        </nav>

        <div class="container">
            <router-view />
        </div>
    </div>
</template>

<script setup>
// No se necesita lógica aquí por ahora
</script>

<style>
@import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css";
</style>
