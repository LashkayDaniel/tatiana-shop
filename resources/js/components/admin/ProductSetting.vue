<template>

    <add-product v-if="this.showAddProduct"
                 :product-name="this.toggle_buttons.currentItemSlug"
                 @closePopup="closeAddPopup"/>

    <edit-product v-if="this.showEditProduct"
                  :product-data="this.products.selectedProduct"
                  :products-title="toggle_buttons.currentItemSlug"
                  @closeEditPopup="closeEditPopup"/>

    <delete-product v-if="this.showDeleteProduct"
                    :product-data="this.products.selectedProduct"
                    :products-title="toggle_buttons.currentItemSlug"
                    @closeDeletePopup="closeDeletePopup"/>


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
            <div class="tags__item" v-for="tag in tags.tagsList">
                {{ tag.name }}
                <button class="tags__btn-delete" @click.prevent="this.deleteTag(tag.id)">&#10799;</button>
            </div>
            <button class="tags__add-btn" @click="showAddNewTag=!showAddNewTag">&#10133;</button>
            <div class="tags__add-new" v-if="showAddNewTag">
                <input type="text" v-model="tags.newTag" placeholder="Введіть назву">
                <button @click="addNewTag(toggle_buttons.currentItemSlug)">Додати</button>
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
                        <button class="buttons__edit" @click="editRow(product)">Редагувати</button>
                        <hr>
                        <button class="buttons__remove" @click="deleteRow(product)">Видалити</button>
                    </td>
                </tr>
            </table>

            <p class="products-list__not-found" v-if="products.productList.length===0 && showLoading===false">
                <i>Товари відсутні. Додайте нові</i>
            </p>


            <nav class="pagination">
                <ul class="pagination__items">
                    <li class="items__btn-prev" v-if="pagination.currentPage > 1"
                        @click="goToPage(pagination.currentPage - 1)"><a>&laquo;</a></li>
                    <li v-if="pagination.lastPage!==1" class="items__btn" v-for="page in pagination.lastPage"
                        :key="page"
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
import EditProduct from "../admin/EditProduct.vue";
import DeleteProduct from "../admin/DeleteProduct.vue";
import Loader from "../Loader.vue";

export default {
    name: "ProductSetting",
    components: {
        addProduct: AddProduct,
        loader: Loader,
        EditProduct,
        DeleteProduct,
    },
    data() {
        return {
            showAddNewTag: false,
            showAddProduct: false,
            showEditProduct: false,
            showDeleteProduct: false,
            showLoading: true,

            toggle_buttons: {
                btns: [
                    {name: 'Вишиванки', slug: 'vishivanki'},
                    {name: 'Бісер', slug: 'biser'},
                    {name: 'Схеми вишивок', slug: 'scheme'},
                    {name: 'Жіночий одяг', slug: 'clothes'},
                ],
                activeButton: 0,
                currentItemSlug: 'vishivanki',
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
                selectedProduct: '',
            },

            pagination: {
                currentPage: 1,
                lastPage: 0,
            },

        }
    },
    methods: {
        closeAddPopup() {
            this.showAddProduct = false;
            this.getProducts(this.toggle_buttons.currentItemSlug);
        },

        closeEditPopup() {
            this.showEditProduct = false;
            this.getProducts(this.toggle_buttons.currentItemSlug);
        },

        closeDeletePopup() {
            this.showDeleteProduct = false;
            this.getProducts(this.toggle_buttons.currentItemSlug);
        },

        setActiveButton(index) {
            this.toggle_buttons.activeButton = index;
            this.toggle_buttons.currentItemSlug = this.toggle_buttons.btns[index].slug;
            this.loadAllData();
        },

        //////
        getAllTags(slugName) {

            this.tags.tagsList = []
            axios.get('/api/' + slugName + '/get-tags')
                .then(resp => {
                    resp.data.forEach((e) => {
                        this.tags.tagsList.push({
                            id: e.id,
                            name: e.name
                        });
                    });
                })
        },

        addNewTag(slugName) {

            axios.post('/api/' + slugName + '/new-tag', {
                name: this.tags.newTag
            })
                .then(resp => {
                    this.getAllTags(slugName);
                    this.showAddNewTag = false
                    this.tags.newTag = ''
                    this.tags.error = ''
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    errors.hasOwnProperty('name') ? this.tags.error = errors.name[0] : ''
                })
        },

        deleteTag(id) {
            const slug = this.toggle_buttons.currentItemSlug;
            axios.delete(`/api/${slug}/delete-tag/${id}`)
                .then(resp => {
                    this.getAllTags(slug);
                })
                .catch(err => {
                    console.log(err);
                })
        },

        getProducts(slugName, page = 1) {
            axios.get(`/api/${slugName}/get-all?page=` + page)
                .then(resp => {
                    this.products.productList = [];
                    const products = resp.data.data;

                    this.pagination.currentPage = resp.data.current_page;
                    this.pagination.lastPage = resp.data.last_page;

                    console.log(products);

                    if (products) {
                        products.forEach(elem => {
                            const product = {
                                id: elem.id,
                                image: `/storage/uploads/products/${slugName}/` + elem.image,
                                title: elem.title,
                                description: elem.description,
                                price: elem.price,
                                tag: elem[`${slugName}_tag`].name
                            };


                            this.products.productList.push(product);
                        })
                    }
                    this.showLoading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        goToPage(page) {
            this.getProducts(this.toggle_buttons.currentItemSlug, page);
        },

        loadAllData() {
            const itemSlug = this.toggle_buttons.currentItemSlug;
            this.getAllTags(itemSlug);
            this.getProducts(itemSlug);
        },

        //// update row
        editRow(rowData) {
            this.showEditProduct = true;
            this.products.selectedProduct = rowData;
            console.log(rowData);
        },

        deleteRow(rowData) {
            this.showDeleteProduct = true;
            this.products.selectedProduct = rowData;
        }

    },
    mounted() {
        this.loadAllData()
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_product-setting.scss";
</style>
