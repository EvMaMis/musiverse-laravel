<script setup>

import SongsLine from "@/components/SongsLine.vue";
import PlaylistsLine from "@/components/PlaylistsLine.vue";
</script>

<template>
    <songs-line :data="{header: 'Songs'}"></songs-line>
    <playlists-line></playlists-line>
</template>

<style scoped>

</style>
