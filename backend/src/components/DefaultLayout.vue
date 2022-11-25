<template>
	<div class="relative flex">
        <Sidebar />
		<router-view></router-view>
	</div>
	
</template>

<script setup>
import Sidebar from './Sidebar/Sidebar.vue';
</script>