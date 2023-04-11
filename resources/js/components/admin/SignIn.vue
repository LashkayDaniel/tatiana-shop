<template>
    <div class="main">
        <form class="block">
            <h1>Вхід</h1>
            <p class="block__title">Логін</p>
            <input class="block__input" v-model="email" type="email" placeholder="Введіть email">
            <p class="block__title">Пароль</p>
            <input class="block__input" v-model="password" type="password" placeholder="Введіть пароль">
            <button class="block__btn" type="submit" @click.prevent="login">Login</button>

            <p v-if="loginError" class="block__label-warning">{{ this.loginError }}</p>

            <p v-if="loginSuccess" class="block__label-success">Успішно авторизовано!</p>

        </form>
    </div>
</template>

<script>
export default {
    name: "SignIn",
    data() {
        return {
            email: "angelina@gmail.com",
            password: "pass!A143",
            loginError: '',
            loginSuccess: false,
        }
    },
    methods: {
        login() {
            if (this.email === '' || this.password === '') {
                this.loginError = "Заповніть поля значеннями";
                setTimeout(() => {
                    this.loginError = ''
                }, 2000);
                return;
            }

            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password,
            })
                .then(response => {
                    console.log(response.data)
                    this.loginError = '';
                    this.loginSuccess = true;
                    // localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN']);
                    localStorage.setItem('x_xsrf_token', response.data.token);
                    setTimeout(() => {
                        this.$emit('loginSuccess')
                    }, 2000)
                })
                .catch(err => {

                    console.log(err.message);
                    this.loginSuccess = false;
                    this.loginError = err.message;
                    setTimeout(() => {
                        this.loginError = ''
                    }, 3000)
                })
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@/../scss/admin-page/_sign-in.scss";


</style>
