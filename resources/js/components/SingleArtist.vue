<script setup>
import {useRoute} from "vue-router";
import {onMounted, ref} from "vue";
import SongsLine from "@/components/SongsLine.vue";

const route = useRoute();
const artistId = route.params.id;
const artist = ref({});
const isSubscribed = ref(false);

onMounted(() => {
    fetchArtistInfo();
});

const fetchArtistInfo = async () => {
    try {
        let response = await axios.get(`/api/artists/${artistId}`);
        artist.value = response.data;
        isSubscribed.value = response.data.isSubscribed;
    } catch (e) {
        console.error(e);
    }
};

const handleSubscribe = async () => {
    try {
        let response = await axios.post(`/api/artists/${artistId}/subscribe`);
        isSubscribed.value = response.data.subscribed;
        console.log(response);
    } catch (e) {
        console.error(e);
    }
};
</script>

<template>
    <div class="artist-block" v-if="artist.songs && artist.songs.length > 0">
        <h1>{{ artist.name }}</h1>
        <div class="stats">
            <div class="subscribers" v-if="artist.subscribers_count">
                Підписники: {{artist.subscribers_count}}
            </div>
            <div class="likes" v-if="artist.likes">
                Загальна кількість вподобань: {{artist.likes}}
            </div>
            <div class="plays">
                Загальна кількість прослуховувань: {{artist.plays}}
            </div>
            <div class="songs-count">
                Загальна кількість композицій: {{artist.songs.length}}
            </div>
        </div>
        <div class="biography">
            Опис виконавця: {{ artist.description }}
        </div>
        <div class="subscribe-button btn"
             :class="isSubscribed ? 'btn-success' : 'btn-outline-danger'"
             @click="handleSubscribe">
            {{ isSubscribed ? "Ви підписані" : "Підписатись" }}
        </div>
        <div class="songs-list">
            <songs-line :data="{header: 'Пісні виконавця', songs: artist.songs}"></songs-line>
        </div>
    </div>
</template>

<style scoped>
.artist-block {
    color: #9ca3af;
}

.biography {
    margin: 20px 0px 5px;
}
</style>
