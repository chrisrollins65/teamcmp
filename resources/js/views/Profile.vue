<style scoped>
    #profile-pic {
        position: relative;
    }
    #profile-pic img{
        margin: auto;
        display: block;
        border-radius: 50%;
        width: 300px;
        max-width: 90%;
    }
    #status-bubble {
        background-color: #5aec90;
        border-radius: 50%;
        width: 65px;
        height: 65px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        left: 65%;
        position: absolute;
    }
    #profile-description h2{
        margin: 0;
    }
    #profile-description h3 {
        color: deeppink;
        font-size: 16px;
        margin: 0;
    }
    .friend-btn {
        width: 100%;
        padding: 20px;
        background-color: #333;
        color: #fff;
        text-transform: uppercase;
        font-size: 18px;
        border: 0;
        cursor: pointer;
    }
    #remove-btn {
        background-color: darkred;
    }
    #profile-section {
        height: 100%;
    }
    #profile-section.isFriend {
        background-color: honeydew;
    }
</style>

<template>
    <div v-if="profile.name" id="profile-section" v-bind:class="{isFriend: isFriend}">
        <nav>{{ profile.name }}</nav>
        <div class="container">
            <router-link to="chat">
            <div id="profile-pic">
                <span id="status-bubble">Online</span>
                <img :src="'img/avatars/' + profile.avatar" />
            </div>
            </router-link>

            <div id="profile-description">
                <h2>{{ profile.name }}, {{ profile.age }}</h2>
                <h3>{{ profile.location }}</h3>
                <p>{{ profile.description }}</p>
            </div>

            <button v-if="!isFriend" class="friend-btn" id="add-btn" v-on:click="addFriend">Add as friend</button>
            <button v-if="isFriend" class="friend-btn" id="remove-btn" v-on:click="removeFriend">Unfriend</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                profile: {
                    'name': '',
                    'age': '',
                    'location': '',
                    'description': '',
                    'avatar': '',
                },
                isFriend: false,
            }
        },
        created() {
            axios.get('/api/friend').then(response => (this.isFriend = response.data));
            axios.get('/api/profile').then(response => (this.profile = response.data));
        },
        methods: {
            addFriend: function() {
                axios.post('/api/friend');
                this.isFriend = true;
            },
            removeFriend: function() {
                axios.delete('/api/friend');
                this.isFriend = false;
            }
        }
    }
</script>
