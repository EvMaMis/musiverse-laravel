import { reactive } from 'vue';

export const musicPlayerState = reactive({
    currentTrack: null,
    queue: [],

    playTrack(track) {
        this.currentTrack = track;
    },

    addToQueue(track) {
        this.queue.push(track);
        if (!this.currentTrack) {
            this.playNextTrack();
        }
    },

    playNextTrack() {
        if (this.queue.length > 0) {
            this.currentTrack = this.queue.shift();
        } else {
            this.currentTrack = null;
        }
    },
});
