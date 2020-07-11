<template>
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4" style="color: black">Product List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form class="form-inline " action="/action_page.php">
                    <div class="form-group col-lg-5">
                        <label class="col-lg-4" for="categories">Category:</label>
                        <select @change="searchProducts" id="categories" class="form-control col-lg-8" v-model="category">
                            <option value=""></option>
                            <option v-for = "cat in categories"
                                    :value="cat.id" >{{cat.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="price" class="col-lg-4">Price:</label>
                        <select @change="searchProducts" class="form-control col-lg-8" id="price" v-model="price"
                                 name="price">
                            <option value=""></option>
                            <option value="desc">Desc</option>
                            <option value="asc">ASC</option>
                        </select>
                    </div>
                </form>
                <router-link class="col-12 btn btn-success" to="/produit/ajouter">Ajouter</router-link>
                <!-- List group-->
                <ul class="list-group shadow">
                    <!-- list group item-->
                    <li class="list-group-item"  v-for="product in products.data" :key="product.id">
                        <!-- Custom content-->
                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                            <div class="media-body order-2 order-lg-1">
                                <h5 class="mt-0 font-weight-bold mb-2">{{product.name}}</h5>
                                <p class="font-italic text-muted mb-0 small">
                                    {{ product.description }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between mt-1">
                                    <h6 class="font-weight-bold my-2">{{product.price}} DH</h6>
                                </div>
                            </div><img style="height: 170px;width: 140px" :src="product.image"
                                       alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">

                        </div> <!-- End -->
                        <a v-for="category in product.categories.data" href="#" class="badge badge-primary">{{ category.name}}</a>
                        <br>
                        <router-link class="btn btn-danger" :to="{name:'product.edit',params:{id:product.id}}">
                            Editer</router-link>

                    </li> <!-- End -->
                    <pagination :key="$route.fullPath" :data="products" @pagination-change-page="getResults"></pagination>
                </ul> <!-- End -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                products : {},
                categories: {},
                category: null,
                price : null,
            }
        },
        created() {
            this.getResults();
            axios.get('/categories/list')
                .then(response => {
                    this.categories = response.data;
                });
        },
        mounted() {

        },
        methods:{
            getResults(page = 1) {
                var price= this.price;
                var category = this.category;
                var path = '/products?page=' + page;
                if(this.$route.query.category){
                    path = path +"&category="+this.$route.query.category;
                }else if(category){
                    path = path +"&category="+this.category;
                }
                if(price){
                    path = path +"&price="+this.price;
                }

                axios.get(path)
                    .then(response => {
                        this.products = response.data;
                    });
            },
            searchProducts(){
                this.getResults(1);
            }
        }
    }
</script>
