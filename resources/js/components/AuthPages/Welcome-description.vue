<template>
    <div>
        <h4>Welcome to <strong>Chat App</strong></h4>
        <hr>
        <p>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem beatae consequatur corporis delectus deleniti doloribus dolorum est fuga iure minima obcaecati perspiciatis porro provident, quas, vel voluptas voluptate, voluptatem!</span>
            <span>Delectus deleniti dicta eius eligendi, enim impedit incidunt iusto maiores nobis perspiciatis quae quam quasi quos recusandae repellat tempora totam! Amet dolore, ea facilis illo natus necessitatibus odio quam quisquam!</span>
        </p>
        <button class="read_more">Read More</button>
    </div>
</template>

<script>
export default {
name: "Welcome-description"
}
</script>

<style lang="scss" scoped>
hr{
    border: 1px solid  white ;
}
.read_more{
    border: 1px solid white;
    background: none;
    color: white;
    outline: none;
    border-radius: 5px;
    padding: 5px 10px;
    transition: all .3s;
    &:hover{
        background: white;
        color: black;
        transition: all .3s;
    }
}
</style>
