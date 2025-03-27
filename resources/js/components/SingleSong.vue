<script setup>

import {useRoute} from "vue-router";
import {onMounted, ref, computed} from "vue";
import SongsLine from "@/components/SongsLine.vue";

const route = useRoute();
const songId = route.params.id;
const song = ref({});
const relatedSongs = ref({});
const relatedSongsFetched = computed(() => Object.keys(relatedSongs.value).length > 0);

onMounted(() => {
    fetchSong();
    fetchRelatedSongs();
})

const fetchSong = async () => {
    try {
        let response = await axios.get(`/api/songs/${songId}`);
        song.value = response.data;
    } catch (e) {
        console.error(e);
    }
}

const fetchRelatedSongs = async() => {
    try {
        let response = await axios.get(`/api/recommendations/songs/${songId}`);
        relatedSongs.value = response.data;
        console.log(relatedSongs);
    } catch(e) {
        console.error(e);
    }
}

const toggleLike = async () => {
    try {
        const response = await axios.post("/api/songs/toggle-like", {songId: songId});
        song.value.is_liked = response.data.liked;
        if (song.value.is_liked) {
            song.value.likes_count += 1;
        } else {
            song.value.likes_count -= 1;
        }
    } catch (error) {
        console.error("Error toggling like", error);
    }
}

</script>

<template>
    <div class="song-block" v-if="song.title">
        <div class="song-heading">
            <div class="image"><img :src="'/storage/' + song.image" alt="Cover"></div>
            <div class="heading-container">
                <h1>{{ song.title }}</h1>
                <h2>Written by <RouterLink :to="{name: 'SingleArtist', params: { id: song.artist.id }}" class="artist-block">{{ song.artist.name }}</RouterLink> </h2>
                <h4>Genre: {{ song.genre.title }}</h4>
                <div class="list tags">
                    <div class="tag-item" v-for="tag in song.tags">
                        <div class="name">{{tag.title}}</div>
                    </div>
                </div>
                <div class="info">
                    <div class="likes">
                        <button @click="toggleLike">
                            <i :class="song.is_liked ? 'fas fa-heart' : 'fa-regular fa-heart'"></i>
                        </button>
                        {{ song.likes_count }}
                    </div>
                    <div class="toggle-play">
                        <button @click="togglePlay">
                            <i :class="isPlaying ? 'fas fa-pause' : 'fas fa-play'"></i>
                        </button>
                    </div>
                    <div class="queue">
                        <button @click="addToQueue">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div class="songs-list" v-if="relatedSongsFetched">
            <songs-line :data="{header: 'Схожі за настроєм пісні:', songs: relatedSongs.tags}"></songs-line>
            <songs-line :data="{header: 'Новинки від автора:', songs: relatedSongs.artist}"></songs-line>
            <songs-line :data="{header: 'Схожі за жанром:', songs: relatedSongs.genre}"></songs-line>
        </div>
    </div>
</template>

<style scoped>

button {
    background-color: transparent;
    color: #C5C6C7;
    width: 30px;
    height: 30px;
    border: 1px solid white;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;

}

.artist-block {
    color: #C5C6C7;
    margin: 0;
}

.song-block {
    padding-top: 15px;
    color: #9ca3af;
}

.image {
    max-width: 200px;
}

.image img {
    width: 100%;
}

.song-heading {
    display: flex;
}

.heading-container {
    margin-left: 15px;
}

.likes {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.info {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
}

.toggle-play {
    margin-left: 20px;
}

.queue {
    margin-left: 20px;
}

.list.tags {
    display: flex;
    margin-bottom: 20px;
}

.tag-item {
    margin-right: 5px;
    border: 1px solid gray;
    border-radius: 5px;
    padding: 5px;
}

h2 {
    margin: 8px 0 10px;
}

h4 {
    margin-bottom: 20px;
}

.songs-list {
    margin-top: 130px;
}
</style>
