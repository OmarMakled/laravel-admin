<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    <script src="{{mix('/js/admin.js')}}" defer></script>

</head>

<body>
    <div id="app">
        <loading ref="loading"></loading>
        <v-app class>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <form-sign-in :to="'/admin'"></form-sign-in>
                    </v-col>
                </v-row>
            </v-container>
        </v-app>
    </div>
</body>

</html>
