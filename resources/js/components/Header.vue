<template>
    <header hide="">
        <nav class="header">
            <div class="container">
                <div class="schedule" @activeBurger="this.activeBurger=false"
                     :class="{'schedule__active':activeBurger}">
                    <h2 class="schedule__title">Графік роботи</h2>
                    <p class="schedule__subtitle">{{ this.schedule.first }}</p>
                    <p class="schedule__subtitle">{{ this.schedule.second }}</p>
                </div>

                <router-link to="/">
                    <img class="logo" src="@/../img/logo.svg" alt="logo">
                </router-link>

                <div class="links" @activeBurger="this.activeBurger=false" :class="{'links__active': activeBurger}">
                    <slot name="links"></slot>
                    <slot name="phone"></slot>
                </div>

                <div class="burger" @active-burger="alert('ok')" @click="showBurger"
                     :class="{'burger__active': activeBurger}">
                    <span></span>
                </div>
            </div>
        </nav>
    </header>
    <div class="menu" @click.prevent="hideBurger" :class="{'menu__active': activeBurger}"></div>

</template>

<script>

export default {
    name: "Header",
    data() {
        return {
            schedule: {
                first: '',
                second: ''
            },
            activeBurger: false,
        }
    },
    props: {
        hide: {
            required: true
        },
    },
    methods: {
        getSchedule() {
            axios.get('/api/settings/get')
                .then(resp => {
                    const schedule = resp.data.schedule.split(',');
                    this.schedule.first = schedule[0]
                    this.schedule.second = schedule[1]
                })
        },
        showBurger() {
            this.activeBurger = !this.activeBurger;
            console.log(this.activeBurger);
        },

        hideBurger() {
            console.log(this.hide);
            this.activeBurger = !this.hide;
        }

    },
    mounted() {
        this.getSchedule()
    }
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

.burger {
    display: none;
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
        position: relative;
        top: -100px;

        &__active {
            top: 90px;
            z-index: 1;
            transition: all .6s ease 0s;

        }
    }
    .schedule {
        &__active {
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translate(-50%, 0);
            z-index: 10;
            width: 100%;
            text-align: center;

        }
    }
    .links {
        &__active {
            position: absolute;
            top: 150px;
            left: 50%;
            width: 100%;
            display: flex;
            justify-content: center;
            transform: translate(-50%, 0);
            z-index: 10;

        }
    }

    .logo {
        left: 0;
        transform: translate(0%, -50%) scale(0.9);
    }

    .burger {
        position: absolute;
        right: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        width: 30px;
        height: 20px;

        span {
            transition: all .3s ease 0s;
            display: block;
            width: 70%;
            height: 3px;
            background-color: #bd8a8a;
        }

        &::before, &::after {
            content: '';
            position: absolute;
            height: 3px;
            width: 100%;
            background-color: #cc7676;
            transition: all .3s ease 0s;
        }

        &::before {
            top: 0;
        }

        &::after {
            bottom: 0;

        }

        &__active {
            span {
                transform: scale(0);
            }

            &::before {
                top: 50%;
                transform: rotate(45deg);
            }

            &::after {
                top: 50%;
                transform: rotate(-45deg);
            }
        }
    }

    .menu {
        left: 100%;

        &__active {
            position: fixed;

            top: 0;
            left: 0;
            right: 0;
            bottom: 100px;
            z-index: 5;
            background-color: #dec7c7;
            overflow: hidden;
            transition: all .6s ease 0s;

        }
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


@media (max-width: 400px) {


    .logo {
        max-width: 180px;
    }
}


</style>
