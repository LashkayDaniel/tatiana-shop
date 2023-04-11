<template>

    <toTop/>
    <navbar>
        <template v-slot:phone>
            <p class="phone">{{ this.phoneNumber }}</p>
        </template>
    </navbar>

    <div class="container">
        <section class="block">
            <div class="block__left">
                <router-link to="/">
                    <button class="left__btn">Головна</button>
                </router-link>
            </div>
            <div class="block__right">
                <div class="right__title-block">
                    <div class="title-block__title">{{ pageTitle }}</div>
                    <div class="title-block__btn-filters">
                        <button class="btn-filters__button" v-for="(tag,index) in tags.tagsList"
                                :key="index"
                                @click="this.setActiveFilter(index)"
                                :class="{'btn-filters__button--active' : this.tags.activeTag === index}">
                            {{ tag }}
                        </button>
                    </div>
                </div>
                <div class="right__products-list">
                    <loader v-if="showLoading"/>

                    <div v-else class="products-list__item" v-for="product in this.products.productList">
                        <div class="item__img">
                            <img :src="product.image" alt="item image"/>
                        </div>
                        <h2 class="item__title">{{ product.title }}</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item" v-for="description in product.description">
                                <b>{{ description.name }}: </b>
                                <i>{{ description.value }}</i>
                            </p>
                            <p class="descriptions__tag">{{ product.tag }}</p>
                        </div>
                        <div class="item__price">{{ product.price }} грн</div>
                    </div>
                </div>

                <p v-if="products.productList.length===0 && showLoading===false">Товари відсутні</p>

                <nav class="pagination">
                    <ul class="pagination__btns">
                        <li class="btns__btn-prev" v-if="pagination.currentPage > 1"
                            @click="goToPage(pagination.currentPage - 1)"><a>&laquo;</a></li>
                        <li v-if="pagination.lastPage!==1" class="btns__btn" v-for="page in pagination.lastPage"
                            :key="page"
                            :class="{ 'btns__btn--active': page === pagination.currentPage }"
                            @click="goToPage(page)">
                            <a>{{ page }}</a>
                        </li>
                        <li class="btns__btn-next" v-if="pagination.currentPage < pagination.lastPage"
                            @click="goToPage(pagination.currentPage + 1)"><a>&raquo;</a></li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
</template>

<script>
import Header from "./Header.vue";
import ToTop from "./ToTop.vue";
import Loader from "./Loader.vue";

export default {
    name: "Products",
    components: {
        navbar: Header,
        toTop: ToTop,
        loader: Loader,
    },
    data() {
        return {
            phoneNumber: '',
            routeName: this.$route.params.slug,
            pageTitle: '',
            showLoading: true,

            tags: {
                tagsList: ['Всі'],
                activeTag: 0,
            },

            products: {
                productList: [],
            },

            pagination: {
                currentPage: 1,
                lastPage: 0,
            },
        }
    },
    methods: {
        toUp() {
            window.scrollTo(0, 0);
        },
        getPhoneNumber() {
            axios.get('/api/settings/get')
                .then(resp => {
                    this.phoneNumber = resp.data.phone_number;
                })
        },

        setActiveFilter(index) {
            this.tags.activeTag = index;

            this.getAllProducts(this.routeName);
        },

        goToPage(page) {
            this.getAllProducts(this.routeName, page);
            this.toUp();
        },

        //tags
        getAllTags(sectionName) {
            axios.get(`/api/${sectionName}/get-tags`)
                .then(response => {
                    const tags = response.data;
                    tags.forEach(elem => {
                        this.tags.tagsList.push(elem.name);
                    });
                })

        },

        // products
        getAllProducts(sectionName, page = 1) {

            const tagName = this.tags.activeTag === 0 ? 'all' : this.tags.tagsList[this.tags.activeTag];
            axios.post(`/api/${sectionName}/get-all?page=${page}`, {
                tag_name: tagName,
            })
                .then(response => {
                    this.products.productList = [];
                    const products = response.data.data;

                    this.pagination.currentPage = response.data.current_page;
                    this.pagination.lastPage = response.data.last_page;

                    products.forEach(elem => {

                        const descriptionItems = [];
                        const description = elem.description.split('!');

                        description.forEach(e => {
                            const descriptionItem = {
                                name: e.split(':')[0],
                                value: e.split(':')[1]
                            };
                            descriptionItems.push(descriptionItem)
                        })


                        const product = {
                            image: `/storage/uploads/products/${sectionName}/${elem.image}`,
                            title: elem.title,
                            description: descriptionItems,
                            price: elem.price,
                            tag: elem[`${sectionName}_tag`].name
                        };

                        this.products.productList.push(product);
                    })
                    this.showLoading = false;

                    console.log(products.productList);
                });
        },
    },
    mounted() {
        this.toUp();
        this.getPhoneNumber();

        this.getAllTags(this.routeName);

        const routeTitles = {
            vishivanki: 'Вишиванки',
            biser: 'Бісер',
            scheme: 'Схеми вишивок',
            clothes: 'Жіночий одяг'
        };

        if (this.routeName in routeTitles) {
            this.pageTitle = routeTitles[this.routeName];
            this.getAllProducts(this.routeName);
        } else {
            this.$router.push({name: 'notFound'});
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/products/_products-main.scss";


.phone {
    font-size: 20px;
    font-weight: 600;
    color: #7C2222;
    position: relative;

    &:before {
        position: absolute;
        content: url('@/../img/phone.png');
        left: -30px;
        top: 2px;
    }
}

.container {
    max-width: 1300px;
    padding: 0 15px;
    margin: 50px auto;
}

</style>
