<template>
    <div class="music-player">
        <div class="current-song">Currently playing</div>
        <div>
            <button @click="previousTrack">
                <i class="fa-solid fa-backward-step"></i>
            </button>
            <button @click="togglePlay">
                <i v-if="isPlaying" class="fa-solid fa-pause"></i>
                <i v-else class="fa-solid fa-play"></i>
            </button>
            <button @click="nextTrack">
                <i class="fa-solid fa-forward-step"></i>
            </button>
        </div>
        <div>
            <span>{{ formattedCurrentTime }}</span> / <span>{{ formattedDuration }}</span>
        </div>
        <audio ref="audioPlayer" :src="currentTrack.src"></audio>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';

const isPlaying = ref(false);
const currentTime = ref(0);
const duration = ref(0);
const currentTrackIndex = ref(0);

const currentTrack = reactive({
    src: '',
    title: '',
});

const playlist = ref([]);

const formattedCurrentTime = computed(() => {
    const minutes = Math.floor(currentTime.value / 60);
    const seconds = Math.floor(currentTime.value % 60).toString().padStart(2, '0');
    return `${minutes}:${seconds}`;
});

const formattedDuration = computed(() => {
    const minutes = Math.floor(duration.value / 60);
    const seconds = Math.floor(duration.value % 60).toString().padStart(2, '0');
    return `${minutes}:${seconds}`;
});

const audioPlayer = ref(null);

const loadTrack = (index) => {
    if (index >= 0 && index < playlist.value.length) {
        currentTrackIndex.value = index;
        currentTrack.src = playlist.value[index].src;
        currentTrack.title = playlist.value[index].title;
        if (isPlaying.value) {
            audioPlayer.value.play();
        }
    }
};

const togglePlay = () => {
    isPlaying.value = !isPlaying.value;
    if (isPlaying.value) {
        audioPlayer.value.play();
    } else {
        audioPlayer.value.pause();
    }
};

const updateProgress = () => {
    currentTime.value = audioPlayer.value.currentTime;
};

const previousTrack = () => {
    if (currentTrackIndex.value > 0) {
        loadTrack(currentTrackIndex.value - 1);
    }
};

const nextTrack = () => {
    if (currentTrackIndex.value < playlist.value.length - 1) {
        loadTrack(currentTrackIndex.value + 1);
    }
};

onMounted(async () => {
    audioPlayer.value.addEventListener('timeupdate', updateProgress);
    audioPlayer.value.addEventListener('loadedmetadata', () => {
        duration.value = audioPlayer.value.duration;
    });

    // Fetch playlist data from backend
    const response = await axios.get('/api/user-playlist');
    playlist.value = response.data;

    // Load the first track
    if (playlist.value.length > 0) {
        loadTrack(0);
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
</style>
