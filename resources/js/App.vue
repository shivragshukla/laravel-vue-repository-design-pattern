<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav" >
                    <router-link to="/" class="nav-item nav-link" >Home </router-link>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                //
            }
        },
    }
</script>