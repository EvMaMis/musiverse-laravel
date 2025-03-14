<template>
    <div class="queue-display">
        <h2>Queue</h2>
            <div v-if="musicPlayerState.currentTrack" style="color: #45A29E;">{{musicPlayerState.currentTrack.title}} - {{musicPlayerState.currentTrack.artist.name}}</div>
            <div v-for="(track, index) in queue" :key="index">
                {{ track.title }} - {{ track.artist.name }}
            </div>
    </div>

</template>

<script setup>
import { inject } from 'vue';

const musicPlayerState = inject('musicPlayerState');

const queue = musicPlayerState.queue;
</script>

<style scoped>
/* Your styles here */
.queue-display {
    /* Add your styles to style the queue display */
}
</style>
