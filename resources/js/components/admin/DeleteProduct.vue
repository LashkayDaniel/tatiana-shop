<template>

    <div class="wrapper">
        <div class="popup">
            <div class="popup__title">
                Впевнені, що бажаєте видалити: <span>{{ props.productData.title }}</span>
                <span>{{ props.productData.id }}</span>
            </div>
            <div class="popup__button">
                <button class="button__permission" @click="deleteProduct(props.productData.id)">Так</button>
                <button class="button__deny" @click="this.closePopup">Ні</button>
            </div>

            <p class="deleteSuccess">{{ deleteSuccess }}</p>
        </div>
    </div>

</template>

<script setup>

import {defineEmits, ref} from "vue";

const deleteSuccess = ref('')

const props = defineProps({
    productsTitle: String,
    productData: Object,
});
const emits = defineEmits(['closeDeletePopup'])

function closePopup() {
    emits('closeDeletePopup')
}

function deleteProduct(id) {
    axios.delete(`/api/${props.productsTitle}/delete/${id}`)
        .then(resp => {
            deleteSuccess.value = 'Товар успішно видалено!'
            setTimeout(() => {
                this.closePopup()
            }, 2000);
        })
        .catch(err => {
            console.log(err);
        })
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

    &__title {
        font-weight: 600;
        color: #7c2929;
        font-size: 18px;

        span {
            color: #205caf;
        }
    }

    &__button {
        display: flex;
        justify-content: end;
        column-gap: 10px;
        padding-top: 10px;
    }
}

.button {
    &__permission, &__deny {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: 600;

        &:hover {
            opacity: .8;
            transition: .3s;
        }
    }

    &__permission {
        background-color: #3cb73c;
    }

    &__deny {
        background-color: #c51a1a;
        color: #521313;
    }
}
</style>
