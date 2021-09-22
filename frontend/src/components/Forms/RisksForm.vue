<template>
  <v-form>
    <v-row justify="center" class="mt-5 pb-0">
      <v-col cols="12" sm="4" class="py-0">
        <v-text-field
          v-model="editedItem._source.number"
          disabled
          label="Numero"
          outlined
          dense
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1">
        <v-checkbox
          v-model="editedItem._source.active"
          label="Activo"
          :disabled="deleted"
          dense
        ></v-checkbox>
      </v-col>
    </v-row>
    <v-row justify="center" class="pb-0">
      <v-col cols="12" sm="4" class="py-0">
        <v-text-field
          v-model="editedItem._source.state"
          disabled
          label="Estado"
          outlined
          dense
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1">
        <v-checkbox
          v-model="editedItem._source.instance"
          label="Heredar de la declaración de riesgo"
          :disabled="deleted"
          dense
        ></v-checkbox>
      </v-col>
    </v-row>
    <v-row justify="center" class="pb-0">
      <v-col cols="12" sm="9">
        <v-text-field
          v-model="editedItem._source.name"
          :disabled="deleted"
          label="Nombre"
          outlined
          dense
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="9">
        <v-textarea
          v-model="editedItem._source.description"
          outlined
          name="input-7-4"
          label="Descripción"
          :disabled="deleted"
          dense
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row justify="center" class="pb-0">
      <v-col cols="12" sm="4" class="py-0">
        <v-text-field
          v-model="editedItem._source.statement.name"
          :disabled="deleted"
          label="Declaración de riesgos"
          outlined
          dense
          append-icon="mdi-arrow-expand"
          @click:append="show1 = !show1"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1">
        <v-text-field
          v-model="editedItem._source.profile.name"
          :disabled="deleted"
          label="Grupo de propietarios"
          outlined
          dense
          append-icon="mdi-arrow-expand"
          @click:append="show1 = !show1"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row justify="center" class="pb-0">
      <v-col cols="12" sm="4" class="py-0">
        <v-text-field
          v-model="editedItem._source.category.name"
          :disabled="deleted"
          label="Categoria"
          outlined
          dense
          append-icon="mdi-arrow-expand"
          @click:append="show1 = !show1"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1"></v-col>
    </v-row>

    <v-row justify="center" class="pb-0">
      <v-col cols="12" sm="4" class="py-0">
        <v-text-field
          v-model="editedItem._source.owning_group.name"
          :disabled="deleted"
          dense
          label="Grupo de propietarios"
          outlined
          append-icon="mdi-arrow-expand"
          @click:append="show1 = !show1"
        ></v-text-field>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1">
        <v-text-field
          v-model="editedItem._source.owner.first_name"
          :disabled="deleted"
          dense
          label="Propietario"
          outlined
          append-icon="mdi-arrow-expand"
          @click:append="show1 = !show1"
        ></v-text-field>
      </v-col>
    </v-row>
    <pre>{{ deleted }}</pre>
    <v-dialog
      transition="dialog-bottom-transition"
      max-width="600"
      v-model="show1"
    >
      <template v-slot:default="dialog">
        <v-card>
          <v-toolbar color="primary" dark>Opening from the bottom</v-toolbar>
          <v-card-text>
            <div class="text-h2 pa-12">Hello world!</div>
          </v-card-text>
          <v-card-actions class="justify-end">
            <v-btn text @click="dialog.value = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </v-form>
</template>
<script>
export default {
  props: ["editedItem", "editedIndex", "deleted"],
  data: () => ({
    show1: false
  }),
  mounted() {
    this.editedItem._source.state = "Borrador";
  }
};
</script>
