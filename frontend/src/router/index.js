import { createRouter, createWebHistory } from "vue-router";
import ViewApiLivro from "../views/apigit/ViewApiLivro.vue";
import ViewAdicionarLivro from "../views/apigit/ViewAdcionarLivro.vue";
import ViewAdicionarAutor from "../views/apigit/ViewAdcionarAutor.vue";
import ViewAdicionarAssunto from "../views/apigit/ViewAdcionarAssunto.vue";

const router = createRouter({
  history: createWebHistory(process.env.VUE_APP_BASE_URL),
  routes: [
    {
      path: "/apiLivro",
      name: "apiLivro",
      component: ViewApiLivro,
    },
    {
      path: "/",
      name: "adicionarLivro",
      component: ViewAdicionarLivro,
    },
    {
      path: "/adicionarAutor",
      name: "adicionarAutor",
      component: ViewAdicionarAutor,
    },
    {
      path: "/adicionarAssunto",
      name: "adicionarAssunto",
      component: ViewAdicionarAssunto,
    },
  ],
});

export default router;
