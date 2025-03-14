<template>
    <div style="color:red">{{recommendations.length}}</div>
    <div class="recommendations-block" v-if="recommendations">
        <h2>Recommendations</h2>
        <div class="recommendation-list">
            <h3>Sound similar to what you listened:</h3>
            <div class="recommendation-list-item" v-for="rec in recommendations.tags">
                <div class="text">{{rec.title}} - {{rec.artist.name}}</div>
            </div>
            <h3>Same artists - new tracks:</h3>
            <div class="recommendation-list-item" v-for="rec in recommendations.artists">
                <div class="text">{{rec.title}} - {{rec.artist.name}}</div>
            </div>
            <h3>Something new from same genres:</h3>
            <div class="recommendation-list-item" v-for="rec in recommendations.genres">
                <div class="text">{{rec.title}} - {{rec.artist.name}}</div>
            </div>
        </div>
    </div>

</template>

<script setup>
import {ref, reactive, onMounted, watch, computed} from "vue";
import { useRoute } from "vue-router";

const recommendations = ref([]);
const route = useRoute();

watch(route, () => {
    fetchRecSongs();
});

const fetchRecSongs = async() =>{
    try{
        const response = await axios.get('api/recommendations/songs');
        recommendations.value = response.data;
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
