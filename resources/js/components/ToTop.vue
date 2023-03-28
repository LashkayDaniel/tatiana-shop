<template>
    <transition name="fade">
        <button v-show="this.showBtn" class="btn-to-top" @click="scrollTop"></button>
    </transition>
</template>

<script>
export default {
    name: "ToTop",
    data() {
        return {
            showBtn: false,
        }
    },
    methods: {
        scrollTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth',
            });
        }
    },
    mounted() {
        let that = this;
        window.addEventListener("scroll", function () {
            let scroll = window.scrollY
            scroll > 350 ? that.showBtn = true : that.showBtn = false
        })
    }
}
</script>

<style lang="scss" scoped>
.btn-to-top {
    position: fixed;
    right: 50px;
    bottom: 30px;
    background-color: rgba(178, 157, 157, 0.53);
    width: 50px;
    height: 50px;
    border-radius: 50%;

    &:before {
        content: '';
        display: block;
        width: 25px;
        height: 25px;
        border-bottom: solid 2px #A38787;
        border-left: solid 2px #A38787;
        transform: rotate(135deg) translate(-10%, -60%);
    }

    &:hover {
        transition: 1s ease;
        transform: scale(1.2);
    }
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
