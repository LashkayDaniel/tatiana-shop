<template>
    <nav class="header">
        <div class="container">
            <div class="schedule">
                <h2 class="schedule__title">Графік роботи</h2>
                <p class="schedule__subtitle">Пн-Пт: 9:00-18:00</p>
                <p class="schedule__subtitle">Сб-Нд: вихідний</p>
            </div>

            <img class="logo" src="@/../img/logo.svg" alt="logo">


            <div class="links">
                <slot name="links"></slot>
                <!--                <a href="#" class="links__btn">Товари</a>-->
                <!--                <a href="#" class="links__btn">Про нас</a>-->
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style lang="scss" scoped>

.header {
    box-shadow: 0 4px 4px rgba(184, 164, 164, 0.25);
    width: 100%;
    margin: 0;
    padding: 10px 0;
    color: #7D5151;
    background-color: $grey;
}

.container {
    max-width: 1400px;
    padding: 0 15px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.schedule {
    font-size: 20px;

    &__title {
        text-align: center;

        font-weight: 500;
    }

    &__subtitle {
        font-size: 18px;
        color: #A38787;
    }
}

.logo {
    &:hover {
        opacity: 0.85;
    }
}

.links {
    display: flex;
    gap: 25px;
}
</style>
