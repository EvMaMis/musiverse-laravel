<template>
    <div class="recommendations-block" v-if="recommendationsFetched">
        <div class="recommendation-list">
            <songs-line key="tags"
                        :data="{header: 'Рекомендації за тегами:', description: 'Тут перелічені композиції з такими ж тегами, які ви вподобали.', songs: recommendations.tags}"></songs-line>
            <songs-line key="artists"
                        :data="{header: 'Рекомендації від виконавців, які вам сподобались:', description: 'Тут перелічені композиції від тих авторів, чиї композиції ви вподобали.', songs: recommendations.artists}"></songs-line>
            <songs-line key="genre"
                        :data="{header: 'Рекомендації за жанрами:', description: 'Тут перелічені композиції з тих жанрів, які вам сподобались.', songs: recommendations.genres}"></songs-line>
            <songs-line key="collaborative"
                        :data="{header: 'Подобається користувачам, схожим на вас', description: 'Користувачі, які слухають такі ж пісні, як і ви, вподобали ці пісні. Можливо, ви відкриєте для себе щось нове.', songs: recommendations.collaborative}"></songs-line>
        </div>
    </div>

</template>

<script setup>
import {computed, ref, onMounted} from "vue";
import SongsLine from "@/components/SongsLine.vue";

const recommendations = ref({});
const recommendationsFetched = computed(() => Object.keys(recommendations.value).length > 0);

onMounted(() => {
    fetchRecSongs();
});


const fetchRecSongs = async () => {
    try {
        const response = await axios.get('api/recommendations/songs');
        recommendations.value = response.data;
        console.log(recommendations.value);
    } catch (e) {
        console.log(e);
    }
}

</script>

<style scoped>
.recommendations-block {
    color: white;
}
</style>
