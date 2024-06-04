import { createMemoryHistory, createRouter } from 'vue-router'

import Song from './components/Song.vue'
import Playlist from './components/Playlist.vue'
import Home from "@/components/Home.vue";

const routes = [
    { path: '/', component: Home},
    { path: '/songs', component: Song },
    { path: '/playlists', component: Playlist },
]

export const router = createRouter({
    history: createMemoryHistory(),
    routes,
})
