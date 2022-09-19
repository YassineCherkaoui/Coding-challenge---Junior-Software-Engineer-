
import {createWebHistory, createRouter} from "vue-router";

//Products
import Products from '../components/Products';
import AddProduct from '../components/AddProduct';



export const routes = [
    {
        name: 'home',
        path: '/',
        component: Products
    },
    {
        name: 'addproduct',
        path: '/add',
        component: AddProduct
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
