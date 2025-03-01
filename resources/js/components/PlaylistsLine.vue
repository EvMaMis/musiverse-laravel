<script setup>
import {ref, onMounted} from 'vue';
import PlaylistCard from "@/components/PlaylistCard.vue";

const playlists = ref([]);

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
    fetchPlaylists();
});
</script>

<template>
    <div class="">
        <div class="header">Playlists</div>
        <div class="card-row">
            <playlist-card v-for="playlist in playlists" :key="playlist.id" :track="playlist"></playlist-card>
        </div>
    </div>
</template>

<style scoped>
.card-row {
    width: 100%;
    margin-top: 5px;
    display: flex;

}

.header {
    font-size: 64px;
    color: #C5C6C7;

}
</style>
