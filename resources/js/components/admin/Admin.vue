<template>
    <sign-in v-if="!loginSuccessfully  && !tokenExist" @loginSuccess="this.loginSuccessfully=true"/>
    <div v-else class="main">
        <aside class="navbar">
            <div class="navbar__logo">
                <router-link to="/">
                    <img class="logo__img" src="@/../img/logo.svg" alt="logo">
                </router-link>
            </div>
            <div class="navbar__items">
                <div class="items__item" :class="{'items__item--active' : showMainSetting}"
                     @click="this.showMainSetting=true; this.showProductSetting=false">
                    <img src="../../../img/admin/main-setting.png"
                         alt="link icon"/>
                    Головна
                </div>
                <div class="items__item" :class="{'items__item--active' : showProductSetting}"
                     @click="this.showProductSetting=true; this.showMainSetting=false">
                    <img src="../../../img/admin/product-setting.png"
                         alt="link icon"/>
                    Товари
                </div>
            </div>
            <div class="navbar__bottom">
                <button class="bottom__logout">Logout</button>
            </div>
        </aside>

        <div class="right-panel">
            <main-setting v-if="this.showMainSetting"></main-setting>
            <product-setting v-if="this.showProductSetting"></product-setting>
        </div>
    </div>
</template>

<script>
import MainSetting from "../admin/MainSetting.vue";
import ProductSetting from "../admin/ProductSetting.vue";
import SignIn from "../admin/SignIn.vue";

export default {
    name: "Admin",
    components: {
        signIn: SignIn,
        mainSetting: MainSetting,
        productSetting: ProductSetting
    },
    data() {
        return {
            tokenExist: false,
            loginSuccessfully: false,
            showMainSetting: true,
            showProductSetting: false,
        }
    },
    methods: {
        getToken() {
            const token = localStorage.getItem('x_xsrf_token');
            token ? this.tokenExist = true : this.tokenExist = false;
        }
    },
    mounted() {
        this.getToken()
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_navbar.scss";

</style>
