import { createRouter, createWebHistory } from 'vue-router';
import ListaNotas from '../views/ListaNotas.vue';
import AgregarNotas from '../views/AgregarNotas.vue';
import EditarNotas from '../views/EditarNotas.vue';
import BuscarNotas from '../views/BuscarNotas.vue';
import ResumenNotas from '../views/ResumenNotas.vue';

const routes = [
  { path: '/', component: ListaNotas, name: 'lista' },
  { path: '/agregar', component: AgregarNotas, name: 'agregar' },
  { path: '/editar/:id', component: EditarNotas, name: 'editar', props: true },
  { path: '/buscar', component: BuscarNotas, name: 'buscar' },
  { path: '/resumen', component: ResumenNotas, name: 'resumen' }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
