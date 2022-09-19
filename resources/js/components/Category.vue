<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">All Categories Data</h5>
                <div>
                    <button class="btn btn-success" type="button" @click="this.$router.push('/addcategory')">New Category</button>
                </div>
            </div>
            
            <table class="table table-hover table-sm">
                <thead class="bg-dark text-light">
                    <tr>
                        <th width="50" class="text-center">#</th>
                        <th>Category</th>
                        <th>parent category</th>
                        <th class="text-center" width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in category" :key="data.id">
                        <td class="text-center">{{index+1}}.</td>
                        <td>{{data.category}}</td>
                        <td>{{data.p_category}}</td>
                        
                        <td class="text-center">
                        <router-link :to="{name:'home'}" class="btn btn-warning">Edit</router-link>
                            <button class="btn btn-danger">Delete</button>
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
                    category: [],
                    strSuccess: '',
                    strError: ''
                }
            },
            created() {
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                
                    this.$axios.get('/api/category')
                    .then(response => {
                        this.category = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                    });
             
            },
            methods: {
                
            }
        }
    
    </script>