<template>
    <article class="block">
        <section class="schedule">
            <p class="block-title">Графік роботи: </p>
            <input type="text" class="schedule__time" value="ok" disabled placeholder="Будні">
            <input type="text" class="schedule__time" placeholder="Вихідні">
        </section>
        <section class="phone">
            <p class="block-title">Номер телефону:</p>
            <input class="phone__number" type="tel" name="" placeholder="Номер телефону">
        </section>
        <section class="about-us">
            <p class="block-title">Про нас</p>
            <textarea class="about-us__info" placeholder="Напишіть опис про ваш магазин"/>
        </section>
        <section class="location">
            <p class="block-title">Адреса</p>
            <input type="text" class="location__address" placeholder="Напишіть місцезнаходження">
        </section>
        <section class="buttons">
            <div class="buttons__btn buttons__btn--red">Редагувати</div>
            <div class="buttons__btn buttons__btn--green">Зберегти</div>
        </section>
    </article>
</template>

<script>
export default {
    name: "MainSetting"
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_main-setting.scss";


</style>
