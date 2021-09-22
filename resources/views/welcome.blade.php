<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css"
        rel="stylesheet">
    <meta id="token"
        name="csrf-token"
        value="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>Dashboard</title>
</head>

<body>

    <div id="app">
        <template>
            <v-app>
                <my-menu :navigation="navigation" :acl="acl">
                    <div class="mt-4">
                        <component :is="navigation.component.name" />
                    </div>
                </my-menu>
                 <pre> @{{ navigation.component.name }}</pre>

               <pre> @{{ $data }}</pre>
                <my-navigation-drawer :acl="acl" :navigation="navigation" />






            </v-app>
        </template>
        <div>
            <input type="hidden" id="email" value="{{ $settings->email }}">
            <input type="hidden" id="name" value="{{ $settings->user_name }}">
            <input type="hidden" id="acl" value='{!! json_encode($settings->acl) !!}'>
            <input type="hidden" id="settings" value='{!! json_encode($settings->settings) !!}'>
            <input type="hidden" id="navigate" value='{!! json_encode($settings->navigate) !!}'>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/js/components/menu.component.js"></script>
    <script src="/js/components/drawer.component.js"></script>
    <script src="/js/sections/home.component.js"></script>
    <script src="/js/sections/risk.component.js"></script>
    <script src="/js/main.js"></script>

</body>

</html>
