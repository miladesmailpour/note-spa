<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t()">
        <div class="box">
          <div class="d-table w-100">
            <div class="inputnote">Daily Note</div>

            <div class="d-table-cell tar">
              <router-link
                :to="{ name: 'add', params: { note: { action: 'add' } } }"
                class="button"
              >
                <button class="btn box" @click="onClickEvent">Add</button>
              </router-link>
              <router-link :to="{ name: 'rate' }" class="button">
                <button class="btn box" @click="onClickEvent">Rate</button>
              </router-link>
            </div>
          </div>
        </div>
        <note-list
          v-on:onDelete="deletedNoteId($event)"
          :context="context"
        ></note-list>
      </card>
    </div>
  </div>
</template>
<script>
import Button from "../components/Button.vue";
import Card from "../components/Card.vue";
import NoteList from "../components/NoteList.vue";
``;
import welcome from "./welcome.vue";
import axios from "axios";
export default {
  data: function () {
    return {
      apiContext: [],
    };
  },
  computed: {
    context: function () {
      console.log("home/_computed===>", this.apiContext.data);
      return this.apiContext.data;
    },
  },
  methods: {
    onClickEvent: function () {
      // console.log(`>>> route to Add.Edit page from home`);
    },
    deletedNoteId: function (id) {
      console.log("---<", this.context);
      console.log(`Home-child to parent ${id}`);
      // this.context.filter((note) => {
      //   note.id !== id;
      // });
      console.log("--->", this.context);
    },
  },
  created() {},
  components: { welcome, Card, NoteList, Button },
  middleware: "auth",

  async asyncData() {
    const { data: apiContext } = await axios.get("/api/notes");
    return {
      apiContext,
    };
  },

  metaInfo() {
    return { title: this.$t("home") };
  },
};
</script>
<style scoped>
.box {
  display: inline;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
}
.btn {
  box-shadow: 10px 10px 10px grey;
  background-color: #628ee0;
  border-radius: 8px;
  border-style: none;
  box-sizing: border-box;
  color: #ffffff;
  cursor: pointer;
  font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial,
    sans-serif;
  font-size: 14px;
  font-weight: 500;
  height: 40px;
  width: 6em;
  line-height: 20px;
  list-style: none;
  margin: 0;
  margin-right: 20px;
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
.inputnote {
  display: inline-block;
  padding: 10px;
  margin: 10px 8px 10px 8px;
  border: none;
  text-shadow: 15px 15px 10px rgb(92, 88, 88);
  width: 100%;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  background-color: cadetblue;
  font-size: 1.6em;
  color: darkgreen;
  text-decoration: bold;
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
  width: 95%;
}

.tar {
  text-align: right;
}
</style>
