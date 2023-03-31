<template>


    <div class="main">
        <section class="block">
            <h1 class="block__main-title">404</h1>
            <h2 class="block__title">Сторінку не знайдено :(</h2>
            <p class="block__subtitle"></p>
            <router-link to="/">
                <div class="block__btn">
                    На головну
                </div>
            </router-link>
        </section>
    </div>
</template>

<script>


export default {
    name: "NotFound",
}
</script>

<style lang="scss" scoped>
//@import "@/../scss/main.scss";

.main {
    background-color: $grey;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.block {
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    font-size: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #8d1e1e;

    &__main-title {
        font-size: 50px;
        font-weight: 600;
    }

    &__title {
        font-size: 35px;
        font-weight: 500;
    }

    &__subtitle {

    }

    &__btn {
        margin-top: 20px;
        font-weight: 600;
        letter-spacing: 1px;
        font-size: 18px;
        border: solid 2px #dea322;
        padding: 3px 15px;
        color: #d08016;

        &:hover {
            opacity: .9;
            transition: opacity .5s;
            transform: scale(1.1);
        }
    }
}
</style>
