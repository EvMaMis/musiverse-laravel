<template>
    <div class="music-player">
        <div class="player-controls">
            <button @click="togglePlay">
                <i class="fas fa-play" v-if="!isPlaying"></i>
                <i class="fas fa-pause" v-if="isPlaying"></i>
            </button>
            <input v-model="currentTime" type="range" min="0" :max="duration">
            <span>{{ formattedCurrentTime }}</span>
            <span>/ {{ formattedDuration }}</span>
            <button @click="previousTrack">
                <i class="fas fa-backward"></i>
            </button>
            <button @click="nextTrack">
                <i class="fas fa-forward"></i>
            </button>
        </div>
        <audio :src="currentTrack.src" ref="audioPlayer"></audio>
    </div>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/fontawesome-free';
import { faPlay, faPause, faBackward, faForward } from '@fortawesome/free-solid-svg-icons';

export default {
    components: {
        FontAwesomeIcon,
    },
    data() {
        return {
            isPlaying: false,
            currentTime: 0,
            duration: 0,
            currentTrack: {
                src: '',
                title: '',
            },
            playlist: [],
        };
    },
    computed: {
        formattedCurrentTime() {
            const minutes = Math.floor(this.currentTime / 60);
            const seconds = Math.floor(this.currentTime % 60).toString().padStart(2, '0');
            return `${minutes}:${seconds}`;
        },
        formattedDuration() {
            const minutes = Math.floor(this.duration / 60);
            const seconds = Math.floor(this.duration % 60).toString().padStart(2, '0');
            return `${minutes}:${seconds}`;
        },
    },
    methods: {
        togglePlay() {
            this.isPlaying = !this.isPlaying;
            if (this.isPlaying) {
                this.$refs.audioPlayer.play();
            } else {
                this.$refs.audioPlayer.pause();
            }
        },
        updateProgress() {
            this.currentTime = this.$refs.audioPlayer.currentTime;
        },
        previousTrack() {
            // Implement logic to go to previous track in playlist
        },
        nextTrack() {
            // Implement logic to go to next track in playlist
        },
    },
    mounted() {
        this.$refs.audioPlayer.addEventListener('timeupdate', this.updateProgress);
        this.$refs.audioPlayer.addEventListener('loadedmetadata', () => {
            this.duration = this.$refs.audioPlayer.duration;
        });
    },
};
</script>

<style scoped>
.music-player {
    /* Add your styling here */
}
</style>
