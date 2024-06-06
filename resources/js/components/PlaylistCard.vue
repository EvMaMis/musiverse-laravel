<template>
    <div class="song-card">
        <img :src="'storage/' + track.image" alt="{{__('Cover')}}" class="song-card-img">
        <div class="song-info">
            <div class="title-container"><div class="title">{{ track.title }}</div></div>
            <div class="controls">
                <button @click="togglePlay">
                    <i :class="isPlaying ? 'fas fa-pause' : 'fas fa-play'"></i>
                </button>
                <button @click="addToQueue">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {inject, ref} from 'vue';

const props = defineProps({
    track: {
        type: Object,
        required: true,
        default: () => ({
            src: '',
            title: '',
            artist: '',
            cover: '',
        }),
    },
});

const emit = defineEmits(['add-to-queue']);

const isPlaying = ref(false);
const audioPlayer = ref(new Audio('storage/' + props.track.file));
const musicPlayerState = inject('musicPlayerState');


const togglePlay = () => {
    isPlaying.value = !isPlaying.value;
    if (isPlaying.value) {
        audioPlayer.value.play();
    } else {
        audioPlayer.value.pause();
    }
};

const addToQueue = () => {
    props.track.songs.forEach((song) => {
        musicPlayerState.addToQueue(song);
    })
};
</script>

<style scoped>
.song-card {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
    flex-direction: column;
    height: fit-content;
    width: 200px;
    background-color: rgba(33, 37, 46);
    margin-right: 30px;
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
</style>
