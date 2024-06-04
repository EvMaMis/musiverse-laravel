<script setup>
import { ref, onMounted } from 'vue';

const songs = ref([]);

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
    <div>
        <h1>Songs in playlist</h1>
        <ul>
            <li v-for="song in songs" :key="song.id">{{song.title}}</li>
        </ul>
    </div>
</template>

<style scoped>

</style>
