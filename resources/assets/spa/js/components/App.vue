<template>
    <div id="isAuth">
        <header v-if="Auth">
            <menu></menu>
        </header>

        <main>
            <router-view></router-view>
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    &copy; {{ year  }} <a href="#" class="grey-text text-lighten-4">Financeiro</a>
                </div>
            </div>
        </footer>

    </div>
</template>

<script type="text/javascript">
    import MenuComponent from './Menu.vue';
    export default {
        components: {
            'menu': MenuComponent
        },
        data() {
            return {
                year: new Date().getFullYear()
            }
        }
    }
</script>
<style type="text/css">
    #app {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }
</style>