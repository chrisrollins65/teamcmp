<style scoped>
    .chat-row {
        display: flex;
    }
    .chat-column {
        width: 100%;
    }
    .chat-column span {
        background-color: skyblue;
        padding: 15px;
        margin: 0 10px;
        display: block;
        position: relative;
        border-radius: 5px;
    }
    .avatar-column {
        width: 30px;
    }
    .avatar-column img {
        width: 30px;
        border-radius: 50%;
        height: 30px;
    }
    .chat-right .chat-column span:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        right: -15px;
        top: 0;
        border: 32px solid;
        border-color: skyblue transparent transparent transparent;
        z-index: -1;
    }
    #message-box {
        margin: 15px;
    }
    #message-input {
        padding: 15px;
        border: 0;
        width: 100%;
        box-sizing: border-box;
    }
    #message-box span {
        position: relative;
    }
    #message-box span:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -15px;
        border: 32px solid;
        border-color: #fff transparent transparent transparent;
        z-index: -1;
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
    <div>
        <nav>Sophie</nav>
        <div class="container">
            <chat-row
                v-if="Object.keys(avatars).length !== 0"
                v-for="(message, index) in chat"
                :key="index"
                :avatar="avatars[message.sentBy]"
                :message="message.message"
                :left="message.sentBy == userId"
            ></chat-row>
            <div id="message-box" @keydown.enter="handleSubmit">
                <span><input id="message-input" v-model="message" placeholder="Write a message..." /></span>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Vue from 'vue';
    import ChatRow from '../components/ChatRow';

    export default {
        data() {
            return {
                'avatars': {},
                'chat': [],
                'userId': 2,
                'message': '',
            }
        },
        created() {
            axios.get('/api/avatars').then(response => {
                let avatars = {};
                response.data.forEach(avatarInfo => (avatars[avatarInfo.id] = avatarInfo.avatar));
                Vue.set(this, 'avatars', avatars);
            });
            axios.get('/api/chat').then(response => (this.chat = response.data));
        },
        components: {
            'chat-row': ChatRow
        },
        methods: {
            handleSubmit() {
                if (this.message !== '') {
                    let data = new FormData();
                    data.append('message', this.message);
                    data.append('sentBy', this.userId);
                    axios.post('/api/chat/message', data).then(response => {
                        this.chat.push({'message': this.message, 'sentBy': this.userId});
                        Vue.set(this, 'message', '');
                    });
                }
            }
        }
    }
</script>
