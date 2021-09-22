<template>
  <v-container fluid fill-height dark>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-15 rounded-lg">
          <v-card-text
            class="secondary d-flex justify-space-between align-center mb-5"
            dark
          >
            <v-img
              max-width="300px"
              width="20%"
              src="https://ipsumtechnology.mx/wp-content/uploads/2020/12/logotipo-ipsum-cromatico-negativo-e1608761287420.png"
              alt=""
            />
            <span class="mx-5" style="color: #fff; font-size: 40px">By</span>
            <v-img
              max-width="300px"
              width="20%"
              contain
              src="https://ipsumtechnology.mx/wp-content/uploads/2020/12/ServiceNow-reverse-logo-e1608759991159.png"
            ></v-img>
          </v-card-text>
          <v-card-text class="mt-5" dark>
            <v-form ref="form" v-model="valid" lazy-validation class="mt-5">
              <h1 class="my-3 text-center display-1 success--text">
                Iniciar sesión
              </h1>
              <v-text-field
                prepend-icon="mdi-account"
                name="login"
                v-model="user.email"
                label="Correo Electronico"
                :rules="rules.email"
                :error-messages="error_message.email"
                type="text"
              ></v-text-field>
              <v-text-field
                id="password"
                prepend-icon="mdi-lock"
                name="password"
                v-model="user.password"
                label="Contraseña"
                :rules="rules.password"
                :error-messages="error_message.password"
                :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show3 ? 'text' : 'password'"
                @click:append="show3 = !show3"
              ></v-text-field>
            </v-form>

            <p class="text-center error--text">
              {{ error_message.credentials }}
            </p>
          </v-card-text>
          <v-card-actions class="d-flex justify-center pb-5">
            <v-btn
              :loading="load"
              :disabled="!valid && time > 0"
              @click="login"
              color="success"
              >{{
                time > 0
                  ? "Espera " + time / 1000 + " segundos para intentar de nuevo"
                  : "Iniciar sesión"
              }}</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "Home",
  data: () => ({
    show3: false,
    valid: true,
    load: false,
    intentos: 0,
    time: 0,
    user: {
      email: "demo@ipsumtechnology.mx",
      password: "Contraseña.2021"
    },
    rules: {
      email: [
        v => !!v || "El correo electrónicico es requerido",
        v => /.+@.+\..+/.test(v) || "El correo electrónicico no es valido"
      ],
      password: [
        v => !!v || "La contraseña es requerida",
        v =>
          (v && v.length >= 6) ||
          "La contraseña debe de contener al menos 6 caracteres"
      ]
    },
    error_message: {
      email: "",
      password: "",
      credentials: ""
    },
    response: null
  }),
  methods: {
    ...mapActions([
      "authenticate",
      "setUser",
      "setAcl",
      "setNavigate",
      "setSettings"
    ]),
    async login() {
      this.load = true;
      this.intentos++;
      if (!this.$refs.form.validate()) return;

      try {
        let response = await axios.post("/auth/login", this.user);
        this.response = response.data;
        this.authenticate(response.data.session);
        this.setUser(response.data);
        this.setAcl(response.data.acl);
        this.setNavigate(response.data.navigate);
        this.setSettings(response.data.settings);
        this.$router.push({ name: response.data.navigate.component.title });
      } catch (error) {
        this.load = false;
        let errors = error.response.data.errors;
        for (const key in errors) {
          this.error_message[key] = errors[key][0];
        }
        this.time = 5000 * this.intentos;
        this.valid = false;

        let time2 = this.time;
        let interval = setInterval(() => {
          this.time = this.time - 1000;
        }, 1000);

        setTimeout(() => {
          this.valid = true;
          this.time = 0;
          clearInterval(interval);
        }, time2);
      }
    }
  },
  watch: {
    time: function(new_value, old_value) {
      if (new_value <= 0) {
        this.error_message.credentials = "";
      }
    }
  }
};
</script>
