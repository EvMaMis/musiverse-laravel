<script setup>
import {onMounted, ref} from 'vue';
import SongCard from "@/components/SongCard.vue";

const songs = ref([]);
const props = defineProps({
    data: {
        type: Object,
        required: true,
        default: () => ({
            songs: [],
            header: '',
            description: ''
        }),
    }
});

const fetchSongs = async () => {
    try {
        if(!props.data.songs) {
            const response = await axios.get('api/songs');
            songs.value = response.data;
        } else {
            songs.value = props.data.songs;
        }
    } catch (error) {
        console.error('Error fetching songs:', error);
    }
};

onMounted(() => {
    fetchSongs();
});

</script>

<template>
    <div v-if="songs && songs.length > 0">
        <div class="header">{{ props.data.header }}</div>
        <div class="description" v-if="props.data.description !== ''">{{ props.data.description }}</div>
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
    font-size: 48px;
    color: #C5C6C7;
}

</style>
