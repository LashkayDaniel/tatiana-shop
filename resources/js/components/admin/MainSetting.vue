<template>
    <article class="block">
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
            <div v-if="this.show_btns.edit" @click.prevent="canEdit" class="buttons__btn buttons__btn--red">Редагувати
            </div>
            <div v-if="this.show_btns.save" @click.prevent="save" class="buttons__btn buttons__btn--green">Зберегти
            </div>
        </section>
    </article>
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
            },
            success: '',
            show_btns: {
                edit: true,
                save: false,
            }
        }
    },
    methods: {
        canEdit() {
            const textInputItems = document.querySelectorAll('input[type="text"],input[type="tel"], textarea');

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
                    Object.keys(this.errors).forEach(key => {
                        this.errors[key] = '';
                    });
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
        }
    },
    mounted() {
        this.canEdit();
        this.getSettings();
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_main-setting.scss";


</style>
