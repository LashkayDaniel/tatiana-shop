<template>

    <add-product v-if="this.showAddProduct"
                 @closePopup="closePopup"/>

    <div class="block">
        <section class="products">
            <div class="products__item">Вишиванки</div>
            <div class="products__item">Бісер</div>
            <div class="products__item">Схеми вишивок</div>
            <div class="products__item">Жіночий одяг</div>
        </section>

        <section class="tags">
            <div class="tags__item" v-for="tag in tags.tagsList">{{ tag }}</div>
            <button class="tags__add-btn" @click="showAddNewTag=!showAddNewTag">&#10133;</button>
            <div class="tags__add-new" v-if="showAddNewTag">
                <input type="text" v-model="tags.newTag" placeholder="Введіть назву">
                <button @click="addNewTag">Додати</button>
                <p v-if="tags.error.length!==0">{{ tags.error }}</p>
            </div>
        </section>

        <section class="products-list">
            <button @click="this.showAddProduct=true" class="products-list__btn-add">Додати товар</button>
            <table class="products-list__table">
                <tr>
                    <th>Фото</th>
                    <th>Тег</th>
                    <th>Назва товару</th>
                    <th>Опис</th>
                    <th>Ціна (грн)</th>
                    <th></th>
                </tr>
                <tr v-for="product in products.productList">
                    <td>
                        <img
                            :src="product.image"
                            height="50" width="40"
                            alt="">
                    </td>
                    <td>{{ product.tag }}</td>
                    <td>{{ product.title }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                        <button>&#9998; edit</button>
                        <hr>
                        <button>remove</button>
                    </td>
                </tr>

            </table>
        </section>
    </div>
</template>

<script>
import AddProduct from "../admin/AddProduct.vue";

export default {
    name: "ProductSetting",
    components: {
        addProduct: AddProduct,
    },
    data() {
        return {
            showAddNewTag: false,
            showAddProduct: false,

            tags: {
                tagsList: [],
                newTag: '',
                error: ''
            },

            products: {
                productList: [
                    {
                        image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6fR5SsqzCihzjdr6duRpAKBJzb3iTGsNi4A&usqp=CAU'
                    }
                ],
                image: '',
                title: '',
                description: '',
                price: '',
            },

        }
    },
    methods: {
        closePopup() {
            this.showAddProduct = false;
            this.getAllProducts();
        },
        //////
        getAllTags() {
            this.tags.tagsList = []
            axios.get('/api/vishivanki/get-tags')
                .then(resp => {
                    resp.data.forEach((e) => {
                        this.tags.tagsList.push(e.name);
                    });
                })
        },

        addNewTag() {
            axios.post('/api/vishivanki/new-tag', {
                name: this.tags.newTag
            })
                .then(resp => {
                    this.getAllTags();
                    this.showAddNewTag = false
                    this.tags.newTag = ''
                    this.tags.error = ''
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    errors.hasOwnProperty('name') ? this.tags.error = errors.name[0] : ''
                })
        },

        getAllProducts() {
            axios.get('/api/vishivanki/get-all')
                .then(resp => {
                    this.products.productList = [];
                    const products = resp.data;
                    products.forEach(elem => {
                        const product = {
                            image: '/storage/uploads/products/vishivanki/' + elem.image,
                            title: elem.title,
                            description: elem.description,
                            price: elem.price,
                            tag: elem.vishivanki_tag.name
                        };
                        this.products.productList.push(product);
                    })
                })
                .catch(err => {

                });
        },
    },
    mounted() {
        this.getAllTags();
        this.getAllProducts();
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_product-setting.scss";


</style>
