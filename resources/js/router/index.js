
import {createWebHistory, createRouter} from "vue-router";

//Products
import Products from '../components/Products';
import AddProduct from '../components/AddProduct';
import Category from '../components/Category';

import AddCategory from '../components/AddCategory';



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
    },
    {
        name: 'category',
        path: '/category',
        component: Category
    },
    {
        name: 'addcategory',
        path: '/addcategory',
        component: AddCategory
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
