<template>
    <div class="music-player">
        <div>
            <audio v-if="musicPlayerState.currentTrack" ref="audioPlayer" :src="'storage/' + musicPlayerState.currentTrack.file" controls autoplay @ended="handleTrackEnd"></audio>
            <div class="controls">
                <button @click="playPreviousTrack">⏮️</button>
                <button @click="togglePlayPause">⏯️</button>
                <button @click="playNextTrack">⏭️</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, watch, ref } from 'vue';

const musicPlayerState = inject('musicPlayerState');
const audioPlayer = ref(null);

const handleTrackEnd = () => {
    playNextTrack();
};

const playNextTrack = () => {
    musicPlayerState.playNextTrack();
};

const playPreviousTrack = () => {
    musicPlayerState.playPreviousTrack();
};

const togglePlayPause = () => {
    if (audioPlayer.value.paused) {
        audioPlayer.value.play();
    } else {
        audioPlayer.value.pause();
    }
};

watch(() => musicPlayerState.currentTrack, (newTrack) => {
    if (newTrack && audioPlayer.value) {
        audioPlayer.value.src  = 'storage/' + newTrack.file;
        audioPlayer.value.play();
    }
});
</script>

<style scoped>
.music-player {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.controls {
    margin-top: 10px;
}
button {
    margin: 5px;
    padding: 10px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    background-color: #444;
    color: white;
    border-radius: 5px;
}
button:hover {
    background-color: #666;
}
</style>
