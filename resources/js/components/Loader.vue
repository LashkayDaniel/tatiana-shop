<template>
    <div class="loader"></div>
</template>

<script>
export default {
    name: "Loader"
}
</script>

<style scoped>
.loader {
    border: 4px solid #f1e9e9;
    border-top: 4px solid #727d8d;
    border-bottom: 4px solid #727d8d;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    margin: 20px auto;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
