<template>
    <div class="song-card">
        <RouterLink :to="{ name: 'SingleSong', params: { id: track.id } }" class="navbar-brand">
            <img :src="'storage/' + track.image" alt="{{__('Cover')}}" class="song-card-img">
        </RouterLink>
        <div class="song-info">
            <div class="title-container"><div class="title">{{ track.title }}</div></div>
            <p>{{ track.artist.name }}</p>
            <div class="controls">
                <button @click="togglePlay">
                    <i :class="isPlaying ? 'fas fa-pause' : 'fas fa-play'"></i>
                </button>
                <button @click="addToQueue">
                    <i class="fas fa-plus"></i>
                </button>
                <button @click="toggleLike">
                    <i :class="track.is_liked ? 'fas fa-heart' : 'fa-regular fa-heart'"></i>
                </button>
            </div>
            <div class="liked-at" v-if="track.timestamp">
                {{track.timestamp}}
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, inject, watch } from 'vue';
const musicPlayerState = inject('musicPlayerState');

const props = defineProps({
    track: {
        type: Object,
        required: true,
        default: () => ({
            src: '',
            title: '',
            artist: '',
            cover: '',
            is_liked: false
        }),
    },
});

const emit = defineEmits(['add-to-queue']);

const isPlaying = computed(() => musicPlayerState.currentTrack === props.track);

const togglePlay = () => {
    if(!isPlaying.value) {
        musicPlayerState.playTrack(props.track);
    } else {
        musicPlayerState.stopTrack();
    }
};

const toggleLike = async() => {
    try {
        const response = await axios.post("/api/songs/toggle-like", { songId: props.track.id });
        props.track.is_liked = response.data.liked;
    } catch (error) {
        console.error("Error toggling like", error);
    }
}

const addToQueue = () => {
    musicPlayerState.addToQueue(props.track);
};
</script>

<style scoped>
.song-card {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    flex-direction: column;
    height: fit-content;
    width: 200px;
    background-color: rgba(33, 37, 46);
    margin: 10px 30px 10px 0;
}

.song-card img {
    width: 160px;
    height: 160px;

}

.album-cover {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.song-info {
    margin: 0px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    width: 150px;
}

.title-container {
    color: #C5C6C7;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin: 0;
    padding: 0;
    white-space: nowrap;
    width: 130px;
    text-overflow: ellipsis;
}

.title-container:hover .title {
    animation: scroll-title 10s linear infinite;
}

.title {
    display: inline-block;
    color: #C5C6C7;
    font-size: 23px;
    padding-right: 100%; /* Adjust based on the length of the text */

}

@keyframes scroll-title {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}

.song-info p {
    color: #C5C6C7;
    margin: 0;
}

.controls {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

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

button:hover {
    background-color: #0056b3;
}

button i {

}

.liked-at {
    color: #C5C6C7;
    font-size: 14px;
    margin-top: 7px;
    text-align: center;
}
</style>
