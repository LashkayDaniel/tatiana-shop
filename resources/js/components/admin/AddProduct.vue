<template>
    <div class="wrapper">
        <div class="popup">

            <div class="popup__header">
                <p class="header__title">Додати новий товар</p>
                <button @click="this.closePopup" class="header__btn">&#x2715</button>
            </div>

            <form @submit.prevent="this.addNewProduct" class="product">
                <input class="product__image" @change="this.onFileChange" ref="chooseImage" type="file" accept="image/*"
                       required
                       placeholder="Виберіть картинку">
                <p class="product__error">{{ errors.image }}</p>

                <input type="text"
                       required
                       class="product__input"
                       v-model="title"
                       placeholder="Введіть назву товара">
                <p class="product__error">{{ errors.title }}</p>

                <textarea class="product__description"
                          required
                          v-model="description"
                          placeholder="Напишіть параметри товара"></textarea>
                <p class="product__error">{{ errors.description }}</p>

                <input type="number" class="product__input"
                       required
                       v-model="price"
                       placeholder="Введіть ціну">
                <p class="product__error">{{ errors.price }}</p>

                <select class="product__tags"
                        required
                        v-model="tag">
                    <option value="" disabled selected>Виберіть тег</option>
                    <option v-for="tag in tags"
                            :value="tag">{{ tag }}
                    </option>
                </select>
                <p class="product__error">{{ errors.tag }}</p>


                <p v-if="this.addSuccess.length!==0" class="product__success">{{ this.addSuccess }}</p>
                <button class="product__btn" type="submit">Додати</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddProduct",

    props: {
        productName: String
    },

    data() {
        return {
            image: '',
            title: '',
            description: '',
            price: '',
            tag: '',

            tags: [],

            errors: {
                image: '',
                title: '',
                description: '',
                price: '',
                tag: '',
            },


            addSuccess: ''
        };
    },

    methods: {
        closePopup() {
            this.$emit('closePopup');
        },


        ///

        getAllTags() {
            axios.get(`/api/${this.productName}/get-tags`)
                .then(resp => {
                    resp.data.forEach((e) => {
                        this.tags.push(e.name);
                    });
                })
        },

        addNewProduct() {
            const formData = new FormData();
            formData.append('image', this.image);
            formData.append('title', this.title);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('tag_name', this.tag);

            axios.post(`/api/${this.productName}/create`, formData)
                .then(resp => {
                    this.addSuccess = resp.data.message;

                    this.$refs.chooseImage.value = null;

                    setTimeout(() => {
                        this.addSuccess = ''
                        this.closePopup()
                    }, 2000);
                })
                .catch(err => {
                    console.log(err);
                    const errors = err.response.data.errors;
                    errors.hasOwnProperty('image') ? this.errors.image = errors.image[0] : ''
                    errors.hasOwnProperty('title') ? this.errors.title = errors.title[0] : ''
                    errors.hasOwnProperty('description') ? this.errors.description = errors.description[0] : ''
                    errors.hasOwnProperty('price') ? this.errors.price = errors.price[0] : ''
                    errors.hasOwnProperty('tag_name') ? this.errors.tag = errors.tag_name[0] : ''
                })
        },

        onFileChange(event) {
            this.image = event.target.files[0];
        },
    },
    mounted() {
        this.getAllTags();
    }
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

    &__image {

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
}


</style>
