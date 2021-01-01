import { createWebHistory, createRouter } from "vue-router";
import Libros from "@/components/Libros.vue"
import CrearLibro from "@/components/CrearLibro.vue"
import CrearAutor from "@/components/CrearAutor.vue"
import CrearEditorial from "@/components/CrearEditorial.vue"

const routes = [
  
  {
    path: "/",
    name: "Libros",
    component: Libros,
  },
  {
    path: "/Libro",
    name: "Libro",
    component: CrearLibro,
  },
  {
    path: "/Editorial",
    name: "Editorial",
    component: CrearEditorial,
  },
  {
    path: "/Autor",
    name: "Autor",
    component: CrearAutor,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;