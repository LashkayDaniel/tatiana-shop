<template>
    <nav class="header">
        <div class="container">
            <div class="schedule">
                <h2 class="schedule__title">Графік роботи</h2>
                <p class="schedule__subtitle">Пн-Пт: 9:00-18:00</p>
                <p class="schedule__subtitle">Сб-Нд: вихідний</p>
            </div>

            <router-link to="/">
                <img class="logo" src="@/../img/logo.svg" alt="logo">
            </router-link>

            <div class="links">
                <slot name="links"></slot>
                <slot name="phone"></slot>
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
    padding: 10px 20px;
    color: #7D5151;
    background-color: $grey;
    align-items: center;
}

.container {
    max-width: 1300px;
    height: 70px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    position: relative;
}

.schedule {
    position: absolute;
    left: 0;
    font-size: 20px;

    &__title {
        text-align: center;
        font-weight: 500;
    }

    &__subtitle {
        font-size: 16px;
        color: #A38787;
    }
}

.logo {
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: pointer;

    &:hover {
        opacity: 0.85;
    }
}

.links {
    position: absolute;
    right: 0;
    display: flex;
    gap: 25px;
}


///////   media queries
@media (max-width: 1000px) {
    .schedule {
        font-size: 18px;

        &__subtitle {
            font-size: 14px;
        }
    }
    .links {
        gap: 15px;
    }
}

@media (max-width: 780px) {
    .links, .schedule {
        display: none;
    }

    .logo {
        left: 0;
        transform: translate(0%, -50%) scale(0.9);
    }
}

@media (max-width: 580px) {

    .container {
        height: 50px;
    }

    .logo {
        max-width: 200px;
    }
}
</style>
