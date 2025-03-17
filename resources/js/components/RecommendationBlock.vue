<template>
    <div class="recommendations-block" v-if="recommendationsFetched">
        <div class="recommendation-list">
            <songs-line key="tags" :data="{header: 'Sound similar to what you listened:', songs: recommendations.tags}"></songs-line>
            <songs-line key="tags" :data="{header: 'Something new from same artists:', songs: recommendations.artists}"></songs-line>
            <songs-line key="tags" :data="{header: 'New songs from your favorite genres:', songs: recommendations.genres}"></songs-line>
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


const fetchRecSongs = async() =>{
    try{
        const response = await axios.get('api/recommendations/songs');
        recommendations.value = response.data;
        console.log(recommendations.value);
    } catch(e) {
        console.log(e);
    }
}

</script>

<style scoped>
.recommendations-block {
    color: white;
}
</style>
