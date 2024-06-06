<template>
    <div>
        <div v-if="musicPlayerState.currentTrack">
            <audio ref="audioPlayer" :src="'storage/' + musicPlayerState.currentTrack.file" controls autoplay @ended="handleTrackEnd"></audio>
        </div>
        <div v-else>
            <p class="current-song">No track is currently playing.</p>
        </div>
    </div>
</template>

<script setup>
import { inject, watch, ref } from 'vue';

const musicPlayerState = inject('musicPlayerState');
const audioPlayer = ref(null);

const handleTrackEnd = () => {
    musicPlayerState.playNextTrack();
};

watch(() => musicPlayerState.currentTrack, (newTrack) => {
    if (newTrack && audioPlayer.value) {
        audioPlayer.value.src  = 'storage/' + newTrack.file;
        audioPlayer.value.play();
    } else {
    }
});
</script>

<style scoped>
#app {
    text-align: center;
    margin-top: 50px;
}
.current-song {
    color: #C5C6C7;
}
.music-player {
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
.controls {
    display: flex;
}
</style>
