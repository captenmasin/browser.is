<template>
    <div class="w-64">
        <span class="loader"></span>
    </div>
</template>
<style scoped>
.loader {
    width: 100%;
    height: 5px;
    border-radius: 50px;
    background: rgba(var(--colors-secondary-rgb), 0.1);
    display: inline-block;
    position: relative;
    overflow: hidden;
}

.loader::after {
    content: '';
    height: 5px;
    width: 64px;
    border-radius: 50px;
    background: var(--colors-secondary);
    position: absolute;
    top: 0;
    left: 0;
    box-sizing: border-box;
    animation: hitZak 0.6s ease-in-out infinite alternate;
}

@keyframes hitZak {
    0% {
        left: 0;
        /*width:52px;*/
        transform: translateX(-1%);
    }
    100% {
        left: 100%;
        /*width: 96px;*/
        transform: translateX(-99%);
    }
}

</style>
