<template>

    <main></main>

    <router-view></router-view>
</template>

<script>
import Main from "./Main.vue";

export default {

    name: "App",
    components: {
        main: Main
    }

}
</script>

<style scoped>

</style>
