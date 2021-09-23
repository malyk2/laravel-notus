<template>
  <card-base>
    <template v-slot:header>
      <h6 class="text-blueGray-700 text-xl font-bold">Create user</h6>
    </template>
    <form @submit.prevent="save">
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4">
          <input-base
            label="Name"
            v-model="form.name"
            :error="form.errors.first('name')"
          />
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <input-base
            label="Email"
            v-model="form.email"
            :error="form.errors.first('email')"
          />
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <input-base
            label="Password"
            v-model="form.password"
            type="password"
            :error="form.errors.first('password')"
          />
        </div>
      </div>
      <button-base type="submit" :disabled="form.busy">Save</button-base>
    </form>
  </card-base>
</template>
<script>
import CardBase from "@/components/Cards/CardBase.vue";
import InputBase from "@/components/Inputs/InputBase.vue";
import ButtonBase from "@/components/Buttons/ButtonBase.vue";
import { users as api } from "@/api";
import Form from "@/libs/Form";

export default {
  props: {
    id: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
      }),
    };
  },
  components: {
    CardBase,
    InputBase,
    ButtonBase,
  },
  mounted() {
    console.log(this.id);
    // this.getUsers();
  },
  methods: {
    save() {
      this.form.errors.clear();
      this.form.busy = true;
      api
        .create(this.form.data())
        .then((response) => {
          this.$router.push({ name: "admin.users.index" });
        })
        .catch((response) => {
          this.form.onFail(response.data.errors);
        });
    },
  },
  computed: {},
};
</script>
