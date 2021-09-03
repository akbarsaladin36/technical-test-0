import { createWebHistory, createRouter } from "vue-router";

const routes = [
  {
    path: "/",
    alias: "/home",
    name: "Home",
    component: () => import("./components/Home.vue"),
  },
  {
    path: "/create-data",
    name: "Create Data",
    component: () => import("./components/CreateData.vue"),
  },
  {
    path: "/detail/:id",
    name: "Detail Data",
    component: () => import("./components/DetailData.vue"),
  },
  {
    path: "/detail/:id/edit-data",
    name: "Edit Data",
    component: () => import("./components/EditData.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
