<template>
  <div class="flex flex-col min-h-screen flex-1">
    <header class="bg-gray-50 shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 h-20">
        <h1 class="text-3xl font-bold text-gray-900">
          <slot name="header"></slot>
        </h1>
      </div>
    </header>

    <main class="flex items-center justify-center h-full">
      <div class="mx-auto p-4 sm:px-6 lg:px-8 flex-1 h-full">
        <!-- Replace with your content -->
        <div class="sm:px-0 h-full">
          <slot name="body"></slot>
        </div>
        <!-- /End replace -->
      </div>
    </main>

    <!-- <footer class="bg-gray-500 text-gray-50"> -->
    <!-- <div class="max-w-7xl mx-auto py-1 sm:px-6 lg:px-8"> -->
    <!-- Replace with your content -->
    <!-- <div class="px-4 py-2 sm:px-0"> -->
    <!-- <p>Footer</p> -->
    <!-- </div> -->
    <!-- /End replace -->
    <!-- </div> -->
    <!-- </footer> -->
  </div>
</template>

<script setup></script>
