<template>
    <div class="wrapper">
        <div class="block">
            <section class="schedule">
                <p class="block-title">Графік роботи: </p>
                <input v-model="scheduleFirst" @input="changeValueEvent" type="text" class="schedule__time"
                       placeholder="Будні">
                <input v-model="scheduleSecond" @input="changeValueEvent" type="text" class="schedule__time"
                       placeholder="Вихідні">
                <p class="block__error">{{ this.errors.scheduleError }}</p>
            </section>
            <section class="phone">
                <p class="block-title">Номер телефону:</p>
                <input v-model="phone" @input="changeValueEvent" class="phone__number" type="tel" name=""
                       placeholder="Номер телефону">
                <p class="block__error">{{ this.errors.phoneError }}</p>
            </section>
            <section class="about-us">
                <p class="block-title">Про нас</p>
                <textarea v-model="aboutUs" @input="changeValueEvent" class="about-us__info"
                          placeholder="Напишіть опис про ваш магазин"/>
                <p class="block__error">{{ this.errors.aboutUsError }}</p>

            </section>
            <section class="location">
                <p class="block-title">Адреса</p>
                <input v-model="location" @input="changeValueEvent" type="text" class="location__address"
                       placeholder="Напишіть місцезнаходження">
                <p class="block__error">{{ this.errors.locationError }}</p>
            </section>

            <p v-if="this.success.length!==0" class="block__success">{{ this.success }}</p>
            <section class="buttons">
                <div v-if="this.show_btns.edit" @click.prevent="canEdit" class="buttons__btn buttons__btn--red">
                    Редагувати

                </div>
                <div v-if="this.show_btns.save" @click.prevent="save" class="buttons__btn buttons__btn--green">Зберегти
                </div>
            </section>
        </div>


        <section class="slider">
            <div class="slider__lists">
                <p class="lists__title">Слайди</p>
                <div v-for="slider in sliders" class="lists__item">
                    <img class="item__img"
                         :src="`/storage/uploads/${slider.image_name}`"
                         alt="image"
                    >
                    <div class="item__description">{{ slider.description }}</div>
                </div>
            </div>


            <form @submit.prevent="this.addNewSlider" class="slider__add-new">
                <p class="add-new__title">Додати нові слайди</p>
                <input class="add-new__input" @change="this.onFileChange" ref="chooseImage" type="file" accept="image/*"
                       required
                       placeholder="Виберіть картинку">
                <p class="block__error">{{ this.errors.slider.image }}</p>
                <textarea class="add-new__description" v-model="slider.description"
                          placeholder="Напишіть тест слайду"></textarea>
                <p class="block__error">{{ this.errors.slider.description }}</p>
                <p v-if="this.sliderSuccess.length!==0" class="block__success">{{ this.sliderSuccess }}</p>
                <button class="add-new__btn" type="submit">Додати</button>

            </form>
        </section>
    </div>
</template>

<script>
export default {
    name: "MainSetting",
    data() {
        return {
            scheduleFirst: '',
            scheduleSecond: '',
            phone: '',
            aboutUs: '',
            location: '',
            errors: {
                scheduleError: '',
                phoneError: '',
                aboutUsError: '',
                locationError: '',
                slider: {
                    image: '',
                    description: ''
                }
            },
            success: '',
            sliderSuccess: '',
            show_btns: {
                edit: true,
                save: false,
            },
            slider: {
                image: '',
                description: ''
            },
            sliders: [],
        }
    },
    methods: {
        canEdit() {
            const textInputItems = document.querySelectorAll('div.block input[type="text"], div.block input[type="tel"],div.block textarea');

            textInputItems.forEach((item) => {
                item.disabled = !item.disabled;
            });
        },

        changeValueEvent() {
            this.show_btns.edit = false;
            this.show_btns.save = true;
        },

        save() {
            axios.put('/api/settings/update', {
                schedule: this.scheduleFirst + ',' + this.scheduleSecond,
                phone_number: this.phone,
                about_us: this.aboutUs,
                address: this.location
            })
                .then(response => {
                    this.success = response.data.message;
                    this.canEdit()
                    this.show_btns.edit = true;
                    this.show_btns.save = false;

                    this.clearErrorsMsg();

                    setTimeout(() => {
                        this.success = ''
                    }, 2000);
                })
                .catch(err => {
                    const errors = err.response.data.errors;
                    errors.hasOwnProperty('schedule') ? this.errors.scheduleError = errors.schedule[0] : ''
                    errors.hasOwnProperty('phone_number') ? this.errors.phoneError = errors.phone_number[0] : ''
                    errors.hasOwnProperty('about_us') ? this.errors.aboutUsError = errors.about_us[0] : ''
                    errors.hasOwnProperty('address') ? this.errors.locationError = errors.address[0] : ''
                })
        },

        clearErrorsMsg() {
            Object.keys(this.errors).forEach(key => {
                this.errors[key] = '';
            });
        },
        getSettings() {
            axios.get('/api/settings/get')
                .then(response => {
                    const schedule = response.data.schedule;
                    this.scheduleFirst = schedule.split(',')[0]
                    this.scheduleSecond = schedule.split(',')[1]
                    this.phone = response.data.phone_number;
                    this.aboutUs = response.data.about_us;
                    this.location = response.data.address;
                })
        },

        /// slider

        onFileChange(event) {
            this.slider.image = event.target.files[0];
        },

        addNewSlider() {
            const formData = new FormData();
            formData.append('image', this.slider.image);
            formData.append('description', this.slider.description);
            axios.post('/api/slider/create', formData)
                .then(resp => {
                    this.sliderSuccess = resp.data.message;
                    this.getAllSliders();
                    this.clearErrorsMsg();

                    this.$refs.chooseImage.value = null;
                    this.slider.description = '';
                    setTimeout(() => {
                        this.sliderSuccess = ''
                    }, 4000);
                })
                .catch(err => {
                    console.log(err)
                    const errors = err.response.data.errors;
                    errors.hasOwnProperty('image') ? this.errors.slider.image = errors.image[0] : ''
                    errors.hasOwnProperty('description') ? this.errors.slider.description = errors.description[0] : ''
                    setTimeout(() => {
                        this.errors.slider.image = ''
                        this.errors.slider.description = ''
                    }, 3000);
                })
        },

        getAllSliders() {
            axios.get('/api/slider/get')
                .then(resp => {
                    this.sliders = resp.data;
                })
        }

    },
    mounted() {
        this.canEdit();
        this.getSettings();
        this.getAllSliders();
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_main-setting.scss";


</style>
