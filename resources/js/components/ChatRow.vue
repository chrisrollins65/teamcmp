<style scoped>
    .chat-row {
        display: flex;
        margin-bottom: 15px;
    }
    .chat-column {
        width: 100%;
    }
    .chat-column span {
        background-color: white;
        padding: 15px;
        margin: 0 10px;
        display: block;
        position: relative;
        border-radius: 5px;
    }
    .chat-right .chat-column span {
        background-color: skyblue;
    }
    .avatar-column {
        width: 30px;
    }
    .avatar-column img {
        width: 30px;
        border-radius: 50%;
        height: 30px;
    }
    .chat-column span:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        top: 0;
        border: 32px solid;
        border-color: #fff transparent transparent transparent;
        z-index: -1;
    }
    .chat-right .chat-column span:before {
        right: -15px;
        border-color: skyblue transparent transparent transparent;
    }
    .chat-left .chat-column span:before {
        left: -15px;
    }

    @media only screen and (min-width: 700px) {
        .avatar-column {
            width: 50px;
        }
        .avatar-column img {
            width: 50px;
            height: 50px;
        }
    }
</style>

<template>
    <div v-bind:class="'chat-row chat-' + (left ? 'left' : 'right')">
        <div class="column avatar-column">
            <img v-if="left" :src="'img/avatars/' + avatar" />
        </div>
        <div class="column chat-column">
            <span>{{ message }}</span>
        </div>
        <div class="column avatar-column">
            <router-link to="/"><img v-if="!left" :src="'img/avatars/' + avatar" /></router-link>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['avatar', 'message', 'left']
    }
</script>
