<template>
  <v-container fluid class="px-5">
    <v-data-table
      :headers="headers"
      :items="desserts"
      sort-by="calories"
      class="elevation-10 mt-5"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Gestión de riesgos </v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-btn
            text
            color="primary"
            dark
            class="mb-2"
            @click.stop="dialog = !dialog"
          >
            Crear nuevo riesgo
          </v-btn>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon smallclass="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">
          Revisar si hay registros
        </v-btn>
      </template>
    </v-data-table>

    <v-dialog
      v-model="dialogDelete"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <v-card>
        <v-toolbar dark color="error darken-2">
          <v-btn icon dark @click="dialogDelete = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Eliminar registro</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items> </v-toolbar-items>
        </v-toolbar>
        <v-card-text class="mt-5">
          <h2 class="display-2 error--text text-center pt-4">
            ¿Seguro quieres eliminar este regisro?
          </h2>

          <v-container>
            <from-risks
              :deleted="deleted"
              :editedIndex="editedIndex"
              :editedItem="editedItem"
            ></from-risks>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn dark outlined color="blue darken-1" @click="closeDelete"
            >Cancelar</v-btn
          >
          <v-btn
            dark
            outlined
            color="error darken-1"
            @click="deleteItemConfirm"
          >
            De acuerdo
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <v-card>
        <v-toolbar
          dark
          :color="editedIndex >= 0 ? 'info darken-2' : 'primary darken-2'"
        >
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>{{ formTitle }}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items> </v-toolbar-items>
        </v-toolbar>

        <v-card-text>
          <v-container>
            <from-risks
              :deleted="deleted"
              :editedIndex="editedIndex"
              :editedItem="editedItem"
            ></from-risks>
          </v-container>
        </v-card-text>

        <v-card-actions class="justify-center">
          <v-btn
            outlined
            :disabled="loading"
            color="error darken-1"
            @click="close"
          >
            Cancelar
          </v-btn>
          <v-btn
            :disabled="loading"
            :loading="loading"
            outlined
            color="success darken-1"
            @click="save"
          >
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
import FromRisks from "../components/Forms/RisksForm.vue";
export default {
  created() {
    this.initialize();
  },
  data() {
    return {
      loading: false,
      records: {},
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          text: "Número",
          align: "start",

          value: "_source.number"
        },
        {
          text: "Activo",
          value: "_source.active"
        },
        {
          text: "Nombre",
          value: "_source.name"
        },
        {
          text: "Descripción",
          value: "_source.description"
        },
        {
          text: "Acciones",
          value: "actions",
          sortable: false
        }
      ],
      desserts: [],
      deleted: false,
      editedIndex: -1,
      editedItem: {
        _source: {
          number: "",
          active: false,
          instance: false,
          state: "",
          name: "",
          description: "",
          statement: {
            name: ""
          },
          profile: {
            name: ""
          },
          category: {
            name: ""
          },
          owning_group: {
            name: ""
          },
          owner: {
            last_name: ""
          }
        }
      },
      defaultItem: {
        _source: {
          number: "",
          active: false,
          instance: false,
          state: "",
          name: "",
          description: "",
          statement: {
            name: ""
          },
          profile: {
            name: ""
          },
          category: {
            name: ""
          },
          owning_group: {
            name: ""
          },
          owner: {
            last_name: ""
          }
        }
      }
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Crear nuevo riesgo" : "Editar riesgo";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
      if (!val) {
        this.deleted = false;
      }
    }
  },

  methods: {
    async initialize() {
      try {
        let response = await this.$axios.get("/risks");
        this.desserts = response.data;
      } catch (error) {
        console.log(error);
      }
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.deleted = true;
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);

      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async save() {
      try {
        this.loading = true;
        console.log(this.editedItem);
        let response = await this.$axios.patch(
          `/risks/${this.editedItem._source.sys_id}`,
          {
            ...this.editedItem
          }
        );

        if (this.editedIndex > -1) {
          Object.assign(this.desserts[this.editedIndex], this.editedItem);
        } else {
          this.desserts.push(this.editedItem);
        }
      } catch (error) {
        console.log(error);
      }

      this.close();
    }
  },
  components: {
    FromRisks
  }
};
</script>
