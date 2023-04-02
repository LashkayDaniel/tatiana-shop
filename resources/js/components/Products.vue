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
                    <div class="title-block__title">Вишиванки</div>
                    <div class="title-block__btn-filters">
                        <button class="btn-filters__button btn-filters__button--active">Всі</button>
                        <button class="btn-filters__button">Жіночі</button>
                        <button class="btn-filters__button">Чоловічі</button>
                        <button class="btn-filters__button">Дитячі</button>
                    </div>
                </div>
                <div class="right__products-list">
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img1.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка чоловіча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img1.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка чоловіча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                    <div class="products-list__item">
                        <div class="item__img">
                            <img src="@/../img/img4.png" alt="item image"/>
                        </div>
                        <h2 class="item__title">Вишиванка жіноча жіноча жіноча жіноча жіноча жіноча жіноча</h2>
                        <div class="item__descriptions">
                            <p class="descriptions__item">Розмір: <i>L</i></p>
                            <p class="descriptions__item">Виробник: <i>Україна</i></p>
                        </div>
                        <div class="item__price">1000 грн</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Header from "./Header.vue";
import ToTop from "./ToTop.vue";

export default {
    name: "Products",
    components: {
        navbar: Header,
        toTop: ToTop
    }, data() {
        return {
            phoneNumber: '',
        }
    },
    methods: {
        getPhoneNumber() {
            axios.get('/api/settings/get')
                .then(resp => {
                    this.phoneNumber = resp.data.phone_number;
                })
        }
    },
    mounted() {
        window.scrollTo(0, 0);
        this.getPhoneNumber();
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
