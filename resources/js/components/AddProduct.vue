<template>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Add New Products Data</h5>
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


            <form @submit.prevent="addProduct" enctype="multipart/form-data">
                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
                    <input type="text" class="form-control" v-model="name" placeholder="Enter Product name">
                </div>

                <div class="form-group mb-2">
                    <label>Name</label><span class="text-danger"> *</span>
                   <textarea class="form-control" rows="3" v-model="description" placeholder="Enter Product description"></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Price</label><span class="text-danger"> *</span>
                    <input type="double" class="form-control" v-model="price" placeholder="Enter Price of prducts">
                </div>

                <div class="form-gorup mb-2">
                    <label>Image</label><span class="text-danger"> *</span>
                    <input type="file" class="form-control mb-2" v-on:change="onChange">

                    <div v-if="img">
                        <img v-bind:src="imgPreview" width="100" height="100"/>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label>Categories</label><span class="text-danger"> *</span>
                    <select v-model="categories" class="form-control"> 
                        
                        <option value="">Categories</option>
                        <option v-for="(categ) in categoriesArr" :key="categ.id">{{categ.name}}</option>
                            
                    </select>


                </div>


                <button type="submit" class="btn btn-primary mt-4 mb-4"> Add Product</button>

            </form>
            
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            name: '',
            description: '',
            img: '',
            price: '',
            categories: '',
            strSuccess: '',
            strError: '',
            imgPreview: null,
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
        onChange(e) {
            this.img = e.target.files[0];
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                this.imgPreview = reader.result;
            }.bind(this), false);

            if (this.img) {
                if ( /\.(jpe?g|png|gif)$/i.test( this.img.name ) ) {
                    reader.readAsDataURL( this.img );
                }
            }
        },
        addProduct(e) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('file', this.img);
                formData.append('price', this.price);
                formData.append('categories', this.categories);

                this.$axios.post('/api/add', formData, config)
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