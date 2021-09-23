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
      type: String,
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
    if(this.id) {
      if(this.id*1 == this.id) {
        console.log('number');
        api.get(this.id).then(response => {
          this.form.addParam({
            name: data.name,
            email: data.email,
          })
        }).catch(response => this.goToList())
      } else {
        this.goToList();
      }
    }
  },
  methods: {
    save() {
      this.form.errors.clear();
      this.form.busy = true;
      const request = !this.id ? api.create(this.form.data()) : api.update(this.id, this.form.data())
      request
        .then((response) => {
          this.goToList();
        })
        .catch((response) => {
          this.form.onFail(response.data.errors);
        });
    },
    goToList() {
      this.$router.push({ name: "admin.users.index" });
    }
  },

  computed: {},
};
</script>
