<template>
    <div class="main-block">
        <div class="col-3 sidebar">
            <div class="sidebar-content col-3">
                <div class="navbar">
                    <navbar></navbar>
                </div>
                <div class="row songs">
                    <songs-queue></songs-queue>
                </div>
                <div class="row">
                    <music-player></music-player>
                </div>
            </div>

        </div>
        <div class="col-9 main-view">
            <router-view :key="$route.params.id"></router-view>
        </div>
    </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import MusicPlayer from "@/components/MusicPlayer.vue";
import SongsQueue from "@/components/SongsQueue.vue";
import {provide} from 'vue';
import {musicPlayerState} from '../musicPlayerState';

provide('musicPlayerState', musicPlayerState);

</script>

<style scoped>
body {
    margin: 0;
    padding: 0;
}

:root {
    --main-gray-color: #C5C6C7;
    --main-aqua-color: #66FCF1;
    --main-cyan-color: #45A29E;
    --main-dark-color: #1F2833;
    --main-black-color: #0B0C10;
}

.sidebar {
    background-color: #1F2833;
    padding: 0;
    margin: 0;
    display: flex;
    min-height: 94vh;
}

.sidebar-content {
    position: fixed;
    left:0;
    z-index: 2;
}

.songs {
    text-align: center;
    display: flex;
    justify-content: center;
    width: 100%;
    border-radius: 30px;
    color: #C5C6C7;
    margin: 0;
    padding: 0;
    overflow: hidden;
    height: 300px;
}

.navbar {
    width: 100%;
}

.main-view {
    background: linear-gradient(10deg, #1F2833, #0B0C10 70%) no-repeat center top / cover;
    margin: 0;
    padding: 0 30px;
}

.main-block {
    display: flex;
}

.row {
    margin: 0 !important;
    padding: 0 !important;
}
</style>
