<template>

    <div class="wrapper">

        <div class="popup">
            <div class="popup__header">
                <h1 class="header__title">Редагування товару</h1>
                <!--                <p style="max-width: 500px">{{ props.productData }}</p>-->
                <button @click="closePopup" class="header__btn">&#x2715</button>
            </div>
            <form @submit.prevent="editProduct" class="product">

                <div class="product__images">
                    <p class="product__title">Фото товара:
                        <img :src="image" height="100" width="100" alt="image">
                    </p>

                    <div class="image-new">
                        <p class="product__title" style="color: #7c2929">Обрати нове фото:</p>
                        <input class="product__image" @change="onFileChange" ref="chooseImage" type="file"
                               accept="image/*"
                               required
                               placeholder="Виберіть картинку">
                        <p class="product__error">{{ errors.image }}</p>
                    </div>
                </div>

                <p class="product__title">Назва:</p>
                <input type="text"
                       required
                       class="product__input"
                       v-model="title"
                       placeholder="Введіть назву товара">
                <p class="product__error">{{ errors.title }}</p>

                <p class="product__title">Опис:</p>
                <textarea class="product__description"
                          required
                          v-model="description"
                          placeholder="Напишіть параметри товара"></textarea>
                <p class="product__error">{{ errors.description }}</p>

                <p class="product__title">Ціна:</p>
                <input type="number" class="product__input"
                       required
                       v-model="price"
                       placeholder="Введіть ціну">
                <p class="product__error">{{ errors.price }}</p>


                <p v-if="addSuccess.length!==0" class="product__success">{{ this.addSuccess }}</p>
                <button class="product__btn" type="submit">Додати</button>
            </form>
        </div>
    </div>

</template>

<script setup>
//composition api style
import {defineEmits, reactive, ref} from 'vue'

const props = defineProps({
    productData: Object,
});
const emits = defineEmits(['closeEditPopup'])

const image = ref(props.productData.image);
const title = ref(props.productData.title);
const description = ref(props.productData.description);
const price = ref(props.productData.price);

const addSuccess = ref('');


const errors = reactive({
    image: '',
    title: '',
    description: '',
    price: '',
});


function closePopup() {
    emits('closeEditPopup')
}

function editProduct() {

}

function onFileChange() {

}


</script>

<style lang="scss" scoped>
.wrapper {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(64, 64, 64, 0.4);
    z-index: 10;

}

.popup {
    position: fixed;
    background-color: #b3b5b7;
    box-shadow: 0px 0px 42px -13px rgba(168, 59, 168, 1);
    padding: 20px;
    min-width: 500px;
    border-radius: 5px;

    &__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
}


.header {
    &__title {
        font-size: 20px;
        font-weight: 600;
        color: #7c2929;
        border-bottom: solid 2px #6e1515;
    }

    &__btn {
        border-radius: 50%;
        width: 35px;
        height: 35px;
        text-align: center;
        background-color: #bb7f7f;


        &:hover {
            opacity: .9;
            background-color: #be3b3b;
            transition: .5s;
        }
    }
}

.product {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 30px;

    &__images {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;

        .image-new {
            margin-left: 10px;
            padding: 10px;
            border: dashed 2px #7c2929;
            border-radius: 10px;
        }

    }

    &__input, &__description, &__tags {
        padding: 5px 15px;
        border-radius: 5px;
    }

    &__description {
        min-height: 100px;
    }

    &__tags {
    }

    &__btn {
        background-color: #8d5858;
        color: #e7c1c1;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        padding: 10px;
        border-radius: 20px;
        margin: 0 50px;
        border: solid 1px black;

        &:hover {
            transition: .5s;
            transform: scale(1.05);
        }

    }

    &__error {
        color: #fa0404;
        font-weight: 500;
        font-size: 14px;
    }

    &__success {
        text-align: center;
        font-weight: 600;
        font-size: 16px;
        color: #364f06;
        background-color: #4fe74f;
        padding: 5px 0;
    }

    &__title {
        font-weight: 600;
        color: #9b2323;
    }
}

</style>
