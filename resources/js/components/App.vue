<template>
    <div class="row main-block">
        <div class="col-3 sidebar">
            <div class="row navbar">
                <navbar></navbar>
            </div>
            <div class="row songs">
                <songs-queue></songs-queue>
            </div>
            <div class="row">
            <music-player></music-player>
            </div>
        </div>
        <div class="col-9 main-view">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import MusicPlayer from "@/components/MusicPlayer.vue";
import SongsQueue from "@/components/SongsQueue.vue";
import { provide } from 'vue';
import { musicPlayerState } from '../musicPlayerState';

provide('musicPlayerState', musicPlayerState);

</script>

<style scoped>
:root {
    --main-gray-color: #C5C6C7;
    --main-aqua-color: #66FCF1;
    --main-cyan-color: #45A29E;
    --main-dark-color: #1F2833;
    --main-black-color: #0B0C10;
}
    .sidebar {
        background-color: #1F2833;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 0;
    }
    .songs {
        text-align: center;
        display: flex;
        justify-content: center;
        width: 100%;
        height: 300px;
        border-radius: 30px;
        color: #C5C6C7;
    }
    .navbar {
        width: 100%;
    }
    .main-view {
        background: linear-gradient(10deg, #1F2833, #0B0C10 70%) no-repeat center top / cover;

    }
    .main-block {
        height: 100vh;
        overflow: hidden;
    }
</style>
