<template>
    <header>
        <nav>NAV</nav>
        <div v-if="$slots.title" class="bg-green-200">
            <slot name="title"></slot>
        </div>
    </header>
    <div class="bg-gray-200">
        <slot></slot>
    </div>
</template>