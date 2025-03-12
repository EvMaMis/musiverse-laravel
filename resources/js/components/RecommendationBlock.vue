<template>
    <div class="recommendations-block" v-if="recommendations.length > 0">
        <h2>Recommendations</h2>
        <div class="recommendation-list">
            <div class="recommendation-list-item" v-for="rec in recommendations">
                <div class="text">{{rec.title}} - {{rec.artist.name}} ({{rec.tags_count}})</div>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref, onMounted} from "vue";
const recommendations = ref([]);

const fetchRecSongs = async() =>{
    try{
        const response = await axios.get('api/recommendations/songs');
        recommendations.value = response.data;
        console.log(response);
    } catch(e) {
        console.log(e);
    }
}

onMounted(() => {
    fetchRecSongs();
});

</script>

<style scoped>
.recommendations-block {
    border: 10px solid blue;
    color: white;
}
</style>
