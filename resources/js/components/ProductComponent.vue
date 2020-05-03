<template>
    <div>
        <div class="list-group">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{product.name}}</h5>
                    <small>{{product.price_gross}}</small>
                </div>
                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
        </div>
        <button class="btn btn-primary" @click="addToCart">Add to Cart</button>
        <p>{{message}}</p>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "ProductComponent",
        props: ['product'],
        data: function () {
            return {
                errors: {},
                message: ''
            };
        },
        methods: {
            addToCart() {
                axios.post('/cart', {product_id: this.product.id}).then(
                    () => {
                        this.errors = {};
                        this.message = 'Product successfully added';
                    }).catch(error => {
                    this.message = '';
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>

<style scoped>

</style>
