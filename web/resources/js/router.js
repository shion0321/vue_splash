import Vue from "vue";
import VueRouter from "vue-router";

import PhotoList from "./pages/PhotoList.vue";
import PhotoDetail from "./pages/PhotoDetail.vue";
import Login from "./pages/Login.vue";
import store from "./store";
import SystemError from "./pages/errors/System.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: PhotoList
    },
    {
        path: "/photo/:id",
        component: PhotoDetail,
        props:true,
    },
    {
        path: "/login",
        component: Login,
        beforeEnter: (to, from, next) => {
            console.log(store.getters['auth/check'])
            if (store.getters["auth/check"]) {
                next("/");
            } else {
                next();
            }
        }
    },
    {
        path: "/500",
        component: SystemError
    }
];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
