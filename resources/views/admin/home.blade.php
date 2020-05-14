@extends('admin')

@section('content')
<h1 class="h2">{{__('admin.home')}}</h1>
<v-row>
    <v-col v-for="n in 3" :key="n" cols="12" sm="4">
        <v-card class="pa-2">
            <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"></v-img>
                <v-card-actions>
                    <v-btn icon small>
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn icon small>
                        <v-icon>mdi-share</v-icon>
                    </v-btn>
                </v-card-actions>
        </v-card>
    </v-col>
</v-row>
<v-btn small color="black" class="white--text">Normal</v-btn>
<v-btn small dark>Normal</v-btn>
<p>
    <v-btn small color="black" class="white--text" disabled>Normal</v-btn>
    <v-btn small dark disabled>Normal</v-btn>
</p>

@endsection
