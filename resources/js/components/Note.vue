<template>
  <div class="box effect">
    <div v-if="title" class="card-header box-header">
      <div class="d-table w-100">
        <h4 class="note-title">{{ title }}</h4>
        <div class="d-table-cell tar">
          <form @submit="onClickEvent(id)">
            <button class="btn" role="button">Delete</button>
          </form>
        </div>
      </div>
    </div>
    <router-link
      :to="{
        name: 'edit',
        params: {
          note: {
            id: id,
            user_id: user.id,
            title: title,
            note: note,
            create_at: created_at,
            action: 'edit',
          },
        },
      }"
      class="button"
    >
      <div class="card-body d-table w-100 boxel">
        <div class="note-content">{{ note }}</div>
        <div class="d-table-cell tar h-min-size">
          <h4 class="note-create-at">{{ created_at }}</h4>
        </div>
        <slot /></div
    ></router-link>
  </div>
</template>

<script>
import axios from "axios";
import Button from "./Button.vue";
import { mapGetters } from "vuex";
export default {
  data: function () {
    return {
      res: {},
    };
  },
  components: { Button },
  name: "Note",
  computed: mapGetters({
    user: "auth/user",
  }),
  methods: {
    onClickEvent: function (id) {
      this.$emit("onDeleteNote", id);
      return axios
        .delete(`/api/notes/${id}`)
        .then(function (response) {
          // let statusNumber = response.status;
          // response.push(statusNumber);
          return response.status;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },

  props: {
    id: { type: Number, default: null },
    title: { type: String, default: null },
    note: { type: String, default: null },
    created_at: { type: String, default: null },
  },
};
</script>
<style scoped>
.boxel {
  border: 1px solid black;
  margin-bottom: 10px;
  border-radius: 5px;
  box-shadow: 10px 10px 10px grey;
}
.box-header {
  padding: 0 12px;
  border-radius: 5px;
}
a:link {
  text-decoration: none;
}
a:visited {
  text-decoration: none;
}
a:hover {
  text-decoration: none;
}
a:active {
  text-decoration: none;
}
.h-max-size {
  max-width: 90%;
  max-height: 15px;
}
.h-min-size {
  width: 100px;
  text-align: center;
}

.note-content {
  width: 100%;
  height: 25px;
  overflow: hidden;
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
  color: aquamarine;
}
.note-create-at {
  display: inline;
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
  margin-left: 10px;
  margin-right: 0;
  font-weight: bold;
  color: aquamarine;
}
.note-title {
  display: inline-block;
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
  color: darkcyan;
}
.bg-title {
  background-color: darkcyan;
}
.btn {
  background-color: #aa436a;
  border-radius: 8px;
  border-style: none;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial,
    sans-serif;
  box-shadow: 10px 10px 10px grey;
  font-size: 14px;
  font-weight: 500;
  height: 40px;
  line-height: 20px;
  box-shadow: ;
  list-style: none;
  margin: 0;
  outline: none;
  padding: 10px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: color 100ms;
  vertical-align: baseline;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.btn:focus {
  background-color: #f082ac;
}
.non-link {
  text-decoration: none;
}
.box-size {
  max-width: inherit;
}
.border {
  border: 2px indigo dashed;
}

.d-table {
  display: table;
}

.d-table-cell {
  display: table-cell;
}

.w-100 {
  width: 100%;
}

.tar {
  text-align: right;
}
.effect {
  position: relative;
  -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3),
    0 0 40px rgba(0, 0, 0, 0.1) inset;
  -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3),
    0 0 40px rgba(0, 0, 0, 0.1) inset;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
}
.effect:before,
.effect6:after {
  content: "";
  position: absolute;
  z-index: -1;
  -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
  -moz-box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
  top: 50%;
  bottom: 0;
  left: 10px;
  right: 10px;
  -moz-border-radius: 100px / 10px;
  border-radius: 100px / 10px;
}
.effect:after {
  right: 10px;
  left: auto;
  -webkit-transform: skew(8deg) rotate(3deg);
  -moz-transform: skew(8deg) rotate(3deg);
  -ms-transform: skew(8deg) rotate(3deg);
  -o-transform: skew(8deg) rotate(3deg);
  transform: skew(8deg) rotate(3deg);
}
</style>


