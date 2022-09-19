<template>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
            
            <div class="navbar-nav">
                <router-link to="/" class="nav-item nav-link">Products</router-link>
                <router-link to="/category" class="nav-item nav-link">Category</router-link>
            </div>
        </nav>


        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name: "App"
    }


</script>