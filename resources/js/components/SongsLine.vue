<script setup>
import {ref, onMounted} from 'vue';
import SongCard from "@/components/SongCard.vue";

const songs = ref([]);
const playlists = ref([]);
const image = "../../../public/storage/";

const fetchSongs = async () => {
    try {
        const response = await axios.get('api/songs');
        songs.value = response.data;
        console.log(songs);
    } catch (error) {
        console.error('Error fetching songs:', error);
    }
};

const fetchPlaylists = async () => {
    try {
        const response = await axios.get('api/playlists');
        playlists.value = response.data;
        console.log(playlists);
    } catch(error) {
        console.error('Error fetching playlists: ', error);
    }
}

onMounted(() => {
    fetchSongs();
});
</script>

<template>
    <div class="">
        <div class="header">Songs</div>
        <div class="card-row">
            <song-card v-for="song in songs" :key="song.id" :track="song"></song-card>
        </div>

    </div>
</template>

<style scoped>
.card-row {
    width: 100%;
    margin-top: 5px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;

}

.header {
    font-size: 64px;
    color: #C5C6C7;

}
</style>
