<script setup>

</script>

<template>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" >
            <div class="justify-content-around d-flex" style="width: 100%;">
            <RouterLink to="/songs" class="navbar-brand">
                Songs
            </RouterLink>
            <RouterLink to="/playlists" class="navbar-brand">
                Playlists
            </RouterLink>
            </div>
    </nav>
</template>

<style scoped>
    nav {
        height: max-content;
        margin: 0;
    }
</style>
