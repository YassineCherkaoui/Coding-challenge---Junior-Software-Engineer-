<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New Category Data</h5>
                <div>
                    <!-- <router-link :to="{name: 'products'}" class="btn btn-success">Go Back</router-link> -->
                </div>
            </div>

            <div v-if="strSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strSuccess}}</strong>
            </div>

            <div v-if="strError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{strError}}</strong>
            </div>


            <form @submit.prevent="addCategoy" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter category name">
                </div>


                <div class="form-group mb-2">
                    <label>Parent Category</label><span class="text-danger"> *</span>
                    <select v-model="p_category" class="form-control"> 
                        
                        <option value="all">Parent Category</option>
                        <!-- <option value="all">all</option> -->
                        <option v-for="(categ) in categoriesArr" :key="categ.id">{{categ.name}}</option>
                            
                    </select>

                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add Category</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            name: '',
            p_category: '',
            strSuccess: '',
            strError: '',
            categoriesArr: []
        }
    },
    created() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
            
                this.$axios.get('/api/category')
                .then(response => {
                    this.categoriesArr = response.data;
                    console.log(response.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
                });
         
        },
    methods: {
        addCategoy(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('p_category', this.p_category);

                this.$axios.post('/api/categoryad', formData, config)
                .then(response => {
                    existingObj.strError = "";
                    existingObj.strSuccess = response.data.success;
                })
                .catch(function(error) {
                    existingObj.strSuccess ="";
                    existingObj.strError = error.response.data.message;
                });
            });
        }

    },

}

</script>