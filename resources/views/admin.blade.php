<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    <script src="{{mix('/js/admin.js')}}" defer></script>
</head>

<body>
    <div id="app">
        <loading ref="loading"></loading>
        <v-app class>
            <div>
                <v-app-bar color="white"  flat>
                    <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
                    <v-toolbar-title>{{config('app.name')}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <sign-out></sign-out>
                </v-app-bar>
                <v-navigation-drawer v-model="drawer" absolute temporary>
                    <v-list nav dense>
                        <v-list-item-group>
                            <v-list-item :href="'/admin/index/attribute'">
                                <v-list-item-title>{{trans_choice('text.attribute', 2)}}</v-list-item-title>
                            </v-list-item>

                            <v-list-item :href="'/admin/index/listing'">
                                <v-list-item-title>{{trans_choice('text.listing', 2)}}</v-list-item-title>
                            </v-list-item>

                            <v-list-item :href="'/admin/index/location'">
                                <v-list-item-title>{{trans_choice('text.location', 2)}}</v-list-item-title>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-navigation-drawer>
            </div>
            <v-container>
                @yield('content')
            </v-container>
        </v-app>
    </div>
</body>

</html>
