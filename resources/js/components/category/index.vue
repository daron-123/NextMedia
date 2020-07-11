<template>
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4" style="color: black">Category List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <router-link class="col-12 btn btn-success" to="/categorie/ajouter">Ajouter</router-link>
                <!-- List group-->
                <ul class="list-group shadow">
                    <!-- list group item-->
                    <li class="list-group-item"  v-for="category in categories.data" :key="category.id">
                        <!-- Custom content-->
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                            <div class="media-body order-2 order-lg-1">
                                <h5 class="mt-0 font-weight-bold mb-2">{{category.name}}</h5>
                            </div>
                        </div> <!-- End -->

                        <router-link class="btn btn-danger" :to="{name:'category.edit',params:{id:category.id}}">
                            Editer</router-link>

                        <router-link class="btn btn-primary" :to="{name:'product.index',query: { category: category.id },params:{id:category.id}}">
                            View Products</router-link>

                    </li> <!-- End -->
                    <pagination :data="categories" @pagination-change-page="getResults"></pagination>
                </ul> <!-- End -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                categories : {}
            }
        },
        created() {
            this.getResults();
        },
        mounted() {

        },
        methods:{
            getResults(page = 1) {
                axios.get('/categories?page=' + page)
                    .then(response => {
                        this.categories = response.data;
                    });
            }
        }
    }
</script>
