<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item" v-for="product in cart" :key="product.id">
                {{product.name}},
                {{product.quantity}},
                {{product.price}}
                <button @click="removeProduct(product.id)" class="btn btn-danger">Remove</button>
            </li>
        </ul>
        <div v-if="cart.length > 0">
            <button class="btn btn-primary" @click.prevent="showForm">Make Order</button>
        </div>
        <div v-if="showOrderForm">

            <p>
                <label for="name">First Name</label>
                <input
                        id="name"
                        v-model="customer.first_name"
                        type="text"
                        name="name"
                >
            </p>

            <p>
                <label for="surname">Surname</label>
                <input
                        id="surname"
                        v-model="customer.surname"
                        type="text"
                        name="surname"
                >
            </p>

            <p>
                <label for="street">Street</label>
                <input
                        id="street"
                        v-model="customer.street"
                        type="text"
                        name="street"
                >
            </p>
            <p>
                <label for="city">City</label>
                <input
                        id="city"
                        v-model="customer.city"
                        type="text"
                        name="city"
                >
            </p>
            <p>
                <label for="postal_code">Postal Code</label>
                <input
                        id="postal_code"
                        v-model="customer.postal_code"
                        type="text"
                        name="postal_code"
                >
            </p>
            <p>
                <label for="phone">Phone</label>
                <input
                        id="phone"
                        v-model="customer.phone"
                        type="text"
                        name="phone"
                >
            </p>
            <p>
                <label for="email">E-mail</label>
                <input
                        id="email"
                        v-model="customer.email"
                        type="text"
                        name="email"
                >
            </p>
            <p>
                <label for="nip">Nip</label>
                <input
                        id="nip"
                        v-model="customer.nip"
                        type="text"
                        name="nip"
                >
            </p>
            <button class="btn btn-primary" @click="makeOrder">Make order</button>
        </div>
        <p v-if="message.length > 0">
            {{message}}
        </p>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "CartComponent",
        props: ['products'],
        data: function () {
            return {
                errors: [],
                cart: [],
                showOrderForm: false,
                message: '',
                customer: {
                    first_name: '',
                    surname: '',
                    street: '',
                    city: '',
                    postal_code: '',
                    phone: '',
                    email: '',
                    nip: ''
                },
            }
        },
        created() {
            this.cart = this.products;
        },
        methods: {
            removeProduct(productId) {
                axios.delete('/cart/' + productId).then(
                    (response) => {
                        this.cart = response.data.products;
                        this.errors = {};
                    }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
            showForm() {
                this.showOrderForm = !this.showOrderForm
            },
            makeOrder() {
                axios.post('/order', {customer: this.customer}).then(
                    () => {
                        this.errors = {};
                        this.message = 'Ok';
                        this.cart = [];
                    }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>

</style>
