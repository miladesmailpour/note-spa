<template>
  <div class="row">
    <div class="box-size">
      <div class="box">
        <div class="d-table w-100 box-space">
          <input
            class="search-shadow"
            type="text"
            placeholder="Looking for a note ..."
            v-model="filterdTitle"
          />
          <div class="d-table-cell tar"></div>
        </div>
      </div>
      <note
        v-on:onDeleteNote="deletedNote($event)"
        v-for="note in filterdContext"
        :key="note.id"
        :id="note.id"
        :title="note.title"
        :note="note.note"
        :created_at="note.created_at"
      />
    </div>
  </div>
</template>

<script>
import Note from "./Note.vue";
export default {
  data: function () {
    return {
      list: [],
      filterdTitle: "",
    };
  },
  created() {
    this.list = this.context;
  },
  methods: {
    deletedNote: function (id) {
      // console.log("---<", this.context);
      console.log(`list-child to parent ${id}`);
      // this.context.filter((note) => {
      //   note.id !== id;
      // });
      this.$emit("onDelete", id);
      // console.log("--->", this.context);
    },
  },
  computed: {
    notes: function () {
      return this.list.map(
        (note) => ({
          ...note,
          created_at: note.created_at.substring(0, 10),
        }),
        this.context
      );
    },
    filterdContext: function () {
      let filter = new RegExp(this.filterdTitle, "i");
      console.log(`>>> ${filter}`);
      return this.notes.filter((cxt) => cxt.title.match(filter));
    },
  },

  components: { Note },
  name: "NoteList",

  props: {
    context: { type: Array, default: null },
  },
};
</script>
<style scoped>
h4 {
  font-size: 1em;
  margin-top: 1.33em;
  margin-bottom: 1.33em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
  color: aquamarine;
}
.box-size {
  max-width: inherit;
}
.box {
  display: inline;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
}
.box-space {
  margin-bottom: 10px;
}
.search-shadow {
  box-shadow: 10px 10px 10px grey;
}
.btn {
  background-color: #3372e9;
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
input {
  display: inline-block;
  padding: 10px;
  margin: 10px 8px;
  border-radius: 5px;
  border: 0;
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  width: 98%;
  -webkit-transition: 0.5s;
  transition: 0.5s;
}
input:focus {
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
  border: 5px dotted olivedrab;
}
</style>
