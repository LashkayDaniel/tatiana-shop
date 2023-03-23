<template>
    <!--    <navbar v-if="!this.isAdmin" @showHeader="show"/>-->
    <main/>
    <router-view></router-view>
</template>

<script>
import Main from "./Main.vue";
import Header from "./Header.vue";

export default {

    name: "App",
    components: {
        main: Main,
        navbar: Header,
    },
    data() {
        return {
            isAdmin: false,
        }
    },
    methods: {
        show() {
            this.isAdmin = true
        }
    }

}
</script>

<style scoped>

</style>
