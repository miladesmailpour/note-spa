<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card
        :title="note.action === 'edit' ? 'Edit Note' : 'Add Note'"
        class="effect"
      >
        <div class="container">
          <form class="bg-form" @submit="onClickEvent">
            <div class="group">
              <input v-model="note.title" required />
              <span class="highlight"></span>
              <span class="bar"></span>
              <label>Title</label>
            </div>

            <div class="form-group shadow-textarea">
              <textarea
                v-model="note.note"
                required
                class="form-control z-depth-1 ta"
                rows="7"
                placeholder="Write something here..."
              />
            </div>
            <p align="right">
              <router-link :to="{ name: 'home' }" class="button">
                <button type="submit" @click="onClickEvent" class="btn">
                  {{ note.action === "edit" ? "Edit" : "Done!" }}
                </button>
              </router-link>
            </p>
          </form>
        </div>
      </card>
    </div>
  </div>
</template>

<script>
import Button from "../components/Button.vue";
import Card from "../components/Card.vue";
import NoteList from "../components/NoteList.vue";
import { mapGetters } from "vuex";
import welcome from "./welcome.vue";
import axios from "axios";
export default {
  data: function () {
    return {
      apiContext: [],
      note: {
        id: 0,
        userid: 0,
        title: "",
        note: "",
        create_at: "",
        action: "",
      },
    };
  },
  created() {
    this.note = this.$route.params.note ?? this.note;
  },

  computed: mapGetters({
    user: "auth/user",
  }),
  methods: {
    onClickEvent: function () {
      if (this.note.title || this.note.note) {
        if (this.note.action === "edit") {
          axios
            .put(`/api/notes/${this.note.id}`, {
              id: this.note.id,
              user_id: 1,
              title: this.note.title,
              note: this.note.note,
              created_at: "",
            })
            .then((response) => {});
        }
        if (this.note.action === "add") {
          axios
            .post(`/api/notes/`, {
              user_id: this.user.id,
              title: this.note.title,
              note: this.note.note,
            })
            .then((response) => {});
        }
      } else {
        window.location = "/home";
      }
    },
  },
  components: { welcome, Card, NoteList, Button },
  middleware: "auth",

  // async asyncData() {
  //   const { data: apiContext } = await axios.put(`/api/notes/${this.note.id}`);
  //   return {
  //     apiContext,
  //   };
  // },

  metaInfo() {
    return { title: this.$t("home") };
  },
};
</script>
<style scoped>
* {
  box-sizing: border-box;
}
.shadow-textarea textarea.form-control::placeholder {
  font-weight: 300;
}
.shadow-textarea textarea.form-control {
  padding-left: 0.8rem;
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
.bg-form {
  background-color: cadetblue;
}
.container {
  font-family: "Roboto";
  width: 98%;
  margin: 10px 10px 0;
  display: block;

  padding: 10px 10px 10px;
  border-radius: 5px;
}
h2 {
  text-align: center;
  margin-bottom: 50px;
}
h2 small {
  font-weight: normal;
  color: #888;
  display: block;
}
.ta {
  max-width: 97%;
  margin: 10px;
  border-radius: 5px;
  box-shadow: 10px 10px 10px grey;
}
.group {
  position: relative;
  margin-bottom: 45px;
}
input {
  background-color: cadetblue;
  font-size: 18px;
  padding: 10px 10px 10px 5px;
  display: block;
  width: 300px;
  border: none;
  border-bottom: 1px solid #757575;
  box-shadow: 10px 10px 10px grey;
  margin-left: 10px;
}
input:focus {
  outline: none;
}

label {
  color: rgb(34, 29, 29);
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 10px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}

input:focus ~ label,
input:valid ~ label {
  top: -20px;
  font-size: 14px;
  color: cadetblue;
}

.bar {
  position: relative;
  display: block;
  width: 300px;
}
.bar:before,
.bar:after {
  content: "";
  height: 2px;
  width: 0;
  bottom: 1px;
  position: absolute;
  background: cadetblue;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.bar:before {
  left: 50%;
}
.bar:after {
  right: 50%;
}

input:focus ~ .bar:before,
input:focus ~ .bar:after {
  width: 50%;
}

.highlight {
  position: absolute;
  height: 60%;
  width: 100px;
  top: 25%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}

/* active state */
input:focus ~ .highlight {
  -webkit-animation: inputHighlighter 0.3s ease;
  -moz-animation: inputHighlighter 0.3s ease;
  animation: inputHighlighter 0.3s ease;
}

@-webkit-keyframes inputHighlighter {
  from {
    background: rgb(160, 99, 95);
  }
  to {
    width: 0;
    background: transparent;
  }
}
@-moz-keyframes inputHighlighter {
  from {
    background: cadetblue;
  }
  to {
    width: 0;
    background: transparent;
  }
}
@keyframes inputHighlighter {
  from {
    background: cadetblue;
  }
  to {
    width: 0;
    background: transparent;
  }
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
