<template>
<button @click="test" >
    <slot></slot>
</button>
</template>

<script>
export default {
name: "Button",
    methods: {
        test: function () {
            console.log("test")
        }
    }
}
</script>

<style scoped>

</style>
