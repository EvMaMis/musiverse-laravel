import { createMemoryHistory, createRouter } from 'vue-router'

import Song from './components/Song.vue';
import Playlist from './components/Playlist.vue';
import Home from "@/components/Home.vue";
import SingleSong from "@/components/SingleSong.vue";
import RecommendationBlock from "@/components/RecommendationBlock.vue";

const routes = [
    { path: '/', component: Home},
    { path: '/songs', component: Song },
    { path: '/playlists', component: Playlist },
    { path: '/songs/:id', component: SingleSong, name: 'SingleSong'},
    { path: '/recommendations', component: RecommendationBlock, name: 'RecsBlock'}
]

export const router = createRouter({
    history: createMemoryHistory(),
    routes,
})
