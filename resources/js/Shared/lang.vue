<template>

    <div class="p-10">
        <div class="dropdown inline-block relative">
            <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                <span class="mr-1">Lang</span>

            </button>
            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 w-full">
                <li class="">
                    <inertia-link
                        class="flex items-center justify-around rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                        :href="route('language','en')"><img :src="$page.props.asset + 'img/enLAng.png'" alt=""><span
                            class="mr-1">En</span></inertia-link>
                </li>
                <li class="">
                    <inertia-link
                        class="flex items-center justify-around rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                        :href="route('language','ar')"><img :src="$page.props.asset + 'img/arLAng.png'" alt=""><span
                            class="mr-1">Ar</span></inertia-link>
                </li>
            </ul>
        </div>
    </div>

</template>
<script>
    export default {
    }
</script>

<style scoped>
    .dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
