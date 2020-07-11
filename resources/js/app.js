require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import Axios from "axios";
import VueAxios from "vue-axios";
Vue.use(VueAxios,Axios);
Vue.component('pagination', require('laravel-vue-pagination'));
window.ViewDiv = {
    template: `<div class="user"><router-view></router-view></div>`
};
import ProductIndex from './components/product/index.vue';
import ProductCreate from './components/product/create.vue';
import ProductEdit from './components/product/edit.vue';
import CategoryIndex from './components/category/index.vue';
import CategoryCreate from './components/category/create.vue';
import CategoryEdit from './components/category/edit.vue';


const routes = [
    {
      path:"/",
        redirect:"/produit"
    },
    {
        path: '/produit',
        component: ViewDiv,
        children: [
            {
                path: '',
                component: ProductIndex,
                name:'product.index',
                props:true,
            },
            {
                path: 'ajouter',
                component: ProductCreate,
                name:'product.create',
            },
            {
                path: ':id/editer',
                component: ProductEdit,
                name:'product.edit',
            }
        ]
    },

    {
        path: '/categorie',
        component: ViewDiv,
        children : [
            {
                path: '',
                component: CategoryIndex,
                name:'category.index',
            },
            {
                path: 'ajouter',
                component: CategoryCreate,
                name:'category.create',
            },
            {
                path: ':id/editer',
                component: CategoryEdit,
                name:'category.edit',
            }
        ]
    },


];

const router = new VueRouter({ routes: routes});
const app = new Vue({
    router
}).$mount('#app')
