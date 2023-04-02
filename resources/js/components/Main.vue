<template>

    <toTop/>
    <navbar>
        <template v-slot:links>
            <a href="#products" class="links__btn">Товари</a>
            <a href="#about-us" class="links__btn">Про нас</a>
        </template>
    </navbar>

    <section class="slider">
        <img src="@/../img/bg1.png" alt="slider image" class="slider__image">
        <div class="slider__info">
            Ми пропонуємо широкий вибір традиційних та сучасних вишиванок, що виготовлені з якісних матеріалів та
            здатні
            виразити Вашу унікальність та стиль.

        </div>
        <div class="slider__btn slider__btn-left"></div>
        <div class="slider__btn slider__btn-right"></div>
        <a href="#products" class="slider__btn-more">Детальніше</a>
        <div class="slider__count">
            <span class="count__item count__item-active"></span>
            <span class="count__item"></span>
            <span class="count__item"></span>
            <span class="count__item"></span>
        </div>
    </section>

    <div class="container">
        <section class="section">
            <h2 id="products" class="section__title">Наші товари</h2>
            <div class="items">
                <div class="items__card">
                    <img class="card__image" src="@/../img/img1.png" alt="">
                    <div class="card__block">
                        <h2 class="block__title">Вишиванки</h2>
                        <ul class="block__items">
                            <li>Жіночі</li>
                            <li>Чоловічі</li>
                            <li>Дитячі</li>
                        </ul>
                        <router-link to="/products/vie">
                            <div class="block__btn">Переглянути</div>
                        </router-link>
                    </div>
                </div>
                <div class="items__card">
                    <img class="card__image" src="@/../img/img2.png" alt="">
                    <div class="card__block">
                        <h2 class="block__title">Бісер</h2>
                        <ul class="block__items">
                            <li>Жіночі</li>
                            <li>Чоловічі</li>
                            <li>Дитячі</li>
                        </ul>
                        <router-link to="/products/vie">
                            <div class="block__btn">Переглянути</div>
                        </router-link>
                    </div>
                </div>
                <div class="items__card">
                    <img class="card__image" src="@/../img/img3.png" alt="">
                    <div class="card__block">
                        <h2 class="block__title">Схеми вишивок</h2>
                        <ul class="block__items">
                            <li>Жіночі</li>
                            <li>Чоловічі</li>
                            <li>Дитячі</li>
                            <li>Дитячі</li>
                        </ul>
                        <router-link to="/products/vie">
                            <div class="block__btn">Переглянути</div>
                        </router-link>
                    </div>
                </div>
                <div class="items__card">
                    <img class="card__image" src="@/../img/img4.png" alt="">
                    <div class="card__block">
                        <h2 class="block__title">Жіночий одяг</h2>
                        <ul class="block__items">
                            <li>Жіночі</li>
                            <li>Чоловічі</li>
                            <li>Дитячі</li>
                        </ul>
                        <router-link to="/">
                            <div class="block__btn">Переглянути</div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <h2 id="about-us" class="section__title">Про нас</h2>
            <div class="section__description">
                <p>{{ this.main.aboutUs }}</p></div>
        </section>
    </div>


    <section class="location">
        <div class="location-container">
            <p class="location__title">Ми знаходимося за адресою:</p>
            <p class="location__address"><span></span>{{ this.main.address }}</p>
            <iframe class="location__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10586.791877149975!2d22.717918986785893!3d48.44313627411239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4739ab3db87d5163%3A0x1e0f57167951aa3f!2z0KHRltC70YzQv9C-!5e0!3m2!1suk!2sua!4v1679685221105!5m2!1suk!2sua"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="location__info">
                <div class="info__contacts">
                    <p class="contacts__title"><span>Контакти:</span></p>
                    <p class="contacts__phone">{{ this.main.phone }}</p>
                </div>
                <div class="info__schedule">
                    <p class="schedule__title"><span>Графік роботи:</span></p>
                    <p class="schedule__time">{{ this.main.schedule.first }}</p>
                    <p class="schedule__time">{{ this.main.schedule.second }}</p>
                </div>
            </div>
        </div>
    </section>


</template>


<script>

import Header from "./Header.vue";
import ToTop from "./ToTop.vue";

export default {

    name: "Main",
    components: {
        navbar: Header,
        toTop: ToTop,
    },
    data() {
        return {
            main: {
                schedule: {
                    first: '',
                    second: ''
                },

                phone: '',
                aboutUs: '',
                address: '',
            }
        }
    },
    methods: {
        getMainInfo() {
            axios.get('/api/settings/get')
                .then(resp => {
                    const mainInfo = resp.data;
                    this.main.schedule.first = mainInfo.schedule.split(',')[0]
                    this.main.schedule.second = mainInfo.schedule.split(',')[1]
                    this.main.phone = mainInfo.phone_number
                    this.main.aboutUs = mainInfo.about_us
                    this.main.address = mainInfo.address
                })
        }
    },
    mounted() {
        this.getMainInfo()
    }

}
</script>

<style lang="scss" scoped>
@import "@/../scss/main-page/_slider.scss";
@import "@/../scss/main-page/_products.scss";
@import "@/../scss/main-page/_about.scss";

.links {
    &__btn {
        font-weight: 400;
        font-size: 18px;
        padding: 8px 10px;
        border: solid 2px #7a3333;

        &:hover {
            opacity: .8;
        }
    }
}

.container {
    max-width: 100%;
    padding: 0 15px;
    margin: 0 auto;
}

@media (max-width: 1000px) {
    .links__btn {
        font-size: 16px;
    }
}

///test

@media (max-width: 450px) {
    .slider__info {
        display: none;
    }
}
</style>
