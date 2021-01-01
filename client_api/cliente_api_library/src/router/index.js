import { createWebHistory, createRouter } from "vue-router";
import Libros from "@/components/Libros.vue"
import CrearLibro from "@/components/CrearLibro.vue"
import Editorial from "@/components/CrearEditorial.vue"

const routes = [
  
  {
    path: "/",
    name: "Libros",
    component: Libros,
  },
  {
    path: "/CrearLibro",
    name: "CrearLibro",
    component: CrearLibro,
  },
  {
    path: "/Editorial",
    name: "Editorial",
    component: Editorial,
  }/*,
  {
    path: "/Autor",
    name: "Autor",
    component: Autor,
  },*/
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;