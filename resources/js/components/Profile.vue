<template>
    <div class="profile-block">
        <div class="header">
            <h2>Your profile</h2>
        </div>
        <div class="text">
            <div class="info-block" v-if="data.likes && data.likes.length">
                <songs-line :data="{header: 'Your likes', songs: data.likes}"></songs-line>
            </div>
        </div>
        <div class="text">
            <div class="info-block" v-if="data.listened && data.listened.length">
                <songs-line :data="{header: 'You listened', songs: data.listened}"></songs-line>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import SongsLine from "@/components/SongsLine.vue";

const data = ref({});

onMounted(() => {
    fetchProfile();
});

const fetchProfile = async() => {
    try {
        const response = await axios.get('api/profile');
        data.value = response.data;
        console.log(data)
    } catch (e) {
        console.log(e);
    }
}

</script>

<style scoped>
.recommendations-block {
    color: white;
}

.header h2{
    font-size: 64px;
    color: #C5C6C7;
}
</style>
