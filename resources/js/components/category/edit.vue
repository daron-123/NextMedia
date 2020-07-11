<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Edit Product</div>

                <div v-if="errors" class="alert alert-danger">
                    <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-sm">
                            {{ error }}
                        </p>
                    </div>
                </div>

                <form @submit.prevent="saveCategory" >

                    <div class="form-group">
                        <label for="name">Name :</label>
                        <input type="text" class="form-control"
                               v-model="category.name" placeholder="Name" id="name">
                    </div>
                    <div class="form-group">
                        <label >Category:</label>
                        <select class="form-control" v-model="category.parent_id">
                            <option v-for = "cat in categories"
                                    :value="cat.id" >{{cat.name}}</option>
                        </select>
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
                category : {
                    name:'',
                    parent_id: null
                }
            }
        },
        created() {
            axios.get('/categories/list')
                .then(response => {
                    this.categories = response.data;
                });
            axios.get('/categories/'+this.$route.params.id+'/edit')
                .then(response => {
                    this.category = response.data.data;
                });
        },
        methods: {
            saveCategory (event) {
                this.category["_method"] = "PUT";
                axios.post('/categories/'+this.$route.params.id,this.category).
                then(response => {
                    this.$router.push("/categorie");
                }).catch(e => {
                    this.errors = e.response.data.errors;
                });

            }
        }
    }
</script>
