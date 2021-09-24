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
        <v-autocomplete
          v-model="editedItem._source.statement"
          :items="items"
          item-text="name"
          :loading="isLoading"
          cache-items
          :search-input.sync="search"
          hide-no-data
          hide-selected
          label="Declaración de riesgos"
          return-object
        ></v-autocomplete>
      </v-col>
      <v-col cols="12" sm="4" class="py-0" offset-sm="1">
        <v-autocomplete
          v-model="editedItem._source.profile"
          :items="items2"
          item-text="name"
          :loading="isLoading2"
          cache-items
          :search-input.sync="search2"
          hide-no-data
          hide-selected
          label="Entidad"
          return-object
        ></v-autocomplete>
      </v-col>
    </v-row>
  </v-form>
</template>
<script>
import SearchField from "./FielSearch.vue";
export default {
  props: ["editedItem", "editedIndex", "deleted"],
  data: () => ({
    show1: false,
    items: [],
    isLoading: false,
    search: null,
    items2: [],
    isLoading2: false,
    search2: null,
    items3: [],
    isLoading3: false,
    search3: null
  }),
  components: {
    SearchField
  },
  mounted() {
    this.items.push(this.editedItem._source.statement);
    this.items2.push(this.editedItem._source.profile);
    this.items3.push(this.editedItem._source.category);
    this.editedItem._source.state = "Borrador";
  },

  watch: {
    async search(val) {
      this.items = [];
      this.isLoading = true;
      try {
        let response = await this.$axios.get(
          `/risks/${val}/sn_risk_definition/active%3Dtrue%5EnameSTARTSWITH`
        );
        for (const i in response.data.result) {
          this.items.push({
            sys_id: response.data.result[i].sys_id,
            name: response.data.result[i].name,
            category: response.data.result[i].category,
            description: response.data.result[i].description,
            additional_information:
              response.data.result[i].additional_information
          });
        }
        this.isLoading = false;
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },
    async search2(val) {
      this.items2 = [];
      this.isLoadings2 = true;
      try {
        let response = await this.$axios.get(
          `/risks/${val}/sn_grc_profile/active=true^nameSTARTSWITH`
        );
        for (const i in response.data.result) {
          this.items2.push({
            sys_id: response.data.result[i].sys_id,
            name: response.data.result[i].name,
            category: response.data.result[i].category,
            description: response.data.result[i].description,
            refers_to_existing_table:
              response.data.result[i].refers_to_existing_table,

            active: response.data.result[i].active
          });
        }
        this.isLoading2 = false;
      } catch (error) {
        console.log(error);
        this.isLoading2 = false;
      }
    },
    async search3(val) {
      this.items3 = [];
      this.isLoadings3 = true;
      try {
        let response = await this.$axios.get(
          `/risks/${val}/sn_grc_profile/active=true^nameSTARTSWITH`
        );
        for (const i in response.data.result) {
          this.items3.push({
            sys_id: response.data.result[i].sys_id,
            name: response.data.result[i].name,
            category: response.data.result[i].category,
            description: response.data.result[i].description,
            refers_to_existing_table:
              response.data.result[i].refers_to_existing_table,

            active: response.data.result[i].active
          });
        }
        this.isLoading3 = false;
      } catch (error) {
        console.log(error);
        this.isLoading3 = false;
      }
    }
  }
};
</script>
