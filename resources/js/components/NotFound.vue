<template>
    <div class="main">
        <section class="block">
            <h1 class="block__title">404 Page not found</h1>
            <p class="block__subtitle">csdfsfs</p>
            <router-link to="/">
                <div class="block__btn">
                    main
                </div>
            </router-link>
        </section>
    </div>
</template>

<script>
export default {
    name: "NotFound"
}
</script>

<style lang="scss">
//@import "@/../scss/main.scss";

.main {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    overflow: auto;
    background: $grey;
    align-items: start;
    display: flex;
    justify-content: center;
}

.block {
    padding: 20px;
    border: solid 1px;
    border-radius: 5px;

    &__title {

    }

    &__subtitle {

    }

    &__btn {

    }
}
</style>
