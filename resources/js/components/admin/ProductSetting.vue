<template>

    <add-product v-if="this.showAddProduct"
                 @closePopup="closePopup"/>

    <div class="block">
        <section class="products">
            <button class="products__item"
                    v-for="(button,index) in toggle_buttons.btns"
                    :key="index"
                    @click="this.setActiveButton(index)"
                    :class="{ 'products__item--active': this.toggle_buttons.activeButton === index }">
                {{ button.name }}
            </button>
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

                <tr v-if="this.showLoading">
                    <loader/>
                </tr>

                <tr v-else v-for="product in products.productList">
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
                    <td class="table__buttons">
                        <button class="buttons__edit">Редагувати</button>
                        <hr>
                        <button class="buttons__remove">Видалити</button>
                    </td>
                </tr>
            </table>

            <nav class="pagination">
                <ul class="pagination__items">
                    <li class="items__btn-prev" v-if="pagination.currentPage > 1"
                        @click="goToPage(pagination.currentPage - 1)"><a>&laquo;</a></li>
                    <li class="items__btn" v-for="page in pagination.lastPage" :key="page"
                        :class="{ 'items__btn--active': page === pagination.currentPage }"
                        @click="goToPage(page)">
                        <a>{{ page }}</a>
                    </li>
                    <li class="items__btn-next" v-if="pagination.currentPage < pagination.lastPage"
                        @click="goToPage(pagination.currentPage + 1)"><a>&raquo;</a></li>
                </ul>
            </nav>
        </section>
    </div>
</template>

<script>
import AddProduct from "../admin/AddProduct.vue";
import Loader from "../Loader.vue";

export default {
    name: "ProductSetting",
    components: {
        addProduct: AddProduct,
        loader: Loader,
    },
    data() {
        return {
            showAddNewTag: false,
            showAddProduct: false,
            showLoading: true,

            toggle_buttons: {
                btns: [
                    {name: 'Вишиванки'},
                    {name: 'Бісер'},
                    {name: 'Схеми вишивок'},
                    {name: 'Жіночий одяг'},
                ],
                activeButton: 0,
            },
            tags: {
                tagsList: [],
                newTag: '',
                error: ''
            },

            products: {
                productList: [],
                image: '',
                title: '',
                description: '',
                price: '',
            },

            pagination: {
                currentPage: 1,
                lastPage: 0,
            },

        }
    },
    methods: {
        closePopup() {
            this.showAddProduct = false;
            this.getProducts();
        },

        setActiveButton(index) {
            this.toggle_buttons.activeButton = index;
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

        getProducts(page = 1) {
            axios.get('/api/vishivanki/get-all?page=' + page)
                .then(resp => {
                    this.products.productList = [];
                    const products = resp.data.data;

                    this.pagination.currentPage = resp.data.current_page;
                    this.pagination.lastPage = resp.data.last_page;

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

                    this.showLoading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        goToPage(page) {
            this.getProducts(page);
        },
    },
    mounted() {
        this.getAllTags();
        this.getProducts();
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_product-setting.scss";


</style>
