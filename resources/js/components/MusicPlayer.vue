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
import { inject, watch, ref, onMounted, onUnmounted} from 'vue';
import {start} from "@popperjs/core";

const musicPlayerState = inject('musicPlayerState');
const audioPlayer = ref(null);
let listenTimeout = null;

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
        startListeningTimer();
    } else {
        audioPlayer.value.pause();
        if (listenTimeout) clearTimeout(listenTimeout);

    }
};

const sendListenedRequest = async (songId) => {
    try {
        const test = await axios.post('/api/songs/add-listened', {
            songId: songId
        });
        console.log(test);
    } catch(e) {
        console.error(e);
    }
};
1
const startListeningTimer = () => {
    if (listenTimeout) clearTimeout(listenTimeout);
    let timeoutTime = audioPlayer.value ? 10000 - audioPlayer.value.currentTime * 1000 : 10000;
    if(timeoutTime <= 0) {
        return true;
    }
    listenTimeout = setTimeout(() => {
        if (musicPlayerState.currentTrack) {
            sendListenedRequest(musicPlayerState.currentTrack.id);
        }
    }, timeoutTime);
};

watch(() => musicPlayerState.currentTrack, (newTrack) => {
    if (newTrack && audioPlayer.value) {
        audioPlayer.value.src  = 'storage/' + newTrack.file;
        audioPlayer.value.play();
    }
    startListeningTimer();

});

onMounted(() => {
    if(audioPlayer.value) {
        audioPlayer.value.addEventListener('play', startListeningTimer);
    }
});

onUnmounted(() => {
    if (audioPlayer.value) {
        audioPlayer.value.removeEventListener('play', startListeningTimer);
    }
    if (listenTimeout) clearTimeout(listenTimeout);
})
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
