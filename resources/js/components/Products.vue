<template>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">All Products Data</h5>
            <div>
                <button class="btn btn-success" type="button" @click="this.$router.push('/add')">New Products</button>
            </div>
        </div>
        
        <table class="table table-hover table-sm">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="50" class="text-center">#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Categories</th>
                    <th>price</th>
                    <th class="text-center" width="120">Image</th>
                    <th class="text-center" width="200">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="product.id">
                    <td class="text-center">{{index+1}}.</td>
                    <td>{{product.name}}</td>
                    <td>{{product.description}}</td>
                    <td>{{product.categories}}</td>
                    <td>{{product.price}}</td>
                    <td class="text-center">
                        <div v-if="product.image">
                            <img alt="post-img" width="100" v-bind:src="'/img/' +product.image">
                        </div>
                    </td>
                    <td class="text-center">
                    <router-link :to="{name:'home'}" class="btn btn-warning">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteProducts(product.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</div>


</template>

<script>
    export default {
        data() {
            return {
                products: [],
                strSuccess: '',
                strError: ''
            }
        },
        created() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
            
                this.$axios.get('/api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(function(error) {
                    console.log(error);
                });
                });
         
        },
        methods: {
            deleteProducts(id) {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    let existingObj = this;

                    if(confirm("Do you really want to delete this data?")) {
                        this.$axios.delete(`/api/delete/${id}`)
                        .then(response => {

                            let i = this.products.map(item => item.id).indexOf(id); // find index of your object
                            this.products.splice(i, 1);
                            existingObj.strError = "";
                            existingObj.strSuccess = response.data.success;

                        })
                        .catch(function(error) {
                            existingObj.strError = "";
                            existingObj.strSuccess = error.response.data.message;
                        });
                    }
                });
            }
        }
    }

</script>