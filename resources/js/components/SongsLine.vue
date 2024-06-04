<script setup>
import {ref, onMounted} from 'vue';

const songs = ref([]);
const image = "../../../public/storage/";

const fetchSongs = async () => {
    try {
        const response = await axios.get('api/songs');
        songs.value = response.data;
    } catch (error) {
        console.error('Error fetching genres:', error);
    }
};

onMounted(() => {
    fetchSongs();
});
</script>

<template>
    <div class="card-row">
        <div class="card-row-text"></div>
        <div v-for="song in songs" :key="song.id" class="song-card">
            <img :src="'storage/' + song.image" alt="{{__('Cover')}}" class="song-card-img">
            <div class="song-card-body">
                <div class="song-card-title">
                {{ song.title }}
                </div>
                <div class="song-card-manage">

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card-row {
    width: 100%;
    margin-top: 30px;
}
.song-card {
    height: 220px;
    width: 180px;
    background-color: rgba(33, 37, 46);
}
.song-card-img {
    height: 180px;
    width: 180px;
}
.song-card-body {
    color: #C5C6C7;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
