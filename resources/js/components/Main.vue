<template>
    <navbar>
        <template v-slot:links>
            <a href="#products" class="links__btn">Товари</a>
            <a href="#" class="links__btn">Про нас</a>
        </template>
    </navbar>

    <div class="">main123</div>


</template>

<script>

import Header from "./Header.vue";

export default {

    name: "Main",
    components: {
        navbar: Header,
    }
}
</script>

<style lang="scss" scoped>

.links {
    &__btn {
        font-weight: 400;
        font-size: 18px;
        padding: 8px 10px;
        border: solid 2px #381414;

        &:hover {
            opacity: .8;
        }
    }
}
</style>
