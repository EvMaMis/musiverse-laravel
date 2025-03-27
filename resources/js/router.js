import {createRouter, createWebHistory} from 'vue-router'

import Song from './components/Song.vue';
import Playlist from './components/Playlist.vue';
import Home from "@/components/Home.vue";
import SingleSong from "@/components/SingleSong.vue";
import SingleArtist from "@/components/SingleArtist.vue";
import RecommendationBlock from "@/components/RecommendationBlock.vue";
import Profile from "@/components/Profile.vue";

const routes = [
    { path: '/', component: Home},
    { path: '/songs', component: Song },
    { path: '/playlists', component: Playlist },
    { path: '/songs/:id', component: SingleSong, name: 'SingleSong'},
    { path: '/artists/:id', component: SingleArtist, name: 'SingleArtist'},
    { path: '/recommendations', component: RecommendationBlock, name: 'RecsBlock'},
    { path: '/profile', component: Profile, name: 'Profile'}
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})
