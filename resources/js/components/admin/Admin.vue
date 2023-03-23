<template>
    adminn

    <button @click="ok">click</button>
</template>

<script>
export default {
    name: "Admin",
    methods: {
        ok() {
            this.$emit("showHeader");

        }
    },
}
</script>

<style scoped>

</style>
