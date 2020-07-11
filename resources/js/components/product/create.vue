<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Create Product</div>
                <div v-if="errors" class="alert alert-danger">
                    <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-sm">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <form @submit.prevent="saveProduct" >
                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" class="form-control"
                               v-model="product.name" placeholder="Name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea name="description" class="form-control"
                                  v-model="product.description" id="description" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">price:</label>
                        <input type="number" class="form-control"
                               v-model="product.price" placeholder="price" id="price">
                    </div>

                    <div class="form-group">
                        <label for="price">Category:</label>
                        <select multiple class="form-control" size="3" v-model="product.categories">
                            <option v-for = "category in categories"
                                    :value="category.id" >{{category.name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input required type="file" class="form-control"
                               placeholder="image" id="image" @change="selectFile">
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              categories:[],
              errors : null,
              product : {
                  name:'',
                  description : "",
                  price: "",
                  image: "",
                  categories: []
              }
          }
        },
        created() {
            axios.get('/categories/list')
                .then(response => {
                    this.categories = response.data;
                });
        },
        mounted() {
            console.log('product create.')
        },
        methods: {
            saveProduct (event) {

                let formData = new FormData();
                for ( var key in this.product ) {
                    formData.append(key, this.product[key]);
                }
                axios.post('/products/',formData,{

                    headers: { 'content-type': 'multipart/form-data' }

                }).then(response => {
                    this.$router.push("/produit");
                }).catch(e => {
                    this.errors = e.response.data.errors;
                })


            },
            selectFile(event){
                this.product.image = event.target.files[0];
            }
        }
    }
</script>
