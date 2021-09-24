<template>
  <div>
    <v-autocomplete
      v-model="item"
      va
      :items="items"
      item-text="name"
      :loading="isLoading"
      cache-items
      :search-input.sync="search"
      hide-no-data
      hide-selected
      item-value="API"
      label="Public APIs"
      placeholder="Start typing to Search"
      return-object
    ></v-autocomplete>
  </div>
</template>

<script>
export default {
  props: ["item", "table"],
  data: () => ({
    descriptionLimit: 60,
    items: [],
    isLoading: false,
    model: null,
    search: null
  }),

  computed: {},

  watch: {
    "model.sys_id": function() {
      this.$emit("updateitem", this.model);
    },
    async search(val) {
      this.items = [];
      this.isLoading = true;

      try {
        let response = await this.$axios.get(`/risks/${val}/${this.table}`);
        for (const i in response.data.result) {
          this.items.push({
            sys_id: response.data.result[i].sys_id,
            name: response.data.result[i].name,
            document: response.data.result[i].document,
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
    }
  }
};
</script>
