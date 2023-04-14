<template>
    <header>
        <nav class="header">
            <div class="container">
                <div class="schedule">
                    <h2 class="schedule__title">Графік роботи</h2>
                    <p class="schedule__subtitle">{{ this.schedule.first }}</p>
                    <p class="schedule__subtitle">{{ this.schedule.second }}</p>
                </div>

                <router-link to="/">
                    <img class="logo" src="@/../img/logo.svg" alt="logo">
                </router-link>

                <div class="links">
                    <slot name="links"></slot>
                    <slot name="phone"></slot>
                </div>

                <div class="burger" @click="showBurger" :class="{'active': activeBurger}">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>
    <div class="menu" :class="{'menu':activeBurger}"></div>

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

.menu {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    background-color: #7c2929;
    height: 100vh;
    width: 100vw;
    display: none;
}

.active {
    &::before {
        top: 8px;
        transform: rotate(45deg);
    }

    &::after {
        bottom: 8px;
        transform: rotate(-45deg);
    }

    span {
        transform: scale(0);
    }
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
        position: absolute;
        top: -100px;
    }

    .logo {
        left: 0;
        transform: translate(0%, -50%) scale(0.9);
    }

    .burger {
        position: absolute;
        right: 0;
        display: block;
        width: 25px;
        height: 20px;

        span {
            //position: absolute;
            //top: 8px;
            //left: 0;
            //width: 100%;
            //height: 3px;
            //background-color: #000000;
            //transition: all .3s ease 0s;
            display: block;
            width: 100%;
            height: 3px;
            margin: 5px;
            background-color: #854040;

        }

        .active {
            span {
            }

        }

        .menu {
            display: block;
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

}
</style>
