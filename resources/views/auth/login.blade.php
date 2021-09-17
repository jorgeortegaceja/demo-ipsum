<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css"
        rel="stylesheet">
    <meta id="token" name="csrf-token" value="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>Login</title>
</head>

<body>
    <div id="app">
        <template>
            <v-app id="inspire">

                <v-container fluid
                    fill-height>
                    <v-layout align-center
                        justify-center>
                        <v-flex xs12
                            sm8
                            md4>
                            <v-card class="elevation-12">
                                <v-toolbar dark
                                    color="primary">
                                    <v-toolbar-title>Iniciar sesion</v-toolbar-title>
                                </v-toolbar>
                                <v-card-text>
                                    <v-form ref="form"
                                        v-model="valid"
                                        lazy-validation>
                                        <v-text-field prepend-icon="mdi-account"
                                            name="login"
                                            v-model="user.email"
                                            label="Correo Electronico"
                                            :rules="rules.email"
                                            :error-messages="error_message.email"
                                            type="text"></v-text-field>
                                        <v-text-field id="password"
                                            prepend-icon="mdi-lock"
                                            name="password"
                                            v-model="user.password"
                                            label="Contraseña"
                                            :rules="rules.password"
                                            :error-messages="error_message.password"
                                            :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                                            :type="show3 ? 'text' : 'password'"
                                            @click:append="show3 = !show3"></v-text-field>

                                    </v-form>
                                </v-card-text>
                                <v-card-actions class="d-flex justify-center pb-5">
                                    <v-btn :disabled="!valid"
                                        @click="login"
                                        color="primary">Iniciar sesión</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>

            </v-app>
        </template>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify({

            }),

            data: {
                show3: false,
                valid: true,
                user: {
                    email: 'demo@ipsumtechnology.mx',
                    password: 'Contraseña.2021',
                    _token: document.getElementById('token').getAttribute('value')
                },
                rules: {
                    email: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    ],
                    password: [
                        v => !!v || 'Password is required',
                        v => (v && v.length >= 6) || 'Password must be greater than or equal to 6 characters',
                    ]
                },
                error_message: {
                    email: '',
                    password: ''
                },
                response: null
            },
            methods: {
                async login() {
                    if (!this.$refs.form.validate())
                        return

                    try {
                        let response = await axios.post('/login', this.user);
                        this.response = response.data;
                        console.log(response.data);
                        window.location.reload();
                    } catch (error) {
                        let errors = error.response.data.errors;
                        for (const key in errors) {
                            this.error_message[key] = errors[key][0];
                        }
                        setTimeout(() => {
                            this.valid = true;
                        }, 5000);
                    }
                }
            }
        })
    </script>
</body>

</html>
